<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'includes/recaptchalib.php';
$publickey = "6LcFGvYSAAAAALa4odPvBYuUU7lXZ1lVHE0opKPW";
$privatekey = "6LcFGvYSAAAAAER_cnBscA8RZdvjjT4BGPJNJ7WZ";
$resp = recaptcha_check_answer ($privatekey,
        $_POST['remoteip'],
        $_POST["challenge"],
        $_POST["response"]);
if (!$resp->is_valid) 
{
    echo json_encode($resp);
} 
else 
{
    echo json_encode(true);
}