<?php

class AgendController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->getHelper('ajaxContext')->initContext();
    }

    public function indexAction()
    {
        //
        $contact = new Application_Model_Contact();
        $GetAgendaInformation = $contact->showInformationAgend();
        $this->view->assign('GetAgendaInformation', $GetAgendaInformation);
   }


    public function insertarAction(){

        $request = $this->getRequest()->getPost(); 
        $contact = new Application_Model_Contact();
        $Save = $contact->insertContacts($request);
       //Render table
        $GetAgendaInformation = $contact->showInformationAgend();  
        $RenderTable = $this->addAction($GetAgendaInformation);
        $GetArrayResponse = array('informacion'=> '' , 'html' => $RenderTable);
        echo json_encode($GetArrayResponse);
        die();
    }

    public function listAction(){

        $request = $this->getRequest()->getPost(); 
        $contact = new Application_Model_Contact();
        $GetAgendaInformation = $contact->showInformationAgend();  
        $RenderTable = $this->addAction($GetAgendaInformation);
        $id = $request['id'];
        $response = $contact->listContacts($id);
        echo json_encode($response);
        die();
    }



   public function updateAction(){

        $request = $this->getRequest()->getPost(); 
        $contact = new Application_Model_Contact();
        $response = $contact->updateContacts($request);
        $GetAgendaInformation = $contact->showInformationAgend();  
        $RenderTable = $this->addAction($GetAgendaInformation);
        $GetArrayResponse = array('informacion'=> '' , 'html' => $RenderTable);
        echo json_encode($GetArrayResponse);
        die();

    }



    public function addAction($GetAgendaInformation)
    {
      $table = '';
           $table .= '<br/><br/><table class="table table-striped table-bordered">
                <thead>
                <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th></th>
                </tr>
                </thead>
                <tbody>';
             if (isset($GetAgendaInformation)){
                foreach ($GetAgendaInformation as $key => $val){
                    $table .= '<tr>
                    <td>'.$val['nombre'].'</td>
                    <td>'.$val['apellido'].'</td>
                    <td>'.$val['direccion'].'</td>
                    <td>'.$val['correo'].'</td>
                    <td>'.$val['telefonos'].'</td>
                    <td>
                    <button data-toggle="modal" data-target="#myModal" type="button" 
                    data-id='.$val['id_contactos'].' 
                    class="btn btn-primary editar" aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" > </span>
                    </button>
                    </td>
                    </tr>';
                }
            $table .= '</tbody>
            </table>';                    
    
                
             }
           return $table;

    }


}











