<?php

return array(
    'name' => 'stdcms',
    'pagesize' => 20,
    'baseRoot' => '',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => STDROOT. '/templates',
    'cookies.encrypt' => true,
    'cookies.lifetime' => '10 days',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC,
    'cookies.httponly' => true,
    'http.version' => '1.1',
    'captcha-salt' => 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ',
    'translation.default.code' => 'zh',
    'internationalization' => false,
);
