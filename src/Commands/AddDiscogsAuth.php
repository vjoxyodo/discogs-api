<?php
 
namespace Vjoxyodo\DiscogsApi\Commands;
 
use Illuminate\Console\Command;
 
class AddDiscogsAuth extends Command
{

    protected $signature = 'discogsapi:userdata';
 
 
	public function __construct()
	{
        parent::__construct();
    }

    protected $description = 'Add user tokens to Laravel .env file';
 

    public function handle(): void
    {
	    
        $DISCOGS_API_ACCESS_TOKEN = '';

        while (true) {
		    $DISCOGS_API_ACCESS_TOKEN = $this->ask('Please insert your app token?');

            if (strlen($DISCOGS_API_ACCESS_TOKEN) == 40) {
	            putenv('DISCOGS_API_ACCESS_TOKEN='$DISCOGS_API_ACCESS_TOKEN);
	            $this->info("Your token {$DISCOGS_API_ACCESS_TOKEN} has been added to your project .env with success!");
	            $this->info("Support here https://github.com/vjoxyodo/discogs-api/");	            
                break;
            } else {
                $this->error('Please enter a valid 40 chars Discogs API v2.');
            }
        }
	    
    }
}