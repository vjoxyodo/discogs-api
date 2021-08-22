<?php

	return [
		'consumer_key' 			=> env('DISCOGS-API_CONSUMER_KEY',''),
		'consumer_shared_secret'=> env('DISCOGS-API_CONSUMER_SHARED_SECRET',''),
	    'user_agent' 			=> env('DISCOGS-API_USER-AGENT','DISCOGS-API/1 +https://github.com/vjoxyodo/discogs'),
	    'oauth_verifier'		=> env('DISCOGS-API_OAUTH_VERIFIER',''),
	    'oauth_token'			=> env('DISCOGS-API_OAUTH_TOKEN',''),
	    'access_token'			=> env('DISCOGS-API_ACCESS_TOKEN',''),
	    'access_token_secret'	=> env('DISCOGS-API_ACCESS_TOKEN_SECRET','')
	];
