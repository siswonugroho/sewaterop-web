<?php

class Errors extends Controller{

    public function index()
    {
        $data['judul'] = 'Kesalahan internal server';
            $this->view('errors/index', $data);
    }
}