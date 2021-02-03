<?php

class Admin_model
{
  private $db;
  private $table = 'admin';

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getListAdmin()
  {
    $this->db->query("SELECT id_admin, nama_admin, status_user, username FROM admin WHERE status_user NOT IN ('owner')");
    return $this->db->resultSet();
  }

  public function approveAdmin($id_admin)
  {
    $this->db->query("UPDATE admin SET status_user = 'admin' WHERE id_admin = :id_admin");
    $this->db->bind('id_admin', $id_admin);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function hapusAdmin($id_admin)
  {
    $this->db->query("DELETE FROM admin WHERE id_admin = :id_admin");
    $this->db->bind('id_admin', $id_admin);
    $this->db->execute();
    return $this->db->rowCount();
  }

}
