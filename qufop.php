<?php
require_once("config.php");
require_once("service/md5.php");
require_once("service/utils.php");

/*POST /uop HTTP/1.1
Content-Type: application/json

{
    "cmd": "<ufop>/<param>",
    "src": {
        "url": "http://<host>:<port>/<path>",
        "mimetype": "<mimetype>",
        "fsize": <filesize>,
        "bucket": <bucket>,
        "key": <key>
    }
}*/

$post_body = @file_get_contents('php://input');
$post_body_obj = json_decode($post_body);

//parse the cmd and options
$cmd = $post_body_obj->cmd;

//trim the left ufop prefix
$raw_cmd = ltrim($cmd, UFOP_PREFIX);

//call the service
if (preg_match('/^md5$/', $raw_cmd) == 1) {
    $file_url = $post_body_obj->src->url;
    get_file_md5($file_url);
} else {
    resp_error("no service found");
}