<?php
/**
 * @var $redis
 * @var $common_config
 */
require_once 'common.php';
test_redis();
//自动加载
$do = I('do');
$method = "{$common_config['method_prefix']}{$do}";
if (function_exists($method)){
    $method();
}













