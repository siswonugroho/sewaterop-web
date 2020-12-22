<?php

class Logout extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        unset($_SESSION['user_id'], $_SESSION['username']);
        session_destroy();
        header('location:' . BASEURL);
    }
}
