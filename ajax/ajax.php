<?php

/**
 * 获取openid和判断是否存在该用户
 */
function ajax_get_open_id(){
    $code = I('code');

    if (!$code){
        J([
            'isSuccess'=>false,'msg'=>__PARAMS_FAIL__
        ]);
    }

    $wechat_mp = params('wechat_mp');
    $redis = redis_connect();
    $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$wechat_mp['app_id']}&secret={$wechat_mp['app_secret']}&js_code={$code}&grant_type=authorization_code";

    $result = _curl_($url);
    $result = json_decode($result,true);
//    D($result);
    if ($result['errcode']){
        J([
            'isSuccess'=>false,'msg'=>$result['errmsg']
        ]);
    }




    J([
        'isSuccess'=>true,
        'openid'=>$result['openid']??'',
        'session_key'=>$result['session_key'],
        'is_auth'=>intval( $redis->exists(__USER_OPENID__.$result['openid'])),
    ]);

}

/**
 * 获取用户信息
 */
function ajax_get_user_detail(){
    include_once "./tools/wechat_mp/wxBizDataCrypt.php";
    $wechat_mp = params('wechat_mp');
    $redis = redis_connect();

    $appid = $wechat_mp['app_id'];
    $sessionKey = I('session_key');
    $encryptedData=I('encryptedData');
    $iv = I('iv');

    $pc = new WXBizDataCrypt($appid, $sessionKey);
    $errCode = $pc->decryptData($encryptedData, $iv, $data );
    $data = json_decode($data,true);
    if ($errCode == 0) {
        unset($data['watermark']);
        $redis->setnx(__USER_OPENID__.$data['openId'],json_encode($data));
        J([
            'isSuccess'=>true,'msg'=>'授权成功','data'=>$data,
        ]);
    } else {
        J([
            'isSuccess'=>false,'msg'=>'授权失败','debug'=>$errCode
        ]);
    }


}

/**
 * 获取用户信息
 */
function ajax_get_user(){
    $openid = I('openid')?:I('open_id');
    if (!$openid){
        J([
            'isSuccess'=>false,'msg'=>__PARAMS_FAIL__
        ]);
    }

    $redis = redis_connect();
    $data = $redis->get(__USER_OPENID__.$openid);

    J([
        'isSuccess'=>true,
        'data'=>json_decode($data),
    ]);

}

function ajax_update_user_detail(){
    $key = I('key');
    $value = I('value');
    $openid = I('openid');

    if (!$key || !$openid){
        J([
            'isSuccess'=>false,'msg'=>__PARAMS_FAIL__
        ]);
    }

    if (!$value){
        J([
            'isSuccess'=>false,'msg'=>"请输入内容"
        ]);
    }



    $redis = redis_connect();
    $user = $redis->get(__USER_OPENID__.$openid);
    $user = json_decode($user,true);
    if (!$user){
        J([
            'isSuccess'=>false,'msg'=>"不存在该用户"
        ]);
    }
    if(!in_array($key,__USER_FIELD__)){
        J([
            'isSuccess'=>false,'msg'=>"修改数据异常"
        ]);
    }

    $user[$key] = $value;

    $result = $redis->set(__USER_OPENID__.$openid,json_encode($user));

    if (!$result){
        J([
            'isSuccess'=>false,'msg'=>__EDIT_ERROR__
        ]);
    }

    J([
        'isSuccess'=>true,'msg'=>__EDIT_SUCCESS__
    ]);

}

/**
 * 获取附近的人
 */
function ajax_get_near(){
    $openid = I('open_id');
    if(!$openid){
        J([
            'isSuccess'=>false,
            'msg'=>__PARAMS_FAIL__
        ]);
    }
    $redis = redis_connect();
    $data = $redis->georadiusbymember(__USER_LOCATION__,$openid,100000,'m',['ASC','WITHDIST']);
    if (!$data){
        J([
            'isSuccess'=>true,
            'msg'=>'附近没有人哦~'
        ]);
    }

    $near_user = [];
    foreach ($data as $v){
        $near_user_detail = json_decode($redis->get(__USER_OPENID__.$v[0]),true);
        $near_user_detail['distance'] = $v[1]*1;
        $near_user_detail['is_me'] = $near_user_detail['openId'] === $openid;
        $near_user[] = $near_user_detail;
    }

    J([
        'isSuccess'=>true,
        'msg'=>'加载附近的人成功',
        'data'=>$near_user,
    ]);

}


