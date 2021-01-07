<?php

class ImageUploader
{

    public static function checkAndUploadImage($foto, $path)
    {
        $namaFile = $foto['name'];
        $tipeFile = $foto['type'];
        $tmpFile = $foto['tmp_name'];
        $tipeFileValid = ['image/jpeg', 'image/jpg', 'image/png'];

        // cek apakah tipe file yg diupload berupa file gambar
        if (!in_array($tipeFile, $tipeFileValid)) return false;

        // ubah nama file menjadi random
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        $namaFileBaru = md5(uniqid());
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;

        if (!is_dir($path)) mkdir($path, 0777, true);
        // move_uploaded_file($tmpFile, $path . $namaFileBaru);
        self::compressImage($tmpFile, $path . $namaFileBaru, 60);

        return $namaFileBaru;
    }

    public static function compressImage($source, $path, $quality = 80)
    {
        $imageSize = getimagesize($source);
        if ($imageSize['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
        else if ($imageSize['mime'] == 'image/png') $image = imagecreatefrompng($source);
        imagejpeg($image, $path, $quality);
        imagedestroy($image);
    }
}
