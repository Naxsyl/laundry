<?php

require_once '../function.php';

$id = $_GET["id"];


if (hapus_outlet($id) > 0) {
    echo "
        <script>
            alert('Data Berhasil Dihapus!');
            document.location.href = 'outlet.php';
        </script>
        ";
} else {
    echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'outlet.php';
            </script>
            ";
}
