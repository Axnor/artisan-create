<?php
namespace Khuesmann\ArtisanCreate;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateRepository extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'create:repository';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates a Model implementing a Repository Pattern.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $modelName = $this->argument('repository_name');
        $modelName = is_null($modelName) ?  $this->ask("Type in the name of the model you want to create: ") : $modelName;
        $fileObject = new GenerateRepositoryFiles($modelName);

        $this->info(" " );
        $this->comment("Creating files ..." );
        $this->info(" " );

        // Create Model
        $model = $fileObject->CreateModel();
        if($model)
        {
            $this->info("  ... Model '".ucfirst($modelName).".php ' created" );
        }
        else
        {
            $this->error("  ... Model ' ". ucfirst($modelName) . ".php ' already exists");
        }

        // Create Repository Interface
        $interface = $fileObject->createRepositoryInterface();
        if($interface)
        {
            $this->info("  ... Repository Interface '".ucfirst($modelName)."Repository.php ' created" );
        }
        else
        {
            $this->error("  ... Repository Interface ' ". ucfirst($modelName) . "Repository.php ' already exists");
        }

        // Create Eloquent Query Object
        $eloquentQueryObject = $fileObject->createEloquentQueryObject();
        if($interface)
        {
            $this->info("  ... Eloquent Query File 'Eloquent".ucfirst($modelName)."Repository.php ' created" );
        }
        else
        {
            $this->error("  ... Eloquent Query File ' Eloquent". ucfirst($modelName) . "Repository.php ' already exists");
        }

        // Output Success Info
        $this->info(" " );
        $this->comment("... finished." );
        $this->info(" " );

        $this->call('dump-autoload');

	}


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('repository_name', InputArgument::OPTIONAL, 'Name of the Repository.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(

		);
	}

}
