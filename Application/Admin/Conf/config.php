<?php
return array(
	"SiteName"=>"茶盟",
	"SiteEnName"=>"Tea",

	'AUTH_ON'           => true,                      // 认证开关
    'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
    'AUTH_GROUP'        => 'think_auth_group',        // 用户组数据表名
    'AUTH_GROUP_ACCESS' => 'think_auth_group_access', // 用户-用户组关系表
    'AUTH_RULE'         => 'think_auth_rule',         // 权限规则表
    'AUTH_USER'         => 'think_admin'             // 用户信息表

);