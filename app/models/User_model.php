<?php

class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, password) VALUES (:username, :password)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) return true;
        else return false;
    }

    public function goLogin($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)) return $row;
        } else return false;
    }

    public function isUsernameAlreadyExists($username)
    {
        $this->db->query('SELECT username FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();

        // Cek apakah username sudah terdaftar
        if ($this->db->rowCount() > 0) return 1;
        else return 0;
    }
}
