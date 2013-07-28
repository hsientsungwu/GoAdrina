<?php

require($_SERVER['DOCUMENT_ROOT'] . '/config.php');

$type = 'Facebook';
$message = 'Facebook is unable to login';

log_error(array('type' => $type, 'message' => $message));