<?php

// =cryption with salt -- not sure how to decrypt
function cryptPass($input, $rounds = 6){
	$salt = "";
	$saltChars = array_merge(range('A', 'Z'), range('a','z'), range(0,9));
	for($i = 0; $i < 10; $i++){
		$salt .= $saltChars[array_rand($saltChars)];
	}
	return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
}


function Encrypt($text){
	$characters = str_split($text);
	$encrypted = '';

	foreach($characters as $character)
	{
		$encrypted .= (ord($character) * 3) . '.';
	}

	return $encrypted;
}

function Decrypt($text){
	$characters = explode('.', $text);
	$decrypted = '';

	foreach($characters as $character)
	{
		$decrypted .= (chr($character/3));
	}

	return $decrypted;
}

function enc1($string){
	$string = base64_encode($string);
	return $string;
}

function dec1($string){
	$string = base64_decode($string);
	return $string;
}

function hashword($string, $salt){
	$string = crypt($string, '$1$' . $salt . '$');
}

$pass = 'dates';
$key = 'cal';

$enc = enc1($pass, $key);
$dec = dec1($enc, $key);


print 'Pass: ' . $pass . '<br />';
print 'Enc: ' . $enc .'<br />';
print 'Dec: ' . $dec . '<br />';
print 'Key: ' . $key . '<br />';

?>