<?php
ob_start("minifier");
function minifier($code)
{
    $search = array(

        // Remove whitespaces after tags 
        '/\>[^\S ]+/s',

        // Remove whitespaces before tags 
        '/[^\S ]+\</s',

        // Remove multiple whitespace sequences 
        '/(\s)+/s',

        // Removes comments 
        '/<!--(.|\s)*?-->/'
    );
    $replace = array('>', '<', '\\1');
    $code = preg_replace($search, $replace, $code);
    return $code;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" http-equiv="" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?> - SewaTerop</title>
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>" sizes="any" type="image/svg+xml">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-custom.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/additional.min.css'); ?>">
</head>

<body>
    <main class="row m-0">