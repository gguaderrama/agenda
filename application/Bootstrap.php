<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

protected function _initAutoload ()
    {
      $moduleLoader = new Zend_Application_Module_Autoloader(array(
         'namespace' => 'Application',
         'basePath' => APPLICATION_PATH,
         ));
                /* $moduleLoader->addResourceType('Model', 'models', 'Model');
           $moduleLoader->addResourceType('Form', 'forms', 'Form'); */
          
                return $moduleLoader;
    }
    // protected function _initAutoload(){
    //     $modelLoader = new Zend_Application_Module_Autoloader(array(
    //             'namespace' => '', 
    //             'basePath' => APPLICATION_PATH
    //         ));

    //       return $modelLoader;
    // }


    protected function _initDatabase(){
        // get config from config/application.ini
        $config = $this->getOptions();

        $db = Zend_Db::factory($config['resources']['db']['adapter'], $config['resources']['db']['params']);

        //set default adapter
        Zend_Db_Table::setDefaultAdapter($db);

        //save Db in registry for later use
        Zend_Registry::set("db", $db);
    }


    //   protected function _initAutoload()
    // {
    //     $autoLoader=Zend_Loader_Autoloader::getInstance();
    //     $resourceLoader=new Zend_Loader_Autoloader_Resource(array(
    //         'basePath'=>APPLICATION_PATH,
    //         'namespace'=>'',
    //         'resourceTypes'=>array(                
    //             'models'=>array(
    //                 'path'=>'models/',
    //                 'namespace'=>'Model_'
    //             ),                
    //         )
    //         ));


    //     $autoLoader->pushAutoloader($resourceLoader);       
    // }



/*
	    protected function _initAutoload()
    {
        $autoLoader=Zend_Loader_Autoloader::getInstance();
        $resourceLoader=new Zend_Loader_Autoloader_Resource(array(
            'basePath'=>APPLICATION_PATH,
            'namespace'=>'',
            'resourceTypes'=>array(                
                'models'=>array(
                    'path'=>'models/',
                    'namespace'=>'Model_'
                ),                
            )
            ));


        $autoLoader->pushAutoloader($resourceLoader);       
    }


	//Inicializando conexion

// create configurtions 
  protected function _initDatabase(){
        // get config from config/application.ini
        $config = $this->getOptions();

        $db = Zend_Db::factory($config['resources']['db']['adapter'], $config['resources']['db']['params']);

        //set default adapter
        Zend_Db_Table::setDefaultAdapter($db);

        //save Db in registry for later use
        Zend_Registry::set("db", $db);
    }
*/

}

