<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('mime.php');
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
$phone2 = $data['cellPhone'];
$phone3 = $data['workPhone'];
$type = $data['type'];
$movein = $data['movein'];
$term = $data['term'];
$pets = $data['pets'];
$pettype = $data['petType'];
$comments = $data['comments'];

$message = '

First Name: '.$fname.'<br />
Last Name: '.$lname.'<br />
Address: '.$addr.'<br />
Address2:<br />
City: '.$city.'<br />
State: '.$state.'<br />
Zip: '.$zip.'<br />
Home Phone: '.$phone.'<br />
Cell Phone: '.$phone2.'<br />
Work Phone: '.$phone3.'<br />
Email Address: '.$email.'<br />
Lead Channel: Property Website<br />
Lead Priority: 1<br />
Desired Move In: '.$movein.'<br />
Desired Lease Term: '.$term.'<br />
Desired Unit Type: '.$type[0].' '.$type[1].' '.$type[2].'<br />
Desired Bedrooms:<br />
Desired Bathrooms:<br />
Pets: '.$pets.'<br />
Pet Types:'.$pettype.'<br />
Comments: '.$comments.'<br />

';


$headers  = 'From: '.$reply . "\r\n";
$headers .= 'Reply-To: ' .$reply . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
if(mail($sendto, '‐‐New Email Lead For Dylan‐‐', $message, $headers, '-'.$reply)){
	echo 'sent';
} else {
	echo 'not sent';
}