<?php

class EditAkun extends Controller
{

    public function changeUserInfo()
    {
        if (Session::isLoggedIn()) {
            $data['user_info'] = $this->model('User_model')->getUserInfo($_SESSION['user_id']);
            $data['judul'] = 'Edit Profil';
            $data['nav-link'] = 'Edit Profil';

            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('editakun/changeuserinfo', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function saveUserInfo()
    {
        if (Session::isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitasi data post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if ($this->model('User_model')->updateUserInfo($_POST) > 0) {
                    Flasher::setFlash('Profil berhasil diperbarui', 'success', 'check-circle');
                    $_SESSION['nama_admin'] = $_POST['nama_admin'];
                    header('location:' . filter_var(BASEURL . '/home', FILTER_VALIDATE_URL));
                    exit;
                } else {
                    Flasher::setFlash('Gagal memperbarui profil', 'danger', 'x-circle');
                    header('location:' . filter_var(BASEURL . '/home', FILTER_VALIDATE_URL));
                    exit;
                }
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }
}
