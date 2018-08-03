<?php

$data = $_POST;

$domain = ltrim(ltrim($_SERVER['HTTP_HOST'], 'www.'), 'dev.');
$reply = "noreply@".$domain;
$website = $data['website'];
$sendto = $data['recipient'];
$fname = $data['firstName'];
$lname = $data['lastName'];
$addr = $data['address'];
$city = $data['city'];
$state = $data['state'];
$zip = $data['zip'];
$email = $data['email'];
$phone = $data['phone'];
$comments = $data['comments'];

';