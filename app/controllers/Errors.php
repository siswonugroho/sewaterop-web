<?php

class Errors extends Controller{

    public function nodb()
    {
        $data['judul'] = 'Tidak dapat terhubung ke database';
            $this->view('templates/header', $data);
            $this->view('errors/nodb', $data);
            $this->view('templates/footer');
    }
}