<?php

namespace App\Controllers;

//Se trae (importa) el modelo de datos
use App\Models\AnimalModelo;

class Animales extends BaseController{
    
    public function index(){
        return view('registroAnimales');
    }

    public function registrar(){
       
        //1. Recibo todos los datos enviados desde el formulario (vista)
        //Lo que tengo entre getPost("") es el name que puse a cada input
        $nombre=$this->request->getPost("nombre");
        $foto=$this->request->getPost("foto");
        $edad=$this->request->getPost("edad");
        $descripcion=$this->request->getPost("descripcion");
        $tipo=$this->request->getPost("tipo");

        //2. Valido que llego
        if($this->validate('animales')){

            //3. se organizan los datos en un array
            //los naranjados (claves) deben coindicir
            //con el nombre de las columnas de BD
            $datos=array(
                "nombre"=>$nombre,
                "foto"=>$foto,
                "edad"=>$edad,
                "descripcion"=>$descripcion,
                "tipo"=>$tipo
            );

            //4 intentamos grabar los datos en BD
            try{

                $modelo=new AnimalModelo();
                $modelo->insert($datos);
                return redirect()->to(site_url('/animales/registro'))->with('mensaje',"exito agregando el producto");



            }catch(\Exception $error){

                return redirect()->to(site_url('/animales/registro'))->with('mensaje',$error->getMessage());
            }
           

        }else{

            $mensaje="tienes datos pendientes";
            return redirect()->to(site_url('/animales/registro'))->with('mensaje',$mensaje);
        }


        




    }

    public function buscar(){
        try{

            $modelo=new AnimalModelo();
            $resultado=$modelo->findAll();
            $animales=array('animales'=>$resultado);
            return view('listaAnimales',$animales);


        }catch(\Exception $error){
            return redirect()->to(site_url('/animales/registro'))->with('mensaje',$error->getMessage());

        }
       
    }

    public function eliminar($id){

       try{

        $modelo=new AnimalModelo();
        $modelo->where('id',$id)->delete();
        return redirect()->to(site_url('/animales/registro'))->with('mensaje',"exito eliminando el producto");




       }catch(\Exception $error){
            return redirect()->to(site_url('/animales/registro'))->with('mensaje',$error->getMessage());

        }
    }

    public function editar($id){

        //recibo datos
        $nombre=$this->request->getPost("nombre");
        $edad=$this->request->getPost("edad");

        //validacion de datos

        //Organizo los datos en un array asociativo
        $datos=array(
            'nombre'=>$nombre,
            'edad'=>$edad
        );

        //echo("estamos editando el producto ".$id);
        //print_r($datos);

        //crear un objeto del modelo
        try{

            $modelo=new AnimalModelo();
            $modelo->update($id,$datos);
            return redirect()->to(site_url('/animales/registro'))->with('mensaje',"exito editando el producto");



        }catch(\Exception $error){

            return redirect()->to(site_url('/animales/registro'))->with('mensaje',$error->getMessage());
        }

    }
    public function buscar_animales($tipo){
        try{
            $modelo= new AnimalModelo();

            $resultado = $modelo->where('tipo', $tipo)
                   ->findAll();

            $animales=array("animales"=>$resultado);
            return view('listaAnimales', $animales);

        }catch(\Exception $error){
            $mensaje=$error->getMessage();
            return redirect()->to(site_url('/animales/listado'))->with('mensaje',$mensaje);
        }
    }
}

?>