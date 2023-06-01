<?php

require_once "./Models/ProductoModel.php";

class ProductoController
{
    public static function buscarProductos()
    {
        $arrayDatos        = [];
        $respuestaProducto = ProductoModel::buscarProductos();

        $arrayDatos = [
            'datos'   => $respuestaProducto,
            'estado'  => true,
            'mensaje' => 'Busqueda exitosa'
        ];

        return $arrayDatos;
    }
}
