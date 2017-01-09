<?php
/**
 * request-reply 模式
 * reply:  响应者（服务端）
 * Created by PhpStorm.
 * User: h2o
 * Date: 1/9/17
 * Time: 10:20 PM
 */

//新建一个上下文
$context = new ZMQContext(1);

//生产一个 响应者(服务端)
$responder = new ZMQSocket($context,ZMQ::SOCKET_REP);

//响应者绑定到tcp
$responder->bind('tcp://127.0.0.1:5555');

while(true){
    //接受客户端请求的数据
    $request = $responder->recv();
    printf("Received request : [%s]\n", $request);

    //处理业务逻辑

    sleep(1);

    //发送数据给该请求者
    $responder->send("Request data md5 is : [".md5($request)."]");
}