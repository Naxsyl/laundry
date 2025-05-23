<?php

$conn = mysqli_connect("localhost", "root", "", "laundry");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_outlet($data)
{
    global $conn;

    $nama_outlet = htmlspecialchars($data["nama_outlet"]);
    $alamat_outlet = htmlspecialchars($data["alamat_outlet"]);
    $telp_outlet = htmlspecialchars($data["telp_outlet"]);

    $query = "INSERT INTO tb_outlet VALUES ('', '$nama_outlet', '$alamat_outlet', '$telp_outlet')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function tambah_paket($data)
{
    global $conn;

    $nama_paket = htmlspecialchars($data["nama_paket"]);
    $jenis_paket = htmlspecialchars($data["jenis_paket"]);
    $harga_paket = htmlspecialchars($data["harga"]);
    $outlet = htmlspecialchars($data["outlet_id"]);

    $query = "INSERT INTO tb_paket (id ,nama_paket, jenis, harga, id_outlet) VALUES ('', '$nama_paket', '$jenis_paket', '$harga_paket', '$outlet')";



    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function tambah_user($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama_user"]);
    $username = mysqli_real_escape_string($conn, htmlspecialchars(strtolower(stripslashes($data["username"]))));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($data["password"]));
    $role = mysqli_real_escape_string($conn, htmlspecialchars($data["role"]));
    $outlet = mysqli_real_escape_string($conn, htmlspecialchars($data["outlet_id"]));

    $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo    "<script>
                    alert('Username sudah terdaftar');
                </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if ($outlet) {

        mysqli_query($conn, "INSERT INTO tb_user VALUES ('', '$nama', '$username', '$password', '$outlet', '$role')");
    } else {

        mysqli_query($conn, "INSERT INTO tb_user VALUES ('', '$nama', '$username', '$password', NULL, '$role')");
    }

    // if (!$hasil) {
    //     die("Query gagal: " . mysqli_error($conn));
    // }

    return mysqli_affected_rows($conn);
}

function tambah_member($data)
{
    global $conn;

    $no_ktp = htmlspecialchars($data['no_ktp']);
    $nama_member = htmlspecialchars($data['nama_member']);
    $alamat_member = htmlspecialchars(ucwords($data['alamat_member']));
    $telp_member = htmlspecialchars($data['telp_member']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);

    $result = mysqli_query($conn, "SELECT no_ktp FROM tb_member WHERE no_ktp = '$no_ktp'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('No KTP sudah digunakan!');</script>";
        return false;
    }
    $query = "INSERT INTO tb_member VALUES ('', '$nama_member', '$alamat_member', '$jenis_kelamin', '$telp_member', '$no_ktp')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

    if (!$query) {
        die("Query gagal: " . mysqli_error($conn));
    }
}



function ubah_outlet($data)
{
    global $conn;

    $id_outlet = $data["id_outlet"];
    $owner = $data["id_owner"];
    $nama_outlet = htmlspecialchars($data["nama_outlet"]);
    $alamat_outlet = htmlspecialchars($data["alamat_outlet"]);
    $telp_outlet = htmlspecialchars($data["telp_outlet"]);
    $ownerbaru = htmlspecialchars($data["owner_id_new"]);


    $query = "UPDATE tb_outlet SET nama = '$nama_outlet', alamat = '$alamat_outlet', tlp = '$telp_outlet' WHERE id = '$id_outlet'";
    $hasil = mysqli_query($conn, $query);



    if ($ownerbaru !== $owner) {
        $query3 = "UPDATE tb_user SET id_outlet = NULL WHERE id = '$owner'";
        $hasil3 = mysqli_query($conn, $query3);
    }

    $query2 = "UPDATE tb_user SET id_outlet = '$id_outlet' WHERE id = '$ownerbaru'";
    $hasil2 = mysqli_query($conn, $query2);


    if ($hasil && $hasil2 || $hasil3) {
        return true;
    } else {
        return false;
    }
}

function ubah_paket($data)
{
    global $conn;

    $id_paket = $data["id_paket"];
    $nama_paket = htmlspecialchars($data["nama_paket"]);
    $jenis_paket = htmlspecialchars($data["jenis_paket"]);
    $harga_paket = htmlspecialchars($data["harga"]);
    $outlet = htmlspecialchars($data["outlet_id"]);

    $query = "UPDATE tb_paket SET nama_paket = '$nama_paket', jenis = '$jenis_paket', harga = '$harga_paket', id_outlet = '$outlet' WHERE id = '$id_paket'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function ubah_user($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = htmlspecialchars($data["nama_user"]);
    $username = mysqli_real_escape_string($conn, htmlspecialchars(strtolower(stripslashes($data["username"]))));

    $password_baru = mysqli_real_escape_string($conn, htmlspecialchars($data["password"]));
    $role = mysqli_real_escape_string($conn, htmlspecialchars($data["role"]));


    $cekusername = mysqli_query($conn, "SELECT id FROM tb_user WHERE username = '$username' AND id != '$id_user'");
    if (mysqli_fetch_assoc($cekusername)) {
        echo "<script>alert('Username sudah digunakan oleh user lain');</script>";
        return false;
    }

    if (!empty($password_baru)) {
        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET 
                    nama = '$nama', 
                    username = '$username', 
                    password = '$password_baru', 
                    role = '$role' 
                  WHERE id = '$id_user'";
    } else {
        // Jika password tidak diisi, tetap pakai password lama
        $query = "UPDATE tb_user SET 
                    nama = '$nama', 
                    username = '$username', 
                    role = '$role' 
                  WHERE id = '$id_user'";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function ubah_member($data)
{
    global $conn;

    $id_member = $data["id"];
    $no_ktp = htmlspecialchars($data['no_ktp']);
    $nama_member = htmlspecialchars($data['nama_member']);
    $alamat_member = htmlspecialchars(ucwords($data['alamat_member']));
    $telp_member = htmlspecialchars($data['telp_member']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);

    $result = mysqli_query($conn, "SELECT no_ktp FROM tb_member WHERE no_ktp = '$no_ktp'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('No KTP sudah digunakan!');</script>";
        return false;
    }

    $query = "UPDATE tb_member SET no_ktp = '$no_ktp', nama = '$nama_member', alamat = '$alamat_member', jenis_kelamin = '$jenis_kelamin', tlp = '$telp_member' WHERE id = '$id_member'";

    $result2 = mysqli_query($conn, $query);

    if (!$result2) {
        die("Query gagal: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function hapus_member($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_member WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function hapus_outlet($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_outlet WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function hapus_paket($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_paket WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function hapus_user($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_user WHERE id = $id");

    return mysqli_affected_rows($conn);
}
