<?php

require_once('./config/Database.php');


class ClaseModel
{
    public static function buscarClases()
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM clases';

            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function buscarClasePorId($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM clases WHERE id_clase = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function agregarClase($codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'INSERT INTO clases (código_clase, nombre_clase) VALUES (:codigo, :nombre)';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function actualizarClase($id, $codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'UPDATE clases SET código_clase = :codigo, nombre_clase = :nombre WHERE id_clase = :id';

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

    public static function eliminarClase($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'DELETE FROM clases WHERE id_clase = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
