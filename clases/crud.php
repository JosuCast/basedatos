<?php


    class Crud extends Conexion{
        public function monstrarDatos(){
            try {
                $conexion = parent::conectar();
                $coleccion = $conexion->productos;
                $datos = $coleccion->find();
                return $datos;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function find($datos){
            try {
                $conexion = parent::conectar();
                $coleccion = $conexion->productos;
                $datos = $coleccion->find($datos);
                return $datos;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function insertarDatos($datos){
            try {
                $conexion = Conexion::conectar();
                $coleccion = $conexion->productos;
                $respuesta = $coleccion->insertOne($datos);
                return $respuesta;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function eliminarDatos($datos){
            try {
                $conexion = Conexion::conectar();
                $coleccion = $conexion->productos;
                $respuesta = $coleccion->deleteOne($datos);
                return $respuesta;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function actualizarDatos($parametros,$datos){
            try {
                $conexion = Conexion::conectar();
                $coleccion = $conexion->productos;
                $respuesta = $coleccion->updateOne($parametros,['$set'=>$datos]);
                return $respuesta;
            } catch (\Throwable $th) {
                return $th->getMessage();
            
            }
        }
    }
?>