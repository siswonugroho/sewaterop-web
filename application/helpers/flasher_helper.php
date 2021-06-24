<?php

function setFlash($pesan, $tipe, $icon = 'info-circle')
{
  $_SESSION['alert'] = [
    'pesan' => $pesan,
    'tipe' => $tipe,
    'icon' => $icon
  ];
}

function showFlash()
{
  if (isset($_SESSION['alert'])) {
    echo '<div class="alert alert-' . $_SESSION['alert']['tipe'] . ' alert-dismissible fade anim-fade show" role="alert">
                <svg class="bi text-' . $_SESSION['alert']['tipe'] . ' mr-2" width="24" height="24" fill="currentColor">
                    <use href="'. base_url('assets/img/bootstrap-icons-1.2.1/bootstrap-icons.svg#') . $_SESSION['alert']['icon'] . '"/>
                </svg>
            ' . $_SESSION['alert']['pesan'] . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    unset($_SESSION['alert']);
  }
}
