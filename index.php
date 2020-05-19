<?php 
session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");

    //jika tombol cari ditekan
    if( isset($_POST["cari"]) ) {
        $mahasiswa = cari($_POST["keyword"]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin</title>
</head>
<body>

<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post">
    <input type="text" name="keyword" size="30" autofocus placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
    <!-- <button type="submit" name="cari" id="tombol-cari">Cari</button> -->
</form>
<br>

<div id="container">
<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Email</th>
    </tr>


    <?php $i = 1; ?>
    <?php foreach ( $mahasiswa as $row) : ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td>
            <a href="ubah.php?id=<?php echo $row["id"]; ?>">Ubah</a>
            <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
        </td>
        <td><img src="img/<?php echo $row["gambar"]; ?> " width="80" alt=""></td>
        <td><?php echo $row["nrp"]; ?></td>
        <td><?php echo $row["nama"]; ?></td>
        <td><?php echo $row["jurusan"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>


</table>
</div>    

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>