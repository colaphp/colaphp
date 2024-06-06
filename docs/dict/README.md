# 数据字典

### 用户表(`user`)
| 列名 | 数据类型 | 索引 | 是否为空 | 描述 |
| ------- | --------- | --------- | --------- | -------------- |
| id | bigint unsigned | PRI | 否 |  |
| name | varchar(255) |  | 否 | 昵称 |
| avatar | varchar(255) |  | 否 | 头像 |
| birthday | date |  | 否 | 生日 |
| mobile | varchar(255) |  | 否 | 手机号码 |
| mobile_verified_at | timestamp |  | 是 | 手机号码验证时间 |
| password | varchar(255) |  | 否 | 登录密码 |
| status | tinyint unsigned |  | 否 | 状态:1正常;2禁用 |
| remember_token | varchar(100) |  | 是 |  |
| created_at | timestamp |  | 是 |  |
| updated_at | timestamp |  | 是 |  |
| deleted_at | timestamp |  | 是 |  |

