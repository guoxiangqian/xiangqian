<?php
$secret    = "aiden";//github的webhook 设置的密匙
$path      = "/home/aiden/www/xiangqian";//项目所在路径
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
echo 111;
if ($signature) {
    $rawPost=file_get_contents("php://input");
    $hash = "sha1=".hash_hmac('sha1', $rawPost, $secret);
    if (strcmp($signature, $hash) == 0) {
        echo shell_exec("cd {$path} && /usr/bin/git reset --hard origin/master && /usr/bin/git clean -f && /usr/bin/git pull 2>&1");
        exit();
    }
}

http_response_code(404);
