<?php

namespace Vjoxyodo\DiscogsApi;

use Illuminate\Support\ServiceProvider;

class DiscogsApi extends DiscogsFactory
{

    public function __construct()
    {
		parent::__construct();
    }
   
    /**
     * Parse method Get  - https://www.discogs.com/developers#page:database,header:database-release
     *
     * @param int $release_id - The Release ID
     * @param string $currency - Currency for marketplace data. Defaults to the authenticated users currency. Must be one of the following:
USD GBP EUR CAD AUD JPY CHF MXN BRL NZD SEK ZAR
     *
     * @return Serialize Json with result
     */
	public static function getRelease($release_id, $options=array()){
		
		$options_url = (!empty($options)) ? self::url_parser($options) : "";

		return self::curl("GET","/releases/" . $release_id . "?" . $options_url);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-release-rating-by-user-get
     *
     * @param int $release_id - The Release ID 
     * @param string $username -  The username of the rating you are trying to request
     *
     * @return Serialize Json with result
     */
	public static function getReleaseRatingByUser($release_id, $username){
		
		return self::curl("GET","/releases/" . $release_id . "/rating/" . $username);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-release-rating-by-user-put
     *
     * @param int $release_id - The Release ID 
     * @param string $username -  The username of the rating you are trying to request
     * @param int $rating - The new rating for a release between 1 and 5 
     *
     * @return Serialize Json with result
     */
	public static function updateReleaseRatingByUser($release_id, $username, $rating, $auth=true){
		
		return self::curl("PUT","/releases/" . $release_id . "/rating/" . $username , array("rating" => $rating),$auth);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-release-rating-by-user-delete
     *
     * @param int $release_id - The Release ID 
     * @param string $username -  The username of the rating you are trying to request.
     *
     * @return Serialize Json with result
     */
	public static function deleteReleaseRatingByUser($release_id, $username, $auth=true){
		
		return self::curl("DELETE","/releases/" . $release_id . "/rating/" . $username, array(), $auth);
	}
	
    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-community-release-rating
     *
     * @param int $release_id - The Release ID 
     *
     * @return Serialize Json with result
     */
	public static function getCommunityReleaseRating($release_id){
		
		return self::curl("GET","/releases/" . $release_id . "/rating");
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-release-stats
     *
     * @param int $release_id - The Release ID 
     *
     * @return Serialize Json with result
     *		This endpoint is broken for long time - thread in Discogs Forum https://www.discogs.com/forum/thread/865093?page=1
     */
	public static function getReleaseStats($release_id){
		
		return self::curl("GET","/releases/" . $release_id . "/stats");
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-master-release
     *
     * @param int $master_id - The Master ID 
     *
     * @return Serialize Json with result
     */
	public static function getMasterRelease($master_id){
		
		return self::curl("GET","/masters/" . $master_id);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-master-release-versions
     *
     * @param int $master_id - The Master ID 
     * @param array $options - Array of options:
     * 	page - The page you want to request
     *  per_page - The number of items per page
     *  format - The format to filter
     *	label - The label to filter
     *  release - The release year to filter	  
     *	country - The country to filter
     *	sort - Sort items by this field:
	 *		released (i.e. year of the release)
	 *		title (i.e. title of the release)
	 *		format
	 *		label
	 *		catno (i.e. catalog number of the release)
	 *		country
	 *	sort_order - Sort items in a particular order (one of asc, desc)
     *
     * @return Serialize Json with result
     */
	public static function getMasterReleaseVersions($master_id, $options=array()){
		
		$options_url = (!empty($options)) ? self::url_parser($options) : "";
		
		return self::curl("GET","/masters/" . $master_id . "/versions" . $options_url);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-artist
     *
     * @param int $artist_id - The Master ID 
     *
     * @return Serialize Json with result
     */
	public static function getArtist($artist_id){
		return self::curl("GET","/artists/" . $artist_id);
	}
	
    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-artist-releases
     *
     * @param int $artist_id - The Master ID 
     * @param array $options - Array of options:
     *	sort - Sort items by this field: - Default year
	 *		year (i.e. year of the release)
	 *		title (i.e. title of the release)
	 *		format
	 * 	sort_order - Sort items in a particular order (one of asc, desc) - Default asc
     *
     * @return Serialize Json with result
     */
	public static function getArtistReleases($artist_id, $options){
		
	$options_url = (!empty($options)) ? self::url_parser($options) : "";

		return self::curl("GET","/artists/" . $artist_id . "/releases" . $options_url);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-label
     *
     * @param int $label_id - The Label ID
     *
     * @return Serialize Json with result
     */
	public static function getLabel($label_id){
		return self::curl("GET","/labels/" . $label_id);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-all-label-releases
     *
     * @param int $label_id - The Label ID
     * @param array $options - Array of options:
     * 	page - The page you want to request
     *  per_page - The number of items per page
     *
     * @return Serialize Json with result
     */
	public static function getLabelReleases($label_id, $options=array()){
		$options_url = (!empty($options)) ? self::url_parser($options) : "";
		
		return self::curl("GET","/labels/" . $label_id . "/releases" . $options_url);
	}

    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-all-label-releases
     *
     * @param array $options - Array of options:
     * 	q - Your search query
     * 	type - String. One of release, master, artist, label
     * 	title - Search by combined “Artist Name - Release Title” title field.
     * 	release_title - Search release titles.
     * 	credit - Search release credits.
     * 	artist - Search artist names.
     * 	anv - Search artist ANV.
     * 	label - Search label names.
     *  genre - Search genres.
     *  style - Search styles.
     *  country - Search release country.
     *  year - Search release year.
     *  format - Search formats.
     *  catno - Search catalog number.
     *  barcode - Search barcodes.
     *  track - Search track titles.
     *  submitter - Search submitter username.
     *	contributor - Search contributor usernames.
     * 	page - The page you want to request
     *  per_page - The number of items per page
     *
     * @return Serialize Json with result
     */
	public static function databaseSearch($options=array(), $auth=true){
		$options_url = (!empty($options)) ? self::url_parser($options) : "";
		
		return self::curl("GET","/database/search" , $options_url, $auth, $auth);
	}


    /**
     * Parse method Get - https://www.discogs.com/developers#page:database,header:database-release-stats
     *
     * @param int $release_id - The Release ID 
     * @param string $username -  The username of the rating you are trying to request.
     *
     * @return Serialize Json with result
     */
	public static function getRelease1Stats($release_id, $currency="EUR", $auth=true){
		
		return self::curl("GET","/marketplace/stats/" . $release_id . "?" . $currency);
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
		return parent::curl("GET","/users/" . $username . "/collection/value", array(), $auth);
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