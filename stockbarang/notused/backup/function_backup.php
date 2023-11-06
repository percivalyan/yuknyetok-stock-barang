<?php

session_start();
//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");


	// Mengecek koneksi ke database
	// if($conn){
	// 	echo 'berhasil';
	// }

//Menambah Barang Baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    //Gambar
    $allowed_extensions = array('png', 'jpg');
    $nama = $_FILES['file']['name']; //Untuk Mengambil
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); //Mengambil Ekstensinya
    $ukuran = $_FILES['file']['size']; //Mengambil Size Filenya
    $file_tmp = $_FILES['file']['tmp_name']; //Mengambil Lokasi Filenya

    //Penamaan File -> enkripsi
    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menghubungkan Nama File yang Dienkripsi dengan Ekstensinya

    //Validasi Sudah Ada atau Belum
    $cek = mysqli_query($conn, "SELECT * FROM stock WHERE namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if($hitung < 1){
        //Jika Belum Ada

        //Proses Upload Gambar
        if(in_array($ekstensi, $allowed_extensions)){
            //Validasi Ukuran Filenya
            if($ukuran < 15000000){
                move_uploaded_file($file_tmp, 'images/'.$image);
                $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock, image) VALUES ('$namabarang', '$deskripsi', '$stock', '$image')");
                if ($addtotable){
                    header('location:index.php');
                } else {
                    echo 'Gagal';
                    header('location:index.php');
                }
            } else {
                //Kalau filenya lebih dari 15mb
                echo '
                <script>
                    alert("Ukuran File Terlalu Besar");
                    window.location.href="index.php";
                </script>
                ';
            }
        } else {
            //Kalau Filenya tidak PNG/JPG
            echo '
            <script>
                alert("File harus PNG/JPG");
                window.location.href="index.php";
            </script>
            ';
        }

    } else{
        //JIka Sudah Ada
        echo '
        <script>
            alert("Nama Barang Sudah Terdaftar");
            window.location.href="index.php";
        </script>
        ';
    }
}


//Menambah Barang Masuk
	if(isset($_POST['barangmasuk'])){
		$barangnya = $_POST['barangnya'];
		$keteranganmasuk = $_POST['keteranganmasuk'];//"keteranganmasuk" harusnya "penerima" tapi diganti
		$qty = $_POST['qty'];

		$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstocksekarang);

		$stocksekarang = $ambildatanya['stock'];
		$tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

		$addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) VALUES ('$barangnya', '$keteranganmasuk', '$qty')");
		$updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");

		if($addtomasuk&&$updatestockmasuk){
			header('location:masuk.php');
		} else {
			echo 'Gagal';
			header('location:masuk.php');
		}
	}

//Menambah Barang KELUAR
	if(isset($_POST['addbarangkeluar'])){
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstocksekarang);

		$stocksekarang = $ambildatanya['stock'];

		if($stocksekarang >= $qty){
			//Jika barang cukup
			$tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;

			$addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) VALUES ('$barangnya', '$penerima', '$qty')");
			$updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");

			if($addtokeluar&&$updatestockmasuk){
				header('location:keluar.php');
			} else {
				echo 'Gagal';
				header('location:keluar.php');
			}
		} else {
			//Jika barang tidak cukup
			echo '
			<script>
				alert("Stock saat ini tidak mencukupi");
				window.location.href="keluar.php";
			</script>
			';
		}
	}

//Update Info Barang dari Stock
	if (isset($_POST['updatebarang'])) {
		$idb = $_POST['idb'];
		$namabarang = $_POST['namabarang'];
		$deskripsi = $_POST['deskripsi'];

		//Gambar
	    $allowed_extensions = array('png', 'jpg');
	    $nama = $_FILES['file']['name']; //Untuk Mengambil
	    $dot = explode('.', $nama);
	    $ekstensi = strtolower(end($dot)); //Mengambil Ekstensinya
	    $ukuran = $_FILES['file']['size']; //Mengambil Size Filenya
	    $file_tmp = $_FILES['file']['tmp_name']; //Mengambil Lokasi Filenya

	    //Penamaan File -> enkripsi
	    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menghubungkan Nama File yang Dienkripsi dengan Ekstensinya

		if ($ukuran==0){
			//Jika tidak ingin upload
			$update = mysqli_query($conn, "UPDATE stock set namabarang = '$namabarang', deskripsi = '$deskripsi' where idbarang = '$idb'");
			if ($update) {
				header('location:index.php');
			} else {
				echo 'Gagal';
				header('location:index.php');
			} 
		} else {
			//Jika ingin
			move_uploaded_file($file_tmp, 'images/'.$image);
			$update = mysqli_query($conn, "UPDATE stock set namabarang = '$namabarang', deskripsi = '$deskripsi', image = '$image' where idbarang = '$idb'");
			if ($update) {
				header('location:index.php');
			} else {
				echo 'Gagal';
				header('location:index.php');
			}
		}

	}

//Hapus Barang dari Stock
	if (isset($_POST['hapusbarang'])) {
		$idb = $_POST['idb']; //idbarang
		$gambar = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
		$get = mysqli_fetch_array($gambar);
		$img = 'image/'.$get['iamge'];
		unlink($img);

		$hapus = mysqli_query($conn, "DELETE from stock where idbarang = '$idb'");
			if ($update) {
				header('location:index.php');
			} else {
				echo 'Gagal';
				header('location:index.php');
			}
	};

//Mengubah data barang masuk
	if (isset($_POST['updatebarangmasuk'])) {
		$idb = $_POST['idb'];
		$idm = $_POST['idm'];
		$deskripsi = $_POST['keterangan'];
		$qty = $_POST['qty'];

		$lihatstock = mysqli_query($conn, "select * from stock where idbarang = '$idb'");
		$stocknya = mysqli_fetch_array($lihatstock);
		$stockskrg = $stocknya['stock'];

		$qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk = '$idm'");
		$qtynya = mysqli_fetch_array($qtyskrg);
		$qtyskrg = $qtynya['qty'];

		if($qty>$qtyskrg){
			$selisih = $qty-$qtyskrg;
			$kurangin = $stockskrg+$selisih;
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		//	$updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty' deskripsi='$deskripsi' WHERE idmasuk='$idm'");
			$updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");

				if ($kurangistocknya&&$updatenya) {	
					header('location:masuk.php');
				} else {
					echo 'Gagal';
					Header('location:masuk.php');
				}
		}

		else{
			$selisih = $qtyskrg-$qty;
			$kurangin = $stockskrg-$selisih;
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			//$updatenya = mysqli_query($conn, "UPDATE masuk set qty='$qty', keterangan='$deskripsi', WHERE idmasuk='$idm'");
			$updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");
				if ($kurangistocknya&&$updatenya) {	
					header('location:masuk.php');
				} else {
					echo 'Gagal';
					Header('location:masuk.php');
				}
		}
	}

//Menghapus Barang Masuk
	if(isset($_POST['hapusbarangmasuk'])){
		$idb = $_POST['idb'];
		$qty = $_POST['kty'];
		$idm = $_POST['idm'];

		$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
		$data = mysqli_fetch_array($getdatastock);
		$stock = $data['stock'];

		$selisih = $stock-$qty;

		$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
		$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

		if($update&&$hapusdata){
			header('location:masuk.php');
		} else{
			header('location:masuk.php');
		}
	}

//Mengubah data barang keluar
	if (isset($_POST['updatebarangkeluar'])) {
		$idb = $_POST['idb'];
		$idk = $_POST['idk'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$lihatstock = mysqli_query($conn, "select * from stock where idbarang = '$idb'");
		$stocknya = mysqli_fetch_array($lihatstock);
		$stockskrg = $stocknya['stock'];

		$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar= '$idk'");
		$qtynya = mysqli_fetch_array($qtyskrg);
		$qtyskrg = $qtynya['qty'];

		if($qty>$qtyskrg){
			$selisih = $qty-$qtyskrg;
			$kurangin = $stockskrg-$selisih;
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");

				if ($kurangistocknya&&$updatenya) {	
					header('location:keluar.php');
				} else {
					echo 'Gagal';
					Header('location:keluar.php');
				}
		}

		else{
			$selisih = $qtyskrg-$qty;
			$kurangin = $stockskrg+$selisih;
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");
				if ($kurangistocknya&&$updatenya) {	
					header('location:keluar.php');
				} else {
					echo 'Gagal';
					Header('location:keluar.php');
				}
		}
	}

	//Menghapus Barang Keluar
	if(isset($_POST['hapusbarangkeluar'])){
		$idb = $_POST['idb'];
		$qty = $_POST['kty'];
		$idk = $_POST['idk'];

		$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
		$data = mysqli_fetch_array($getdatastock);
		$stock = $data['stock'];

		$selisih = $stock+$qty;

		$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
		$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

		if($update&&$hapusdata){
			header('location:keluar.php');
		} else{
			header('location:keluar.php');
		}
	}

	//Menambah Admin Baru
	if (isset($_POST['addadmin'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$queryinsert = mysqli_query($conn, "INSERT INTO login (email, password) VALUES ('$email', '$password')");

		if($queryinsert){
			//if berhasil
			header('location:admin.php');
		} else {
			//if gagal insert ke db
			header('location:admin.php');
		}
	}

	// Edit Data Admin
	if (isset($_POST['updateadmin'])) {
		$emailbaru = $_POST['emailadmin'];
		$passwordbaru = $_POST['passwordbaru'];
		$idnya = $_POST['id'];

		$queryupdate = mysqli_query($conn, "UPDATE login SET email='$emailbaru', password='$passwordbaru' WHERE iduser='$idnya'");

		if ($queryupdate) {
			header('location:admin.php');
		} else {
			header('location:admin.php');
		}
	}

	// Hapus Admin
	if(isset($_POST['hapusadmin'])){
		$id = $_POST["id"];

		$querydelete = mysqli_query($conn, "DELETE FROM login WHERE iduser='$id'");

		if ($querydelete) {
			header('location:admin.php');
		} else {
			header('location:admin.php');
		}
	}

	//Kelola User
	//Untuk CRUD Akun User

	//Menambah Admin Baru
	if (isset($_POST['adduser'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$queryinsert = mysqli_query($conn, "INSERT INTO userlogin (email, password) VALUES ('$email', '$password')");

		if($queryinsert){
			//if berhasil
			header('location:kelola-user.php');
		} else {
			//if gagal insert ke db
			header('location:kelola-user.php');
		}
	}

	// Edit Data Admin
	if (isset($_POST['updateuser'])) {
		$emailbaru = $_POST['emailuser'];
		$passwordbaru = $_POST['passwordbaru'];
		$idnya = $_POST['id'];

		$queryupdate = mysqli_query($conn, "UPDATE userlogin SET email='$emailbaru', password='$passwordbaru' WHERE iduser='$idnya'");

		if ($queryupdate) {
			header('location:kelola-user.php');
		} else {
			header('location:kelola-user.php');
		}
	}

	// Hapus Admin
	if(isset($_POST['hapususer'])){
		$id = $_POST["id"];

		$querydelete = mysqli_query($conn, "DELETE FROM userlogin WHERE iduser='$id'");

		if ($querydelete) {
			header('location:kelola-user.php');
		} else {
			header('location:kelola-user.php');
		}
	}


?>