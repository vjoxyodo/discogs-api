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
	    $this->info("Testing Command");
	    
    }
}