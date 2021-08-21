<?php

namespace Vjoxyodo\Discogsapi;

use Illuminate\Support\ServiceProvider;
use Jolita\DiscogsApi\DiscogsApi;
use GuzzleHttp\Client;

class ExtraFunctions
{
	

	public static function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
    private static function _oauthEscape($string) 
    {
        if ($string === 0) { return 0; }
		if ($string == '0') { return '0'; }
        if (strlen($string) == 0) { return ''; }
        if (is_array($string)) {
            throw new OAuthSimpleException('Array passed to _oauthEscape');
		}
        $string = rawurlencode($string);

	    //FIX: rawurlencode of ~ 
       	$string = str_replace('%7E','~', $string);
       	$string = str_replace('+','%20',$string);
        $string = str_replace('!','%21',$string);
        $string = str_replace('*','%2A',$string);
        $string = str_replace('\'','%27',$string);
        $string = str_replace('(','%28',$string);
        $string = str_replace(')','%29',$string);		

        return $string;
    }


}