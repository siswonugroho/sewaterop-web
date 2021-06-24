<?php

class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Home_model');
    $this->load->model('Sewaan_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Dashboard';
      $data['nav_link'] = 'Home';
      $data['count_summary'] = $this->Home_model->countSummary();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('home', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('Login');
    }
  }

  public function getSewaAkanBerakhir()
  {
    $this->responsejson->send_response_json($this->Sewaan_model->getSewaAkanBerakhir());
  }
  public function getSewaTerbaru()
  {
    $this->responsejson->send_response_json($this->Sewaan_model->getSewaTerbaru());
  }
}
