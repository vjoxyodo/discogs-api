<?php

	return [
		'consumer_key' 			=> env('DISCOGS_CONSUMER_KEY',''),
		'consumer_shared_secret'=> env('DISCOGS_CONSUMER_SHARED_SECRET',''),
		'access_token_secret'	=> env('DISCOGS_ACCESS_TOKEN_SECRET',''),
	    'user_agent' 			=> env('DISCOGS_USER-AGENT','')
	];
