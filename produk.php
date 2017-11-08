<?php 
	include('connectdb.php');
error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	//jika belum login maka dialihkan ke halaman index
	session_start();

	if (empty($_SESSION['username'])){
		header('location:index.php');
	}

	$sukses=false;
	if(!empty($_POST['submit'])){ // jika tidak kosong
		$kode=$_POST['kodeProduk'];
		$nama=$_POST['namaProduk'];
		$dir='Gambar/';
		$linkGambar="";
		$deskripsi=$_POST['deskripsiProduk'];
		$harga=$_POST['hargaProduk'];
		$status=$_POST['statusProduk'];
		$kategori=$_POST['kategoriProduk'];
		if($_FILES["fileGambar"]["size"] != 0){
			$linkGambar=$dir.$_FILES['fileGambar']['name'];
			move_uploaded_file($_FILES['fileGambar']['tmp_name'],$linkGambar );
		}

		$cekdata="select kodeproduk from produk where kodeproduk='$kode'";
		$ada=mysql_query($cekdata) or die(mysql_error());
		if(mysql_num_rows($ada)>0){
			header('location:produk.php?error=1');
		} else if(empty($kode) && empty($nama)){
			header('location:produk.php?error=2');
		} else if(empty($kode)){
			header('location:produk.php?error=3');
		} else if(empty($nama)){
			header('location:produk.php?error=4');
		} else{
			$query='INSERT into produk VALUES("'.$kode.'","'.$nama.'","'.$linkGambar.'","'.$deskripsi.'","'.$harga.'","'.$status.'","'.$kategori.'")';

			$result=mysql_query($query);
			if($result){
				$sukses=true;
			} else{
				$sukses=false;
			}
		}
	}
	$suksesU=false;
	if(!empty($_POST['update'])){
		$dir='Gambar/';
		$kodeU=$_POST['kode'];
		$namaU=$_POST['nama'];
		$linkGambar="";
		$deskripsiU=$_POST['deskripsi'];
		$hargaU=$_POST['harga'];
		$statusU=$_POST['ddstat'];
		$kategoriU=$_POST['ddkat'];
		$gambarlama=$_POST['namagambar'];
		if($_FILES["fileGambarEd"]["size"] != 0){
			$linkGambar=$dir.$_FILES['fileGambarEd']['name'];
			move_uploaded_file($_FILES['fileGambarEd']['tmp_name'],$linkGambar );
		} else{
			$linkGambar=$gambarlama;
		}

		$query="UPDATE produk SET namaproduk='".$namaU."',gambar='".$linkGambar."',deskripsi='".$deskripsiU."',harga='".$hargaU."',status='".$statusU."',idkat='".$kategoriU."' WHERE kodeproduk='".$kodeU."'";
		$result=mysql_query($query);
}

?>

<html>
<head>
	<title>Produk</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrap">
	<div class="header">
		 	<?php 
                if(!empty($_SESSION['username'])){
                echo "<div id='loginindex'>Selamat datang, ".$_SESSION['username']." || <a href='changepassword.php'>Change Password</a> || <a href='logout.php'>Logout</a> ||</div>";
                }
            ?>
	</div>

<ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Categories</a>
                <ul class="submenu">
                    <?php 
                        $sql = mysql_query('SELECT * FROM kategori');
                        while ($kat = mysql_fetch_array($sql)){
                        $id = $kat['idkat'];
                        $nama = $kat['namakat'];
                        echo "<li><a href='index.php?tbl=kategori&idkat=".$id."'>".$id."</a></li>";
                    }
                     ?>
                </ul>
            </li>
             <?php if(!empty($_SESSION['username'])){
                echo "<li><a href='produk.php'>Add Produk</a></li>";
                echo "<li><a href='kategori.php'>Add Category</a></li>";
                // echo "<li><a href='testimoni.php'>Add Testimoni</a></li>";
            }
              ?>
            <li><a href="about.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul><br>

		<form class="insert" method="post" action="produk.php" enctype="multipart/form-data">
			<table id="tambahproduk">
				<tr><td></td><td><label id="label">TAMBAH PRODUK</label></td></tr>
				<tr></tr>
				<tr><td><label>Kode</label></td><td><input type="text" name="kodeProduk" maxlength="5"></td></tr>
				<tr><td><label>Nama</label></td><td><input type="text" name="namaProduk"></td></tr>
				<tr><td><label for='fileGambar'>Gambar</label></td><td><output id="list"><img src="a.jpg" width="50px"></output><input type='file' name="fileGambar" id="files" /></tr>
				<tr><td><label>Deskripsi</label></td><td><textarea rows=7 cols=30 name="deskripsiProduk"></textarea></td></tr>
				<tr><td><label>Harga</label></td><td><input type="text" name="hargaProduk"></td></tr>
				<tr><td><label>Status</label></td><td><select name="statusProduk" id="statusProduk"><option>Tersedia</option><option>Tidak Tersedia</option></td></tr>
				<?php 
				$sql = mysql_query('SELECT * FROM kategori');
				if(mysql_num_rows($sql)>0){ ?>
					<tr><td><label>Kategori</label></td><td><select name="kategoriProduk" id="kategoriProduk">
						<?php while ($row=mysql_fetch_array($sql)){ ?>
							<option><?php echo $row['idkat'] ?></option>
						<?php }?></select>
				<?php }?>
					</td></tr>
				<tr><td></td><td><input type="submit" name="submit" value="Insert"></td></tr>
				<?php 
					if($sukses=false){
						echo "<tr><td></td><td><font color='blue'>Produk Berhasil Ditambah !</font></td></tr>";
					}
				 ?>

				 <?php
				 	if(!empty($_GET['error'])){
				 		if($_GET['error'] == 1){
				 			 echo '<div id="notiferror">Kode Produk telah terdaftar ! Silahkan diulang...</div>';
						} else if ($_GET['error'] == 2) {
							echo '<div id="notiferror">Data Produk belum diisi  !</div>';
						} else if ($_GET['error'] == 3) {
							echo '<div id="notiferror">Kode Produk tidak boleh kosong !</div>';
						} else if ($_GET['error'] == 4) {
							echo '<div id="notiferror">Nama Produk tidak boleh kosong !</div>';
				 		}
				 	}
				  ?>

				<?php
					if (!empty($_GET['error'])) {
					if ($_GET['error'] == 7) {
						 echo '<div id="notiferrorU">test !</div>';
					}
				}
				?>
			</table>
		</form>

		<form method="post" action="produk.php" enctype="multipart/form-data">
			<table>
				<?php 
					$query="SELECT * FROM produk";
					$result=mysql_query($query);

					$sql2=mysql_query('SELECT * FROM kategori ORDER BY idkat ASC');

					if(empty($_GET['edit'])){
						echo "<table border='1'>";
						echo "<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Gambar</th>
						<th>Deskripsi</th>
						<th>Harga</th>
						<th>status</th>
						<th>Kategori</th>
						<th>Hapus</th>
						<th>Edit</th>";	
					}

					while($data=mysql_fetch_array($result)){
						$kode=$data['kodeproduk'];
						$nama=$data['namaproduk'];
						$gambar=$data['gambar'];
						$deskripsi=$data['deskripsi'];
						$harga=$data['harga'];
						$status=$data['status'];
						$kategori=$data['idkat'];
						$input="";
						$buttonSave="";
						//$i=$i+1;					

						if(!empty($_GET['edit'])&&$kode==$_GET['id']){

							$kat=[];
							$i=0;
							if(mysql_num_rows($sql2)>0){
								 while ($row=mysql_fetch_array($sql2)){
								 $kat[$i]=$row['idkat'];
								 $i=$i+1;
								}
							}

							//$a="<td><select name='ddkat' id='ddkat'>";
							for($x = 0; $x < $i; $x++){
								$a=$a."<option>".$kat[$x]."</option>";
							}

							//$a=$a."</select></td>";

							echo "<form><table><tr><td></td><td><input type='hidden' size='10px'  name='kode' value='".$kode."'></td></tr>";
						 	echo "<tr><td><label>Nama</label></td><td><input type='text' size ='15px' name='nama' value='".$nama."'></td></tr>";
						 	echo "<tr><td><label>Gambar</label></td><td>&nbsp&nbsp<output id='list'><img src='".$gambar."' width='100px' height='100px'></output>";
						 	echo "<input type='hidden' name='namagambar' value='".$gambar."'>";
						 	echo "<input type='file' name='fileGambarEd'/>";
						 	echo "<tr><td><label>Deskripsi</label></td><td>&nbsp&nbsp<textarea rows='7' cols='45' name='deskripsi' value='".$deskripsi."'>".$deskripsi."</textarea></td></tr>";
						 	echo "<tr><td><label>Harga</label></td><td><input type='text' size ='15px' name='harga' value='".$harga."'></td></tr>";
						 	echo "<tr><td><label>Status</label></td><td>&nbsp&nbsp<select name='ddstat' value='".$status."'><option>Tersedia</option><option>Tidak Tersedia</option></select></td?</tr>";
						 	echo "<tr><td><label>Kategori</label></td><td>&nbsp&nbsp<select name='ddkat' id='ddkat'><option>".$kategori."</option>".$a."</select></td></tr>";
						 	echo '<input type="hidden" name="kolomkode" value="'.$kode.'"><br>';
						 	echo "<tr><td></td><td><input type='image' name='update' value='update' src='Design/save.png' width='50px' height='50px'><a href='produk.php'><img src='Design/cancel1.ico' width='60px' height='60px'></a></td></tr></form>";
						 	//$buttonSave="<td><input type='submit' name='update' value='update'></td><td><a href='produk.php'>cancel</a></td>";
						} else if(!empty($_GET['edit'])){
						} else{
						echo "<tr>
						<td align='center'>".$kode."</td>
						<td align='left'>".$nama."</td>
						<td><output id='list'><img src='".$gambar."' width='50px' height='50px'></output>".$input."</td>
						<td align='left'>".$deskripsi."</td>
						<td align='left'>".$harga."</td>
						<td>".$status."</td>
						<td>".$kategori."</td>
						<td><a href='delete.php?tbl=produk&id=".$kode."'><img src='Design/delete.ico' width='50px' height='50px'></a></td>
						<td><a href='produk.php?edit=true&&tbl=produk&id=".$kode."'><img src='Design/edit.png' width='50px' height='50px'></a></td>".$buttonSave."</td></tr>";
						}
					if($suksesU=false){
							echo "<tr><td colspan='9'><font color='blue'>Data Berhasil di Update !<font></td></tr>";
						}
					}
					
				 ?>
			</table>
		</form>
	<br></br>

	<div class='cp'>
        <div class='isicp'>
        <form>
        <table>
            <tr><td>Contact Person :</td></tr>
        </table><br>
        <table>
              <tr><td align="center" width="100px"><img src='Contact/BBM.png' width="30px"></td><td>7FA62A6B</td></tr>
              <tr><td align="center" width="70px"><img src='Contact/WA.png' width='30px' height='30px'></td><td>(0274) 510770, 08562859639, 085100420047</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/BCA.png' width="50px"></td><td>126-051-9090 a/n Ferditya Dwi Putra</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/email.png' width="40px"></td><td>piapia37jogja@gmail.com</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/fb.png' width="40px"></td><td><a href='https://www.facebook.com/profile.php?id=100009467327010'>Piapia 37 Jogja</a></td></tr>
              <tr><td align="center" width="100px"><img src='Contact/Instagram.png' width="40px"></td><td><a href='https://instagram.com/piapia_37_jogja/'>Piapia 37 Jogja</a></td></tr>
            </table>
          </form>
        </div>
    </div>

	<script type="text/javascript">
		
		document.getElementById('files').addEventListener('change', handleFileSelect, false);
		
		function handleFileSelect(evt) {
				var id='list';
		        var files = evt.target.files;
		        var f = files[0];
		        var reader = new FileReader();
		         
		          reader.onload = (function(theFile) {
		                return function(e) {
		                  document.getElementById(id).innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="100px" />'].join('');
		                };
		          })(f);
		           
		          reader.readAsDataURL(f);
		}
	</script>
	</div>

</body>
</html>