<?php

define('__TIME__', time());
defined('__PARAMS_FAIL__') || define('__PARAMS_FAIL__', '参数错误');
defined('__ADD_SUCCESS__') || define('__ADD_SUCCESS__', '添加成功');
defined('__ADD_ERROR__') || define('__ADD_ERROR__', '添加失败');
defined('__EDIT_SUCCESS__') || define('__EDIT_SUCCESS__', '修改成功');
defined('__EDIT_ERROR__') || define('__EDIT_ERROR__', '修改失败');
defined('__DEL_SUCCESS__') || define('__DEL_SUCCESS__', '删除成功');
defined('__DEL_ERROR__') || define('__DEL_ERROR__', '删除失败');
defined('__SET_SUCCESS__') || define('__SET_SUCCESS__', '设置成功');
defined('__SET_ERROR__') || define('__SET_ERROR__', '设置失败');
defined('__ACTION_ERROR__') || define('__ACTION_ERROR__', '操作失败');
defined('__ACTION_SUCCESS__') || define('__ACTION_SUCCESS__', '操作成功');
defined('__DATA_NOT_EXIST__') || define('__DATA_NOT_EXIST__', '数据不存在或已删除');

//用户字段
defined('__USER_FIELD__') || define('__USER_FIELD__', [
    'avatarUrl',
    'nickName',
    'gender',
    'sign_desc',
]);

//redis键名常量
defined('__USER_OPENID__') || define('__USER_OPENID__', 'user:openid:');
defined('__USER_LOCATION__') || define('__USER_LOCATION__', 'location');

