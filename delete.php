<?php 
	include('connectdb.php');
	$kode=$_GET['id'];
	$tabel=$_GET['tbl'];

	if($tabel=="produk"){
		$query='DELETE FROM produk WHERE kodeproduk="'.$kode.'"';
		if(mysql_query($query)){
			header("location:produk.php");
		}
	}

	if($tabel=="kategori"){
		$query='DELETE FROM kategori WHERE idkat="'.$kode.'"';
		if(mysql_query($query)){
			header("location:kategori.php");
		}
	}
 ?>