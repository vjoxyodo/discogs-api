<?php
	
namespace Vjoxyodo\DiscogsApi;

use Illuminate\Support\ServiceProvider;

class DiscogsFactory extends DiscogsOAuth
{

 	public static $discogs_url = "https://api.discogs.com"; 
	public static $consumer_key; 
	public static $consumer_shared_secret; 
	public static $oauth_verifier;
	public static $oauth_token;
	public static $user_agent;
	public static $oauth_props;
	public static $access_token;
	public static $access_token_secret;

    public function __construct()
    {
		self::$consumer_key = config('discogs_api.consumer_key'); 
		self::$consumer_shared_secret = config('discogs_api.consumer_shared_secret'); 
		self::$user_agent = config('discogs_api.user_agent'); 
		self::$oauth_verifier = config('discogs_api.oauth_verifier'); 
		self::$oauth_token = config('discogs_api.oauth_token');

		self::$access_token = config('discogs_api.access_token'; 
		self::$access_token_secret = config('discogs_api.access_token_secret');
		
		self::$oauth_props = array(
				"oauth_token"	=> self::$access_token,
				"oauth_secret"	=> self::$access_token_secret,
        );
        
        #var_dump(__DIR__);
       # exit();

    }
    
    public static function signature($method, $endpoint, $input_parameters){
		$oauthObject = new OAuthSimple();

	    $result = $oauthObject->sign(array(
	        'path'      => 'https://api.discogs.com/oauth/access_token',
	        'parameters'=> array(
				"oauth_verifier"		=> self::$oauth_verifier,
				"oauth_token"			=> self::$oauth_token,
		     ),
	        'signatures'=> array(
				'consumer_key'     => self::$consumer_key,
			    'shared_secret'    => self::$consumer_shared_secret
			)
			));
	
		
		$oauthObject->reset();
		
	    $signature = $oauthObject->sign(array(
	        'path'		=> self::$discogs_url . $endpoint, ##/database/search
	        #'parameters'=> $input_parameters,
		    'signatures'=> self::$oauth_props,
		    'action' => $method
	        )
		);

		return $signature;
    }

	public static function curl($method='POST', $endpoint='/artists/34278', $input_parameters=array(), $auth=false){
		
		$signature = self::signature($method, $endpoint, $input_parameters);
	
		$ch = curl_init();
		if($auth==true){
			curl_setopt($ch, CURLOPT_URL, $signature['signed_url']);
		}else{
			curl_setopt($ch, CURLOPT_URL, self::$discogs_url . $endpoint);			
		}
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);  
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_HEADER, $signature['header']); 
		curl_setopt($ch, CURLOPT_USERAGENT, self::$user_agent);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array(                                                                          
			'Content-Type: application/json', 
	    	'Content-length: 0')
	    );
	    if($method=="POST"){
	    	curl_setopt($ch, CURLOPT_POST, TRUE);
	    	#curl_setopt($ch, CURLOPT_POSTFIELDS, $input_parameters);
	    }else if ($method!="GET"){
	    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	    }
	    
		$response = curl_exec($ch);
		var_dump($response);
		
		if(empty($response)){
			return array("message" => $method . " action for " . $endpoint ." done with success.");
		}else{
			return json_decode($response);			
		}
	}

}