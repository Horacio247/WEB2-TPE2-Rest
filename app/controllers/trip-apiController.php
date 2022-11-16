<?php
require_once './app/models/trip-model.php';
require_once './app/views/api-view.php';

class ViajesApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ViajeModel();
        $this->view = new ApiView();
        
        $this->data = file_get_contents("php://input");
    }

    public function getData() {
        return json_decode($this->data);
    }

    public function getViajes($params = null) {
        $viajes = $this->model->getAllViajes();
        $this->view->response($viajes);
    }

    
    public function getViaje($params = null) {
        
        $id = $params[':ID'];
        $viaje = $this->model->getUnViaje($id);

        if ($viaje)
            $this->view->response($viaje);
        else 
            $this->view->response("Viaje no encontrado o no existe", 404);
    }

    public function insertViaje($params = null) {
        $viaje = $this->getData();

        if (empty($viaje->origen) || empty($viaje->destino) || empty($viaje->vendedor)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertUnViaje($viaje->origen, $viaje->destino, $viaje->vendedor);
            $viaje = $this->model->getUnViaje($id);
            $this->view->response($viaje, 201);
        }
    }

    public function deleteViaje($params = null) {
        $id = $params[':ID'];

        $viaje = $this->model->getUnViaje($id);
        if ($viaje) {
            $this->model->deleteViajeById($id);
            $this->view->response($viaje);
        } else 
            $this->view->response("No se puede eliminar Viaje", 404);
    }

}