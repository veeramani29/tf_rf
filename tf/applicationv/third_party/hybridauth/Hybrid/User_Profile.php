<?php

class Hybrid_User_Profile
{
	/* The Unique user's ID on the connected provider */
	public $identifier = NULL;

	/* User website, blog, web page */
	public $webSiteURL = NULL;

	/* URL link to profile page on the IDp web site */
	public $profileURL = NULL;

	/* URL link to user photo or avatar */
	public $photoURL = NULL;

	/* User dispalyName provided by the IDp or a concatenation of first and last name. */
	public $displayName = NULL;

	/* A short about_me */
	public $description = NULL;

	/* User's first name */
	public $firstName = NULL;

	/* User's last name */
	public $lastName = NULL;

	/* male or female */
	public $gender = NULL;

	/* language */
	public $language = NULL;

	/* User age, we dont calculate it. we return it as is if the IDp provide it. */
	public $age = NULL;

	/* User birth Day */
	public $birthDay = NULL;

	/* User birth Month */
	public $birthMonth = NULL;

	/* User birth Year */
	public $birthYear = NULL;

	/* User email. Note: not all of IDp garant access to the user email */
	public $email = NULL;
	
	/* Verified user email. Note: not all of IDp garant access to verified user email */
	public $emailVerified = NULL;

	/* phone number */
	public $phone = NULL;

	/* complete user address */
	public $address = NULL;

	/* user country */
	public $country = NULL;

	/* region */
	public $region = NULL;

	/** city */
	public $city = NULL;

	/* Postal code  */
	public $zip = NULL;
}
