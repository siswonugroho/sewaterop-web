<?php

class User_model extends CI_Model
{

  private $table = 'admin';

  public function register($data)
  {
    $sql = "INSERT INTO $this->table (nama_admin, username, status_user, password) VALUES (?, ?, ?, ?)";
    $query = $this->db->query($sql, array($data['nama_admin'], $data['username'], $data['status_user'], $data['password']));
    return $query;
  }

  public function goLogin($username, $password)
  {
    $sql = "SELECT * FROM $this->table WHERE username = ?";
    $query = $this->db->query($sql, array($username));
    $row = $query->row();

    if (isset($row)) {
      $hashedPassword = $row->password;
      if (password_verify($password, $hashedPassword)) return $row;
    } else return false;
  }

  public function isUsernameAlreadyExists($username)
  {
    $sql = "SELECT username FROM $this->table WHERE username = ?";
    $query = $this->db->query($sql, array($username));
    
    // Cek apakah username sudah terdaftar
    if ($query->num_rows() > 0) return true;
    else return false;
  }

  public function updateUserInfo($data)
  {
    $sql = "UPDATE $this->table SET nama_admin = ?, username = ? WHERE id_admin = ?";
    $query = $this->db->query($sql, array($data['nama_admin'], $data['username'], $data['id_admin']));
    return $query;
  }

  public function getUserInfo($id_admin)
  {
    $sql = "SELECT id_admin, username, nama_admin FROM $this->table WHERE id_admin = ?";
    $query = $this->db->query($sql, array($id_admin));
    return $query->row_array();
  }
}
