<?php


require_once('./config/Database.php');

class OfertaModel
{
    public static function agregarOferta($creador, $objeto, $descripcion, $moneda, $presupuesto, $fechaInicio, $horaInicio, $fechaCierre, $estado, $idProducto)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'INSERT INTO ofertas (creador_oferta, objeto, descripcion, moneda, presupuesto, fecha_inicio, hora_inicio, fecha_cierre, estado, id_producto) VALUES (:creador, :objeto, :descripcion, :moneda, :presupuesto, :fechaInicio, :horaInicio, :fechaCierre, :estado, :idProducto)';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':creador', $creador);
            $stmt->bindParam(':objeto', $objeto);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':moneda', $moneda);
            $stmt->bindParam(':presupuesto', $presupuesto);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':horaInicio', $horaInicio);
            $stmt->bindParam(':fechaCierre', $fechaCierre);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->execute();

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
