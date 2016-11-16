<?php

function SetPassword($password)
{

	// Create a 256 bit (64 characters) long random salt
	// Let's add 'something random' and the username
	// to the salt as well for added security
	$salt = hash('sha256', uniqid(mt_rand(), true) . 'something random');// . strtolower($username));
	
	// Prefix the password with the salt
	$hash = $salt . $password;
	
	// Hash the salted password a bunch of times
	for ( $i = 0; $i < 1000; $i ++ ) 
	{
	  $hash = hash('sha256', $hash);
	}
	
	// Prefix the hash with the salt so we can find it back later
	// the hash has also the salt in original salt is with password
	$hash = $salt . $hash;
	return $hash;
}


function ComparePassword($password, $hash)
{
	// The first 64 characters of the hash is the salt
	$salt = substr($hash, 0, 64);
	
	$lochash = $salt . $password;
	
	// Hash the password as we did before
	for ( $i = 0; $i < 1000; $i ++ ) 
	{
	  $lochash = hash('sha256', $lochash);
	}
	
	$lochash  = $salt . $lochash ;
	// echo "my hashed pass: ".$lochash." - ";
	return ( $lochash  == $hash);
}

?>