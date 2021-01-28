<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */

//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
require_once __DIR__.'/common.php';
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{

    /**
     * @var Redis
     */
    public static $redis;


    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        $redis_config = require __DIR__.'/../../../config/redis.php';
        self::$redis = redis_connect($redis_config);
//        self::$redis->flushAll();
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
        $data = json_decode($message, true);
        if (empty($data['action']) || $data['action'] === 'ping') {
            return;
        }

        $action = $data['action'];
        $data['client_id'] = $client_id;

        if (method_exists(self::class,$action)){
            self::$action($data);
        }



    }

    /**
     * 绑定用户
     * @param $data
     */
    public static function bind_socket($data){
        Gateway::bindUid($data['client_id'],$data['open_id']);
    }


    public static function upload_location($data){
        self::$redis->geoadd(__USER_LOCATION__,$data['lon'],$data['lat'],$data['open_id']);
    }



//    /**
//     * 当用户断开连接时触发
//     * @param int $client_id 连接id
//     */
//    public static function onClose($client_id)
//    {
//        // 向所有人发送
////       GateWay::sendToAll("$client_id logout\r\n");
//    }
}
