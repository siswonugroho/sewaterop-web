<?php

class Barang_model {

    private $db;
    private $table = 'barang';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListBarang()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function tambahDataBarang($data)
    {
        
    }
}