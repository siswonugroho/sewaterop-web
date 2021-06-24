<?php

class Logout extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    unset($_SESSION['user_id'], $_SESSION['username']);
    session_destroy();
    redirect('login/index');
  }
}
