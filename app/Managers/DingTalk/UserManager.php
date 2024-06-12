<?php

declare(strict_types=1);

namespace App\Managers\DingTalk;

use App\Managers\DingTalk\Enums\UserActiveEnum;
use App\Managers\DingTalk\Enums\UserAdminEnum;
use App\Managers\DingTalk\Enums\UserBossEnum;
use App\Managers\DingTalk\Enums\UserSeniorEnum;
use App\Managers\DingTalk\Model\User;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\HttpClient;
use Flame\Support\Facade\Log;
use Throwable;

class UserManager extends BaseManager
{
    /**
     * @throws CustomException
     */
    public function getUserByCode(string $code): User
    {
        try {
            $result = $this->postRequest('https://oapi.dingtalk.com/topapi/v2/user/getuserinfo', ['code' => $code]);

            Log::info('$result::'.var_export($result, true));

            return $this->getDetailByUserId($result['userid']);
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
    }

    /**
     * 通过 unionId 换取 userId
     *
     * @see https://open.dingtalk.com/document/orgapp/query-a-user-by-the-union-id
     *
     * @throws CustomException
     */
    public function getUserIdByUnionId(string $unionId): string
    {
        $response = $this->postRequest('https://oapi.dingtalk.com/topapi/user/getbyunionid', ['unionid' => $unionId]);

        return $response['userid'] ?? '';
    }

    /**
     * 通过 userId 获取用户详情
     *
     * @see https://open.dingtalk.com/document/orgapp/query-user-details
     *
     * @throws CustomException
     */
    public function getDetailByUserId(string $userId): User
    {
        $response = $this->postRequest('https://oapi.dingtalk.com/topapi/v2/user/get', ['userid' => $userId]);

        $hired_date = '';
        if (isset($response['hired_date'])) {
            $seconds = $response['hired_date'] / 1000;
            $hired_date = date('Y-m-d H:i:s', $seconds);
        }

        $user = new User();
        $user->setName($response['name']);
        $user->setAvatar($response['avatar'] ?? '');
        $user->setUserId($response['userid']);
        $user->setUnionId($response['unionid']);
        $user->setAdmin(($response['admin']) ? UserAdminEnum::OK->value : UserAdminEnum::NO->value);
        $user->setActive($response['active'] ? UserActiveEnum::OK->value : UserActiveEnum::DISABLE->value);
        $user->setBoss($response['boss'] ? UserBossEnum::Yes->value : UserBossEnum::NO->value);
        $user->setEmail($response['email'] ?? '');
        $user->setHiredDate($hired_date);
        $user->setMobile($response['mobile']);
        $user->setJobNumber($response['job_number'] ?? '');
        $user->setRemark($response['remark'] ?? '');
        $user->setDeptIdList($response['dept_id_list'] ?? []);
        $user->setManagerUserId($response['manager_userid'] ?? '');
        $user->setOrgEmail($response['org_email'] ?? '');
        $user->setSenior($response['senior'] ? UserSeniorEnum::OK->value : UserSeniorEnum::NO->value);
        $user->setTitle($response['title'] ?? '');

        return $user;
    }

    /**
     * 获取员工人数
     *
     * @see https://open.dingtalk.com/document/orgapp/obtain-the-number-of-employees-v2
     *
     * @throws CustomException
     */
    public function count(bool $onlyActive = false): int
    {
        $response = $this->postRequest('https://oapi.dingtalk.com/topapi/user/count', ['only_active' => $onlyActive]);

        return $response['count'] ?? 0;
    }

    /**
     * 获取用户token
     *
     * @see https://open.dingtalk.com/document/orgapp/obtain-user-token
     *
     * @throws CustomException
     */
    public function getUserAccessToken(string $authCode): string
    {
        $cacheName = self::USER_ACCESS_TOKEN.'_'.$this->config['app_key'].$authCode;
        $accessToken = cache($cacheName);

        if (empty($accessToken)) {
            $query = [
                'clientId' => $this->config['app_key'],
                'clientSecret' => $this->config['app_secret'],
                'code' => $authCode,
                'grantType' => 'authorization_code',
            ];

            $response = HttpClient::postJsonUrl('https://api.dingtalk.com/v1.0/oauth2/userAccessToken', $query);
            $resData = json_decode($response, true);

            if (! isset($resData['accessToken'])) {
                throw new CustomException($resData['message']);
            }

            $accessToken = $resData['accessToken'];

            cache($cacheName, $accessToken, $resData['expireIn']);
        }

        return $accessToken;
    }

    /**
     * 获取用户通讯录个人信息
     *
     * @see https://open.dingtalk.com/document/orgapp/dingtalk-retrieve-user-information?spm=ding_open_doc.document.0.0.38e84a976VamgC
     *
     * @throws CustomException
     */
    public function getContactUser(string $getUserAccessToken): array
    {
        $response = HttpClient::getUrl('https://api.dingtalk.com/v1.0/contact/users/me?x-acs-dingtalk-access-token='.$getUserAccessToken);
        $resData = json_decode($response, true);

        if (! isset($resData['unionId'])) {
            throw new CustomException($resData['message']);
        }

        return $resData;
    }
}
