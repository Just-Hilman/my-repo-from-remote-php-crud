<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
    require 'functions.php';
    //cek apakah tombol submit sudah di pencet atau belum
    if( isset ($_POST["submit"]) ) {
        // var_dump($_POST);
        // var_dump($_FILES); die;

        //cek apakah data berhasil ditambahkan atau tidak
        if( tambah($_POST) > 0 ) {
            echo "<script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('data gagal ditambahkan');
                    document.location.href = 'index.php';
                </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Mahasiwa</title>
</head>
<body>
    <h1>Tambah Data Mahasiwa</h1>

    <!-- harus ada dua parameter pada tag form,yaitu action dan method -->
    <form action="" method="post" enctype="multipart/form-data"> 
        <ul>
            <li>
                <label for="nama">Nama :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="nama" id="nama" requiered>
            </li>
            <li>
                <label for="nrp">NRP :</label>
                <!-- for di label,harus sama dengan id di input -->
                <!-- name sesuaikan dengan field di database -->
                <input type="text" name="nrp" id="nrp" requiered>
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="jurusan" id="jurusan" requiered>
            </li>
            <li>
                <label for="email">Email :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="email" id="email" requiered>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
    
</body>
</html>