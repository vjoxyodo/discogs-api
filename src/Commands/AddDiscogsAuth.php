<?php
 
namespace Vjoxyodo\DiscogsApi\Commands;
 
use Illuminate\Console\Command;
 
class AddDiscogsAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discogsapi:userdata';
 
 
	public function __construct()
	{
        parent::__construct();
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user tokens to Laravel .env file';
 
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
	    
		// Initialize variable to store the user's name
        $DISCOGS_API_ACCESS_TOKEN = '';

        // Loop until a valid string is entered
        while (true) {
		    $DISCOGS_API_ACCESS_TOKEN = $this->ask('Please insert your app token?');

            // Check if the input is a valid string
            if (strlen($DISCOGS_API_ACCESS_TOKEN) == 40) {
	            putenv('DISCOGS_API_ACCESS_TOKEN='$DISCOGS_API_ACCESS_TOKEN);
	            $this->info("Your token {$DISCOGS_API_ACCESS_TOKEN} has been added to your project .env with success!");
	            $this->info("Support here https://github.com/vjoxyodo/discogs-api/")
	            $this->
	            
                break;
            } else {
                $this->error('Please enter a valid 40 chars Discogs API v2.');
            }
        }
        
        return Command::SUCCESS;
	    
    }
}