<?php

namespace GMSmtp\Includes;


function encrypt($string = "")
{
    $key = hash('sha256', AUTH_SALT);
    $iv = substr(hash('sha256', SECURE_AUTH_SALT), 0, 16);

    return base64_encode(openssl_encrypt($string, "AES-256-CBC", $key, 0, $iv));
}


function decrypte($string = "")
{
    $key = hash('sha256', AUTH_SALT);
    $iv = substr(hash('sha256', SECURE_AUTH_SALT), 0, 16);

    return openssl_decrypt(base64_decode($string), "AES-256-CBC", $key, 0, $iv);
}
