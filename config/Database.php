<?php

class Database {
    
    private $host            = 'localhost';
    private $dbname          = 'suplos';
    private $username        = 'root';
    private $password        = '';
    private $charset         = 'utf8';
    private static $_conn    = null;

    private function __construct()
    {
        try {
            $dns = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            self::$_conn = new PDO(
                $dns,
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * metodo implementado para evitar la creacion de multiples instancias
     * de la coneccion a la base de datos.
     * 
     * @return PDO
     */
    public static function obtenerConexion()
    {
        if (self::$_conn === null) {
            new self();
        }
        return self::$_conn;
    }

}