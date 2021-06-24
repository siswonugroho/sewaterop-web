<?php

class Admin_model extends CI_Model
{
  private $table = 'admin';

  public function getListAdmin()
  {
    $query = $this->db->query("SELECT id_admin, nama_admin, status_user, username FROM $this->table WHERE status_user NOT IN ('owner')");
    return $query->result_array();
  }

  public function approveAdmin($id_admin)
  {
    return $this->db->query("UPDATE $this->table SET status_user = 'admin' WHERE id_admin = ?", array($id_admin));
  }

  public function hapusAdmin($id_admin)
  {
    return $this->db->query("DELETE FROM $this->table WHERE id_admin = ?", array($id_admin));
  }
}
