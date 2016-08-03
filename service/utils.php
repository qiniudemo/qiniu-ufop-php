<?php

/*
 return the 400 bad request when error
  */
function resp_error($msg)
{
    header('Content-Type: application/json', 400);
    $err = array('error' => $msg);
    $resp_body = json_encode($err);
    echo $resp_body;
}
