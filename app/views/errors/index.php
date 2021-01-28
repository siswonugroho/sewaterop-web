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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
</head>
<style>
    .container {
        margin-top: 20vh;
        margin-left: 20px;
        margin-right: 20px;
        font-family: sans-serif;
        display: grid;
        place-items: center;
    }
    .text-center {
        text-align: center;
    }
    .my-0 {
        margin-top: 0;
        margin-bottom: 0;
    }
    img {
        height: 120px;
    }
    .btn {
        background-color: #2249CE;
        color: white;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        border-radius: 10px;
        padding: .8em 1.5em;
        margin: 30px 20px;
    }

</style>
<body>
    <div class="container">
        <img src="<?= BASEURL ?>/img/undraw_server_down.svg" alt="server down" class="text-center">
        <h1 class="text-center">Terjadi Kesalahan pada Server</h1>
        <p class="my-0 text-center">Coba lagi nanti. Jika masih bermasalah, <a href="mailto:support-sewaterop@gmail.com" style="color: #2249CE; text-decoration: none;">hubungi kami</a>.</p>
        <a href="javascript:history.back()" class="btn">Kembali</a>
    </div>
</body>
</html>

<?php 
ob_end_flush(); 
?> 
