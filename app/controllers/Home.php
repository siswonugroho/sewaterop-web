<?php

class Home extends Controller
{
    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Dashboard';
            $data['nav-link'] = 'Home';
            $data['count-summary'] = $this->model('Home_model')->countSummary();
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('home/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login' , FILTER_VALIDATE_URL));
        }
    }

    public function getSewaAkanBerakhir()
    {
        echo json_encode($this->model('Sewaan_model')->getSewaAkanBerakhir());
    }
    public function getSewaTerbaru()
    {
        echo json_encode($this->model('Sewaan_model')->getSewaTerbaru());
    }
}
