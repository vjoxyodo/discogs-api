<?php
 
namespace Vjoxyodo\DiscogsApi\Commands;
 
use Illuminate\Console\Command;
 
class AddDiscogsAuth extends Command
{

    protected $signature = 'discogsapi:userdata';
 
	protected $envConstant = 'DISCOGS_API_ACCESS_TOKEN';
 
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
		    

            if (strlen($DISCOGS_API_ACCESS_TOKEN) > 1 ){ #== 40) {
   
				$file = base_path('.env');
				
				$rawData = file_get_contents($file);
				
				$data = explode("\n",$rawData);
				
				$findCheck = array_filter($data, function($value) {
				    return strpos($value, $this->envConstant . "=") !== false;
				});
				
				$answer = "no";
				
					
				if(!empty($findCheck)){
					$findKey = key($findCheck);
					
					$answer = $this->ask('You already have this env variable, are you sure you want to replace it? (yes or y)');
					
					if (in_array($answer, ["yes", "y"])){
						$data[$findKey] = $this->envConstant . "=" . $DISCOGS_API_ACCESS_TOKEN;
					}
					
				}else{
					array_push($data, $this->envConstant . "=" . $DISCOGS_API_ACCESS_TOKEN);
				}
				
				if (file_exists($file)) {
					if(in_array($answer, ["yes", "y"])){
						file_put_contents($file, implode("\n", $data));
						$this->info("Your token, <options=bold;fg=cyan;bg=black>" . $DISCOGS_API_ACCESS_TOKEN . "</> has been added to your project .env with success!");
					}
				}else{
					$this->error("Something went wrong adding your token!");
				}

				$this->support();

                break;
            } else {
                $this->error('Please enter a valid 40 chars Discogs API v2.');
            }

        }  
    }
    
    public function support(){
	    $this->info("");
	    $this->info("Support here <bg=blue;fg=green;options=underscore>https://github.com/vjoxyodo/discogs-api/</>");
	    $this->info("🔊 You can check my record collection <bg=blue;fg=green;options=underscore>https://www.discogs.com/user/vjoxyodo/collection</>, drop a message!");
	    $this->info("");
    }
}