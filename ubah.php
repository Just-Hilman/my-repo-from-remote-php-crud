<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
    require 'functions.php';

    //ambil data dari url berdasarkan id
    $id = $_GET["id"];

    //query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id") [0];

    //cek apakah tombol submit sudah di pencet atau belum
    if( isset ($_POST["submit"]) ) {

        //cek apakah data berhasil diubah atau tidak
        if( ubah($_POST) > 0 ) {
            echo "<script>
                    alert('data berhasil diubah');
                    document.location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('data gagal diubah');
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
    <title>Ubah Data Mahasiwa</title>
</head>
<body>
    <h1>Ubah Data Mahasiwa</h1>

    <!-- harus ada dua parameter pada tag form,yaitu action dan method -->
    <form action="" method="post" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value=" <?php echo $mhs["id"]; ?> ">
        <input type="hidden" name="gambarLama" value=" <?php echo $mhs["gambar"]; ?> ">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="nama" id="nama" requiered value=" <?php echo $mhs["nama"]; ?> ">
            </li>
            <li>
                <label for="nrp">NRP :</label>
                <!-- for di label,harus sama dengan id di input -->
                <!-- name sesuaikan dengan field di database -->
                <input type="text" name="nrp" id="nrp" requiered value=" <?php echo $mhs["nrp"]; ?> ">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="jurusan" id="jurusan" requiered value=" <?php echo $mhs["jurusan"]; ?> ">
            </li>
            <li>
                <label for="email">Email :</label>
                    <!-- for di label,harus sama dengan id di input -->
                    <!-- name sesuaikan dengan field di database -->
                <input type="text" name="email" id="email" requiered value=" <?php echo $mhs["email"]; ?> ">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                    <!-- for di label,harus sama dengan id di input -->
                <img src="img/<?php echo $mhs["gambar"]; ?> ">
                    <!-- name sesuaikan dengan field di database -->
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
    
</body>
</html>