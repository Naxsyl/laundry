<?php
require 'functions.php';
$sql = "DELETE FROM paket WHERE id_paket =" . stripslashes($_GET['id']);
$exe = mysqli_query($conn,$sql);
if ($exe) {
        $success = 'true';
        $title = 'berhasil';
        $message = 'menghapus Data';
        $type = 'success';
        header('location: paket.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
}


?>