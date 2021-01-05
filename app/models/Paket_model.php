<?php

class Paket_model {

    private $db;
    private $table = 'paket';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListPaket()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function tambahDataBarang($data)
    {
        
    }
}