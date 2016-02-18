<?php

$salt 			= '$2a$%13$' . strtr(openssl_random_pseudo_bytes(22), array('_' => '.', '~' => '/'));

// $password adalah variabel untuk password yang di crypt
$password 		= crypt('password',$salt);

// perintah sql untuk memasukan data ke tabel user
$sql_command	= mysql_query('INSERT INTO user VALUES(6,"baru","baru@gmail.co","'.$password.'","admin")');
