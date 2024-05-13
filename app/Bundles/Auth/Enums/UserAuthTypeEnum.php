<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Enums;

/**
 * 认证类型
 */
enum UserAuthTypeEnum: string
{
    /**
     * 手机号码
     */
    case Mobile = 'mobile';

    /**
     * 电子邮箱
     */
    case Email = 'email';

    /**
     * 钉钉UserID
     */
    case DingTalkUserId = 'ding_talk_user_id';

    /**
     * 钉钉OpenID
     */
    case DingTalkOpenId = 'ding_talk_open_id';

    /**
     * 钉钉UnionID
     */
    case DingTalkUnionId = 'ding_talk_union_id';

    /**
     * 微信OpenID
     */
    case WechatOpenId = 'wechat_open_id';

    /**
     * 微信UnionID
     */
    case WechatUnionId = 'wechat_union_id';
}
