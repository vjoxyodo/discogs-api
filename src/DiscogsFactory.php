<?php
	
namespace Vjoxyodo\DiscogsApi;

use Illuminate\Support\ServiceProvider;

class DiscogsFactory extends OAuthSimple
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
		parent::__construct();
			
		self::$consumer_key = (isset($_ENV['consumer_key'])) ? $_ENV['consumer_key'] : config('discogs-api.consumer_key') ; 
		self::$consumer_shared_secret = (isset($_ENV['consumer_shared_secret'])) ?  $_ENV['consumer_shared_secret'] : config('discogs-api.consumer_shared_secret') ; 
		self::$user_agent = (isset($_ENV['user_agent'])) ? $_ENV['user_agent'] :  config('discogs-api.user_agent');  
		self::$oauth_verifier = (isset($_ENV['oauth_verifier'])) ? $_ENV['oauth_verifier'] :  config('discogs-api.oauth_verifier');  
		self::$oauth_token = (isset($_ENV['oauth_token'])) ? $_ENV['oauth_token'] : config('discogs-api.oauth_token'); 

		self::$access_token = (isset($_ENV['access_token'])) ? $_ENV['access_token'] :  config('discogs-api.access_token'); 
		self::$access_token_secret = (isset($_ENV['access_token_secret'])) ? $_ENV['access_token_secret'] :  config('discogs-api.access_token_secret'); 
		
		self::$oauth_props = array(
				"oauth_token"	=> self::$access_token,
				"oauth_secret"	=> self::$access_token_secret,
        );
        
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
	        'parameters'=> $input_parameters,
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
			curl_setopt($ch, CURLOPT_URL, self::$discogs_url . $endpoint);
		}else{
			curl_setopt($ch, CURLOPT_URL, self::$discogs_url . $endpoint);			
		}
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);  
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_HEADER, $signature['header']); 
		curl_setopt($ch, CURLOPT_USERAGENT, self::$user_agent);

		$headers = array(                                                                          
			'Content-Type: application/json', 
	    	'Content-length: 0');
	    			
		if($auth==true){
			$headers[] = 'Authorization: Discogs token=' . self::$access_token;	
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

	    if($method=="POST"){
	    	curl_setopt($ch, CURLOPT_POST, TRUE);
	    }else if ($method!="GET"){
	    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	    }
	    
		$response = curl_exec($ch);
				
		if(empty($response)){
			return array("message" => $method . " action for " . $endpoint ." done with success.");
		}else{
			return json_decode($response);			
		}
	}

	public static function url_parser($options){
		$options_url = "?";
		$i = 0;
		foreach($options as $key => $value){
			$options_url.= ($i!=0 ? "&" : "") . $key . "=" . $value;
			++$i;
		}
		
		return $options_url;
	}

}