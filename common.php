<?php
header("Access-Control-Allow-Origin: *");
//引入常量
require_once 'config/const.php';


//公用方法
require_once 'helper/func.php';

//引入ajax文件
require_once 'ajax/ajax.php';

//引入公用配置
$common_config = require 'config/params.php';
