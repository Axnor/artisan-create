<?php
namespace Khuesmann\ArtisanCreate;

use Config;

class GenerateRepositoryFiles {

    protected $name = "";
    protected $repositoryFolder = "";
    protected $model_folder = "";
    protected $currentRepositoryFolder = "";

    public function __construct($name){
        $this->name = ucfirst($name);
        $this->initRequiredFilesAndFolders();
    }

    /**
     * Create all necessary files and Folders
     * necessary folders, ServiceProvider, Abstract Eloquent Class
     */
    public function initRequiredFilesAndFolders() 
    {
        // Create required folders
        $this->createFolders();
        
        // Create Service Provider
        $this->createRepositoryServiceProvider();

        // Create Abstract Eloquent Repository Class File if not exists
        $this->createAbstractEloquentClass();
    }

    /**
     * Create all necessary folders
     * Model, Repository and CurrentRepository Folder
     *
     * @return boolean
     */
    public function createFolders()
    {
        $this->repositoryFolder = Config::get('root.repository_folder', app_path().'/repositories');
        $this->model_folder = Config::get('root.model_folder', app_path().'/models');
        $this->currentRepositoryFolder = $this->repositoryFolder . "/" . ucfirst($this->name);

        if (!file_exists($this->repositoryFolder)) {
            mkdir($this->repositoryFolder, 0755, true);
        }

        if (!file_exists($this->model_folder)) {
            mkdir($this->model_folder, 0755, true);
        }

        if(!file_exists($this->currentRepositoryFolder)) {
            mkdir($this->currentRepositoryFolder);
        }

    }

    /**
     * Creates code for Repository Service Provider if not exists
     *
     * @return boolean
     */
    public function createRepositoryServiceProvider()
    {

        $serviceProvider = $this->repositoryFolder . "/RepositoryServiceProvider.php";
        if(!file_exists($serviceProvider))
        {
            $interface_file = fopen($serviceProvider, "w");
            $provider = dirname(__FILE__)."/dummy_files/RepositoryServiceProvider.php";
            $provider_code = file_get_contents($provider);
            fwrite($interface_file, $provider_code);
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * create the Abstract Eloquent Class
     *
     * @return boolean
     */
    public function createAbstractEloquentClass()
    {
        $abstract_eloquent = $this->repositoryFolder . "/AbstractEloquentRepository.php";
        if(!file_exists($abstract_eloquent)) {
            $abstract_eloquent_file = fopen($abstract_eloquent, "w");
            $abstract_code = file_get_contents(dirname(__FILE__)."/dummy_files/AbstractEloquentRepository.php");
            fwrite($abstract_eloquent_file, $abstract_code);

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Creates the Repository Interface File
     *
     * @return boolean
     */
    public function createRepositoryInterface()
    {
        $name = $this->name;
        $repository_interface_path = $this->currentRepositoryFolder . "/" . ucfirst($name) . "Repository.php";

        if(!file_exists($repository_interface_path))
        {
            // Create Repository Interface File
            $interface_file = fopen($repository_interface_path, "w");
            $dummy_interface_path = dirname(__FILE__) . "/dummy_files/dummy_interface.php";
            $dummy_interface = file_get_contents($dummy_interface_path);
            $code = str_replace("D_U_M_M_Y_NAME", $name, $dummy_interface);
            fwrite($interface_file, $code);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Creates Repository Query Object
     *
     * @return boolean
     */
    public function createEloquentQueryObject()
    {
        $name = $this->name;
        $queryFile = $this->currentRepositoryFolder."/Eloquent".ucfirst($name)."Repository.php";



        if(!file_exists($queryFile))
        {
            $eloquent_file = fopen($queryFile, "w");
            $dummy_eloquent_path = dirname(__FILE__)."/dummy_files/dummy_eloquentQueryObject.php";
            $dummy_queryObject = file_get_contents($dummy_eloquent_path);
            $code = str_replace("D_U_M_M_Y_NAME",$name, $dummy_queryObject);
            fwrite($eloquent_file, $code);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Creates model File if not exists
     *
     * @return boolean
     */
    public function createModel()
    {

        $name = $this->name;
        $model_class_path = $this->model_folder."/".ucfirst($name).".php";

        if(!file_exists($model_class_path))
        {
            $eloquent_file = fopen($model_class_path, "w");
            $dummy_repository_path = dirname(__FILE__)."/dummy_files/dummy_model.php";
            
            $dummy_repository = file_get_contents($dummy_repository_path);
            $code = str_replace("DU_M_M_Y_NAME_LC",lcfirst($name), $dummy_repository);
            $code = str_replace("D_U_M_M_Y_NAME_UC",$name, $code);
            fwrite($eloquent_file, $code);
            return true;
        }
        else
        {
            return false;
        }
    }


}