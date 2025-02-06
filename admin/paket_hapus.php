<?php

require_once '../function.php';

$id = $_GET["id"];


if (hapus_paket($id) > 0) {
    echo "
        <script>
            alert('Data Berhasil Dihapus!');
            document.location.href = 'paket.php';
        </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'paket.php';
            </script>
            ";
}
