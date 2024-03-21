<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function encrypt_password($password)
{
    $salt = generateRandomString(5);
    $password_baru = $password . $salt;
    $hash = md5($password_baru);
    $data = [
        'salt' => $salt,
        'hash' => $hash
    ];
    return $data;
}