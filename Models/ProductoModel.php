<?php

require_once('./config/Database.php');


class ProductoModel
{
    public static function buscarProductos()
    {
        try {
            $conexion =  Database::obtenerConexion();;
            $sql = 'SELECT * FROM productos';

            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function agregarProducto($codigo, $nombre, $idFamilia, $idClase, $idSegmento)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'INSERT INTO productos (codigo_producto, nombre_producto, id_familia, id_clase, id_segmento) VALUES (:codigo, :nombre, :idFamilia, :idClase, :idSegmento)';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':idFamilia', $idFamilia, PDO::PARAM_INT);
            $stmt->bindParam(':idClase', $idClase, PDO::PARAM_INT);
            $stmt->bindParam(':idSegmento', $idSegmento, PDO::PARAM_INT);
            $stmt->execute();

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function actualizarProducto($id, $codigo, $nombre, $idFamilia, $idClase, $idSegmento)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'UPDATE productos SET codigo_producto = :codigo, nombre_producto = :nombre, id_familia = :idFamilia, id_clase = :idClase, id_segmento = :idSegmento WHERE id_producto = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':idFamilia', $idFamilia, PDO::PARAM_INT);
            $stmt->bindParam(':idClase', $idClase, PDO::PARAM_INT);
            $stmt->bindParam(':idSegmento', $idSegmento, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function eliminarProducto($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'DELETE FROM productos WHERE id_producto = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
