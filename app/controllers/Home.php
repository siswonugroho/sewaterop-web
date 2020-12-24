<?php

class Home extends Controller
{
    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Home';
            $data['nav-link'] = 'Home';
            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('home/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login' , FILTER_VALIDATE_URL));
        }
    }
}
