<?php
 
namespace Vjoxyodo\DiscogsApi;
 
use Illuminate\Console\Command;
 
class AddDiscogsAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discogsapi:userdata';
 
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
	    echo "Testing Command";
	    
    }
}