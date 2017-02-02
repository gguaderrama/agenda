<?php


class Application_Model_Contact 
{
 protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Contact');
        }
        return $this->_dbTable;
    }
 
      
   //  public function GetInformationAgend(){
   //      $database = Zend_Db_Table::getDefaultAdapter();
   //      $sql = $database->query("SELECT * FROM contactos");
   //      return $sql->fetchAll();
 		// $resultSet = $this->getDbTable()->fetchAll();
   //      return $resultSet;
    	
   //  } 

    public function showInformationAgend(){
    	 $database = Zend_Db_Table::getDefaultAdapter();
         $query = $database->query("call show_information(@respuesta)");
          return $query->fetchAll();
    }


    public function insertContacts($request){

        $database = Zend_Db_Table::getDefaultAdapter();
        $nombre = $request['nombre'];
        $apellido = $request['apellido'];
        $direccion = $request['direccion'];
        $correo = $request['correo'];
		$telefono = implode(",",$request['tags']);
        $query = $database->query("CALL insertar('$nombre', '$apellido', '$direccion', '$correo', '$telefono', @response)");
        $query->closeCursor();
        $respuesta = array('code'=> 200);
        return $respuesta;

    }  



    public function updateContacts($request){


        $database = Zend_Db_Table::getDefaultAdapter();
        $id = $request['id'];
        $nombre = $request['nombre'];
        $apellido = $request['apellido'];
        $direccion = $request['direccion'];
        $correo = $request['correo'];
        $telefono = implode(",",$request['tags']);
        $query = $database->query("CALL actualizar('$id', '$nombre', '$apellido', '$direccion', '$correo',
         '$telefono')");
        $query->closeCursor();
        $respuesta = array('code'=> 200);
        return $respuesta;

    }  


    public function listContacts($id){
        $database = Zend_Db_Table::getDefaultAdapter();
        $query = $database->query("CALL check_exist($id)");
        return $query->fetchAll();
    }  



 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setId($row->id)
                  ->setEmail($row->email)
                  ->setComment($row->comment)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }


}

