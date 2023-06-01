<?php
require_once "./Models/OfertaModel.php";

class OfertaController
{
    public static function agregarOferta($datosOferta)
    {
        date_default_timezone_set('America/Bogota');
        $creadorOferta = "Automática";
        $fechaInicio    = date('Y-m-d');
        $horaInicio = date('H:i:s');
        $estado = 'A';

        // Calcular la fecha de cierre más un día
        $fechaCierre = date('Y-m-d', strtotime($fechaInicio . ' + 1 day'));

        $resultado = OfertaModel::agregarOferta(
            $creadorOferta,
            $datosOferta['objeto'],
            $datosOferta['descripcion'],
            $datosOferta['moneda'],
            $datosOferta['presupuesto'],
            $fechaInicio,
            $horaInicio,
            $fechaCierre,
            $estado,
            $datosOferta['actividad']
        );

        if ($resultado) {
            return $resultado;
        }

        return  false;
    }
}
