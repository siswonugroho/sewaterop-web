<?php

function formatRupiah($angka)
{
  $hasil_rupiah = number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}

function startsWith($string, $startString)
{
  $len = strlen($startString);
  return (substr($string, 0, $len) === $startString);
}
