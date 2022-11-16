<?php

class ViajeModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=web2-tp1;charset=utf8', 'root', '');
    }

    public function getAllViajes() {
   
        $query = $this->db->prepare("SELECT * FROM viajes");
        $query->execute();

       
        $viajes = $query->fetchAll(PDO::FETCH_OBJ); 

        return $viajes;
    }

    public function getUnViaje($id) {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE id = ?");
        $query->execute([$id]);
        $viaje = $query->fetch(PDO::FETCH_OBJ);
        
        return $viaje;
    }

    public function insertUnViaje($origen, $destino, $vendedor) {
        $query = $this->db->prepare("INSERT INTO viajes (origen, destino, vendedor) VALUES (?, ?, ?)");
        $query->execute([$origen, $destino, $vendedor]);

        return $this->db->lastInsertId();
    }

    function deleteViajeById($id) {
        $query = $this->db->prepare('DELETE FROM viajes WHERE id = ?');
        $query->execute([$id]);
    }

}