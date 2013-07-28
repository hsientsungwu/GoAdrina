<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$fbSetting = new FacebookSetting();

$facebook = new Facebook(array(
  'appId'  => $fbSetting->appId,
  'secret' => $fbSetting->appSecret,
));

// Get User ID
$user = $facebook->getUser();

var_dump($user);