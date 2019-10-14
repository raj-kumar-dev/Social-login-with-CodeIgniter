<?php 

function getLinkedinAccessToken($code = "")
	{
		$linkedInResponse = file_get_contents("https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code=".$code."&redirect_uri=".LIN_REDIRECT_URL."&client_id=".LIN_CLIENT_ID."&client_secret=". LIN_CLIENT_SECRET);
		$linkedInResponse = json_decode($linkedInResponse);
		return isset($linkedInResponse->access_token) ? $linkedInResponse->access_token : "";
	}
function getGoogleAccessToken($code = "")
	{
		$googleResponse = file_get_contents("https://accounts.google.com/o/oauth2/token?code=".$code."&client_id=".GOO_CLIENT_ID."&client_secret=".GOO_CLIENT_SECRET."&redirect_uri=".GOO_REDIRECT_URI."&grant_type=authorization_code");
		$googleResponse = json_decode($googleResponse);
		return isset($googleResponse->access_token) ? $googleResponse->access_token : "";
	}
function getHeader($access_token)
	   {
			$header = array(
				'http' => array(
							'method' => "GET",
							'header' => "Authorization: Bearer ". $access_token ."\r\n" .
							"Content-Type: application/x-www-form-urlencoded\r\n"
				)
			);
			return stream_context_create($header);
		}
function getResponse($API_URI, $access_token)
		{
			$response = file_get_contents($API_URI, false, getHeader($access_token));
			return json_decode($response);
		}
function set_linkedin_profile_session($access_token)
	   {
			$_SESSION["access_token"] = $access_token;//only one session set for profile.
			$profileResponse = getLinkedInResponse(LINKEDIN_API_PROFILE, $access_token);
			$emailResponse = getLinkedInResponse(LINKEDIN_API_EMAIL, $access_token);
			//$ci = & get_instance();
			// $firstName = $profileResponse->firstName->localized->en_US;
			// $lastName = $profileResponse->lastName->localized->en_US;
			$username = $profileResponse->id;
			$profilePicture = $profileResponse->profilePicture->{"displayImage~"}->elements[0]->identifiers[0]->identifier;
			$email = $emailResponse->elements[0]->{"handle~"}->emailAddress;
		}

?>