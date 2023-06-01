<?php

require_once('./config/Database.php');


class SegmentoModel
{
    public static function buscarSegmentos()
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM segmentos';

            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function buscarSegmentoPorId($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM segmentos WHERE id_segmento = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function agregarSegmento($codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'INSERT INTO segmentos (codigo_segmento, nombre_segmento) VALUES (:codigo, :nombre)';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function actualizarSegmento($id, $codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'UPDATE segmentos SET codigo_segmento = :codigo, nombre_segmento = :nombre WHERE id_segmento = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function eliminarSegmento($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'DELETE FROM segmentos WHERE id_segmento = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
