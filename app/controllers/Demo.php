<?php

class Demo extends Controller {
    public function index()
    {
        $data['judul'] = 'Demo';
        $this->view('templates/header', $data);
        $this->view('demo/index', $data);
        $this->view('templates/footer', $data);

    }
}