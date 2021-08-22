<?php

namespace Vjoxyodo\DiscogsApi;

use Illuminate\Support\ServiceProvider;

class DiscogsAPI extends DiscogsFactory
{

    public function __construct()
    {
		parent::__construct();
    }
   
	public static function getRelease($release_id, $currency="EUR"){
		
		return self::curl("GET","/releases/" . $release_id . "?" . $currency);
	}

	public static function getReleaseByUser($release_id, $username){
		
		return self::curl("GET","/releases/" . $release_id . "/rating/" . $username);
	}


	public static function getArtist($artist_id){
		return self::curl("GET","/artists/" . $artist_id);
	}
	
	
	###USER Collection - https://www.discogs.com/developers#page:user-collection
	
	public static function getUserColletionFolders($username){
		return self::curl("GET","/users/" . $username . "/collection/folders");
	}

	public static function getUserColletionFolder($username, $folder_id, $auth=true){
		return self::curl("GET","/users/" . $username . "/collection/folders/" . $folder_id, array(), $auth);
	}

	public static function getUserColletionFields($username, $auth = true){
		return self::curl("GET","/users/" . $username . "/collection/fields", array(), $auth);
	}

	public static function getUserColletionValue($username, $auth = true){
		return self::curl("GET","/users/" . $username . "/collection/value", array(), $auth);
	}

	public static function addRecordCollectionFolder($username, $folder_id, $release_id, $auth = true){
		return self::curl("POST","/users/" . $username . "/collection/folders/" . $folder_id . "/releases/" . $release_id,array(),$auth);
	}
	
	##METHODS WITH PROBLEMS
	public static function createUserCollectionFolder($username, $foldername, $auth = true){
		return self::curl("POST","/users/" . $username . "/collection/folders",array("name" => $foldername),$auth);
	}

	public static function deleteUserColletionFolder($username, $folder_id, $auth = true){
		return self::curl("DELETE","/users/" . $username . "/collection/folders/" . $folder_id, array(), $auth);
	}

	
	
}