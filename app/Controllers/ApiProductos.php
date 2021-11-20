<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiProductos extends ResourceController{

    protected $modelName = 'App\Models\ProductoModelo';
    protected $format    = 'json';

    public function buscarProductos(){
        return $this->respond($this->model->findAll());
    }

    public function buscarProducto($id)
    {
        return $this->respond($this->model->find($id));
    }

    
}