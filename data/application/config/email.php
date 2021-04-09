<?php

$data = "mzRY9lU4ZufjP979ye6fHQNx";
$ciphering = "AES-128-CTR";
$options = 0;
$encryption_iv = '1234560172101241';
$encryption_key = "5DCq49ZUiqTz9KjGrKSjSKAodjaXKl1X";

$config     ['protocol']       = 'smtp';
$config     ['smtp_port']      = 587;
$config     ['smtp_user']      = 'no-reply@nurarifin.com';
$config     ['smtp_pass']      = openssl_decrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);
$config     ['mailtype']       = 'html';
$config     ['charset']        = 'utf-8';
$config     ['smtp_host']      = 'srv99.niagahoster.com';
$config     ['smtp_crypto']    = 'tls';
$config     ['newline']        = "\r\n";
$mail_config['send_multipart'] = FALSE;
$mail_config['wordwrap']       = TRUE;

?>