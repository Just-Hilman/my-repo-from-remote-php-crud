<?php 
    //koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "phpdasar");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = []; 
        while ($row = mysqli_fetch_assoc($result)) {
            $rows [] = $row; //harus ada[], kalau tidak ada akan error "illergal string offset
        }
        return $rows;
    }


    function tambah($data){
        global $conn;
        //ambil data dari tiap elemen di dalam form
        $nama = htmlspecialchars ( $data["nama"] );
        $nrp = htmlspecialchars( $data["nrp"] );
        $jurusan = htmlspecialchars ( $data["jurusan"] );
        $email = htmlspecialchars ( $data["email"] );

        //upload gambar
        $gambar = upload();
        if( !$gambar) {
            return false;
        }


        //query insert data
        $query = "INSERT INTO mahasiswa VALUES ('', '$nrp', '$nama', '$jurusan', '$email', '$gambar') ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

    }


    function upload() {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        //cek apakah tidak ada gambar yang diupload
        if( $error === 4 ) {
            echo "<script> alert('pilih gambar dahulu!') </script>";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        //explode untuk memecah string menjadi array,ada dua parameter ('delimiter', namafile)
        //strtolower untuk memaksa string menjadi huruf kecil
        //end untuk mengambil hasil explode yang paling akhir setelah titik ex (hilman.aja.jpg) yang diambil==> .jpg
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        

        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "<script> alert('yang di upload bukan gambar!') </script>";
            return false;
        }

        //cek jika ukuran gambar terlalu besar
        //ini gak jalan untuk format jpg,kalau png jalan
        if( $ukuranFile > 1000000 ) {
            echo "<script> alert('ukuran gambar terlalu besar!') </script>";
            return false; 
        }

        //lolos pengecekan,gambar siap diupload
        // untuk generate nama gambar baru, unqueid agar ketika ada yg upload nama gambar sama tidak apa2
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
        
    }


    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

        return mysqli_affected_rows($conn);
    }



    function ubah($data) {
        global $conn;

        $id = $data["id"];
        //ambil data dari tiap elemen di dalam form
        $nama = htmlspecialchars ( $data["nama"] );
        $nrp = htmlspecialchars( $data["nrp"] );
        $jurusan = htmlspecialchars ( $data["jurusan"] );
        $email = htmlspecialchars ( $data["email"] );
        $gambarLama = htmlspecialchars ( $data["gambarLama"] );

        //cek apakah user pilih gambar baru atau tidak
        //ini gak jalan,gambar gak muncul
        if( $_FILES['gambar']['error'] === 4 ) {
            $gambar = $gambarLama;
        }else{
            $gambar = upload();
        }

        //query insert data
        $query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', jurusan = '$jurusan', email = '$email', gambar = '$gambar'
                    WHERE id = $id ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function cari ($keyword) {
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE'%$keyword%'
                    OR nrp LIKE'%$keyword%'
                    OR jurusan LIKE'%$keyword%'
                    OR email LIKE'%$keyword%' ";

        return query($query);
    }


    function registrasi($data) {
        global $conn;

        $username = strtolower(stripcslashes($data["username"]) );
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        //cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username= '$username' ");

        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                    alert('username sudah terdaftar')
                </script>";
            return false;
        }

        //cek konfirmasi password
        if( $password !== $password2 ) {
            echo "<script>
                    alert('konfirmasi password tidak sesuai');
                 </script>" ;
            return false;
        }

        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);


        //masukan data kedalam database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password') ");

        return mysqli_affected_rows($conn);
    }

?>