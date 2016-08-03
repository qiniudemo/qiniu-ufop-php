<?php

/*
1. download the file
2. calc the md5 of file content
3. write the md5 result to response
*/
function get_file_md5($file_url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $file_url);
    ob_start();
    $ch_ret = curl_exec($ch);
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        curl_close($ch);
        ob_end_clean();
        resp_error("download file failed");
        return;
    }

    //read file content
    curl_close($ch);
    $file_data = ob_get_contents();
    ob_end_clean();

    //calc the file content md5
    $md5 = md5($file_data);
    $resp = array('md5' => $md5);
    $resp_data = json_encode($resp);
    header("Content-Type: application/json");
    echo $resp_data;
}