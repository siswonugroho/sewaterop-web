<?php

class User_model
{
    private $db;
    private $table = 'admin';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query("INSERT INTO $this->table (nama_admin, username, password) VALUES (:nama_admin, :username, :password)");
        $this->db->bind(':nama_admin', $data['nama_admin']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) return true;
        else return false;
    }

    public function goLogin($username, $password)
    {
        $this->db->query("SELECT * FROM $this->table WHERE username = :username");
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) return $row;
        } else return false;
    }

    public function isUsernameAlreadyExists($username)
    {
        $this->db->query("SELECT username FROM $this->table WHERE username = :username");
        $this->db->bind(':username', $username);
        $this->db->execute();

        // Cek apakah username sudah terdaftar
        if ($this->db->rowCount() > 0) return 1;
        else return 0;
    }

    public function updateUserInfo($data)
    {
        $this->db->query("UPDATE $this->table SET nama_admin = :nama_admin, username = :username WHERE id_admin = :id_admin");
        $this->db->bind(':nama_admin', $data['nama_admin']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':id_admin', $data['id_admin']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserInfo($id_admin)
    {
        $this->db->query("SELECT id_admin, username, nama_admin FROM $this->table WHERE id_admin = :id_admin");
        $this->db->bind(':id_admin', $id_admin);
        return $this->db->single();
    }
}
