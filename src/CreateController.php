<?php
namespace Khuesmann\ArtisanCreate;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateController extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a Controller.';

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
        // Get the Name of the Model you want to control and save in in LC and UC.
        $controllerName = $this->argument('newController');
        $controllerName = is_null($controllerName) ?  $this->ask("Controler Name: ") : $controllerName;

        // Get the name of the Module where you want to locate your Controller
        $module_name = $this->ask("Type in your Module Name ('n' for /app/controllers)");
        $module_path = $this->option('module_path');

        // Check if modules are used
        if($module_name != 'n')
        {
            // Check if ' --module_path' option is set and define path to modules
            if(is_null($module_path)) {
                $controller_path = Config::get('root.module_path') . "/".$module_name."/controllers/".ucfirst($controllerName)."Controller.php";
            }
            else {
                $controller_path = base_path() ."/". $module_path . $module_name . "/controllers/" . ucfirst($controllerName) . "Controller.php";
            }
        }
        else {
            $controller_path = app_path() ."/controllers/".ucfirst($controllerName)."Controller.php";
        }

        // If the Controller doesn't exist write new files
        if (!file_exists($controller_path)) 
        {
            $this->info("Generating new Controller ' ".ucfirst($controllerName)." '..." );
            $this->info(" " );

            // Generate new Controller File
            $controller_file = fopen($controller_path, "w");
            fwrite($controller_file, $this->createControllerCode($controllerName, $module_name)) or $this->error("Controller can not be created in this module");

            $this->info("  ... File ' ".$controller_path . " ' created" );
        }
        else {
            $this->error("Controller ' ". ucfirst($controllerName) . " ' already exists");
            return;
        }


        $this->info(" " );
        $this->info("Controller ' ".ucfirst($controllerName) . " ' was created successfully." );
    }

    public function createControllerCode($name, $module = '\Your\Namespace')
    {
        $dummy_repository_path = dirname(__FILE__)."/dummy_files/dummy_controller.php";
        $dummy_repository = file_get_contents($dummy_repository_path);
        $code = str_replace("DU_M_M_Y_NAME_LC",lcfirst($name), $dummy_repository);
        $code = str_replace("D_U_M_M_Y_NAME",ucfirst($name), $code);
        $code = str_replace("M_O_D_U_L_E_NAME", ucfirst($module), $code);
        return $code;
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('newController', InputArgument::OPTIONAL, 'Name of the model you want to control.'),
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
            array('module_path', null, InputOption::VALUE_OPTIONAL, 'Path to the modules.', null),
        );
    }

}
