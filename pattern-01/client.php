<?php
/**
 * request-reply 模式
 * request:  请求者(客户端)
 * Created by PhpStorm.
 * User: h2o
 * Date: 1/9/17
 * Time: 10:20 PM
 */

$context = new ZMQContext();

//新建一个请求者（客户端）
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);

//客户端连接到tcp
$requester->connect('tcp://127.0.0.1:5555');

for($i=0; $i<10; $i++){
    printf("Sending request %d...\n",$i);
    //发送数据到服务端
    $requester->send($i);

    //接受服务端返回的数据
    $reply = $requester->recv();
    printf("Received reply %d : [%s]\n",$i,$reply);
}