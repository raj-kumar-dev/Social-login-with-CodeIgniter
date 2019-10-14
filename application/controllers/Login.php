<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	class Login extends CI_Controller {

   public $googleData=array();
   public $linkedinData=array();
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');

	}

	public function index()
	{   session_start();

		$this->linkedin();
		$this->google();
		
		if(!isset($_COOKIE['link'])){
			$constants=array_merge($this->googleData,$this->linkedinData);
		    $this->load->view('login',$constants);
		}
		unset($_COOKIE['link']);
	}

	public function linkedin(){
          
		 if(isset($_GET['code'])&&isset($_GET['state']))
			{	
				if($_COOKIE['link']=='linkedin'){
	                $code = $_GET['code'];
					$token=getLinkedinAccessToken($code);
					$header=getHeader($token);
					$profileResponse = getResponse(LINKEDIN_API_PROFILE, $token);
					$emailResponse = getResponse(LINKEDIN_API_EMAIL, $token);
		            $link='linkedin';
					$username = $profileResponse->id;
					$firstName = $profileResponse->firstName->localized->en_US;
					$lastName = $profileResponse->lastName->localized->en_US;
					$profilePicture = $profileResponse->profilePicture->{"displayImage~"}->elements[0]->identifiers[0]->identifier;
					$email = $emailResponse->elements[0]->{"handle~"}->emailAddress;
					$userData=array(
						'link'=>$link,
						'access_token'=>$token,
						'username'=>$username,
						'image'=>$profilePicture,
						'email'=>$email,
						'first_name'=>$firstName,
						'last_name'=>$lastName
					);
					//$this->load->view('home',$userData);
					print_r($userData);
				}
			}
			else
			{
				$this->linkedinData=array(
				'client_id' => LIN_CLIENT_ID,
				'client_secret' => LIN_CLIENT_SECRET,
				'redirect_uri' => LIN_REDIRECT_URL,
				'scope'=>LIN_SCOPE
				);

			} 
	}

	public function google(){

		if(isset($_GET['code']))
			{	
				if($_COOKIE['link']=='google')
				{
	                 $code = $_GET['code'];
					 $token=getGoogleAccessToken($code);
					 $header=getHeader($token);
					 $profileResponse = getResponse(GOOGLE_API_PROFILE, $token);
		             $link='google';
					
					$userData=array(
						'link'=>$link,
						'username'=>$profileResponse,
					);
					print_r($userData);
				}
			
			}
			else
			{
				$this->googleData=array(
				'google_client_id' => GOO_CLIENT_ID,
				'google_client_secret' => GOO_CLIENT_SECRET,
				'google_redirect_uri' => GOO_REDIRECT_URL,
				'google_scope'=>GOO_SCOPE_PROFILE
				);

			} 
	}

}
