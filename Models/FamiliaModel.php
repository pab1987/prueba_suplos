<?php
require_once('./config/Database.php');

class FamiliaModel
{
    public static function buscarFamilias()
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM familias';

            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function buscarFamiliaPorId($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'SELECT * FROM familias WHERE id_familia = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function agregarFamilia($codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'INSERT INTO familias (código_familia, nombre_familia) VALUES (:codigo, :nombre)';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function actualizarFamilia($id, $codigo, $nombre)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'UPDATE familias SET código_familia = :codigo, nombre_familia = :nombre WHERE id_familia = :id';

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

    public static function eliminarFamilia($id)
    {
        try {
            $conexion = Database::obtenerConexion();
            $sql = 'DELETE FROM familias WHERE id_familia = :id';

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
