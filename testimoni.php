<?php session_start() ?>
<?php 
	include('connectdb.php');
 ?>

<!--<!DOCTYPE html>
<html>
<head>
	<title>NATASYA GIFT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="header">
	<?php 
		//if(!empty($_SESSION['username'])){
			//echo "<div id='loginindex'>|| Login as ".$_SESSION['username']." || <a href='logout.php'>Logout</a> || </div>";
		//}
	 ?>
	 <h3>NATASYA GIFT</h3>
  		<a href="http://localhost:81/natasyagift/produk.php">produk</a>
</div>-->

<html><head>

        <title>Piapia 37</title>
        <link rel="StyleSheet" href="style.css" type="text/css">
        <link rel="StyleSheet" href="reset.css" type="text/css">        
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="imagezoom.js"></script>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
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
                        echo "<li><a href='index.php?tbl=kategori&idkat=".$id."'>".$nama."</a></li>";
                    }
                     ?>
                </ul>
            </li>
             <?php if(!empty($_SESSION['username'])){
                echo "<li><a href='produk.php'>Add Produk</a></li>";
                echo "<li><a href='kategori.php'>Add Category</a></li>";
                echo "<li><a href='testimoni.php'>Add Testimoni</a></li>";
            }
              ?>
            <li><a href="about.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul><br>
            <br class="clearfloat"><div class="LeftContent">
    

</div>
<br class="clearfloat">
<?php
	$sukses=false;
	if(!empty($_POST['submit'])){
		$dir='Testimoni/';
		$linkGambar="";
		if($_FILES["fileGambar"]["size"] != 0){
			$linkGambar=$dir.$_FILES['fileGambar']['name'];
			move_uploaded_file($_FILES['fileGambar']['tmp_name'],$linkGambar );
		}

		$cekdata="SELECT * FROM testimoni WHERE idtes='".$idtes."'";
		$ada=mysql_query($cekdata) or die(mysql_error());
		if(mysql_num_rows($ada)>0){
			echo "error";
		} else{
			$query='INSERT INTO testimoni VALUES("'.$idtes.'","'.$linkGambar.'")';
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
		$idtesU=$_POST['idtes'];
		$testiU=$_POST['testi'];

		if(empty($namakatU)){
			echo "error";
		} else{
			$query='UPDATE testimoni SET testi="'.$testiU.'"';
			$result=mysql_query($query);
			if($result){
				$suksesU=true;
			} else{
				$suksesU=false;
			}
		}
	}
	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Testimoni</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body> 
 <div id="wrapper">
 	<h3>DAFTAR TESTIMONI</h3>
 	<form class="insert" method="post" action="testimoni.php" enctype="multipart/form-data">
 		<table id="tambahkat">
 			<tr><td></td><td><label id="label">TAMBAH TESTIMONI</label></td></tr>
 			<tr></tr>
 			<tr><td><label for='fileGambar'>Gambar</label></td><td><output id="list"><img src="a.jpg" width="50px"></output><input type='file' name="fileGambar" id="files" /></tr>
 			<tr><td></td><td><input type="submit" name="submit" value="insert"></td></tr>

 			<?php 
					if($sukses=true){
						echo "<tr><td></td><td><font color='blue'>Testimoni Berhasil Ditambah !</font></td></tr>";
					}
				 ?>
 		</table>
 	</form>

 	<form method="post" action="testimoni.php" enctype="multipart/form-data">
 		<table> 			
 		<?php 
			$query='SELECT * FROM testimoni';
			$result=mysql_query($query);
			echo "<table border='1' id='daftartestimoni'>";
			echo "<tr bgcolor=grey>
				<th>Id</th>
				<th width='200'>Testimoni</th>";

			while ($data=mysql_fetch_array($result)) {
				$kolomNamaKat="";
				if(!empty($_GET['edit'])&&$data['idtes']==$_GET['id']){
					$kolomtesti='<input type="text" name="kolomtesti" value="'.$data['testi'].'">';
				} else{
					$kolomtesti=$data['testi'];
				}
 				echo "<tr><td align='center'>".$data['idtes']."</td><td>".$kolomtesti."</td></tr>";
			}
			if($suksesU=true){
				echo "<tr><td colspan='7'><font color='blue'>Data Berhasil di Update !<font></td></tr>";
			}
 		 ?>
 		</table>
 	</form>
 	<br></div><br><br>

 	<div class='cp'>
        <div class='isicp'>
        <form>
        <table>
            <tr><td>Contact Person :
            <td><img src='Design/Natasyagift.png' width='60%'></td></td></tr>
            <tr><td align="center"><img src='Contact/WA.png' width='30px' height='30px'></td><td>0878 3858 4777</td></tr>
            <tr><td align="center"><img src='Contact/Line.png' width='30px' height='30px'></td><td>tasyagabb</td></tr>
            <tr><td align="center"><img src='Contact/fb.png' width='30px' height='30px'></td><td><a href="http://www.facebook.com/natasya.scrap">Natasya Gift</a></td></tr>
            <tr><td align="center"><img src='Contact/instagram.png' width='30px' height='30px'></td><td><a href="http://www.instagram.com/natasyagift">Natasya Gift</a></td></tr>
            <tr><td align="center"><img src='Contact/BBM.png' width='30px' height='30px'></td><td ><img src='Contact/pin.jpg' width='80px' height='80px'></td></tr><tr><td></td><td>7DA32DAA</td></tr>
          </table>
          </form>
        </div>
        <div class='rek'>
            <form>
                <table>
                <tr><td width="100px"><img src='Contact/BCA.png' width="100px"></td><td>456-495-3328 a/n Wina Oni .K</td></tr>
                <tr><td align="center" width="100px"><img src='Contact/email.png' width="80px"></td><td>anastasyagabb@gmail.com</td></tr>
                </table>
          </form>
        </div>
    </div>
</div>
<div class="footer">
    <p align="center">created by<a href="http://www.hitamcoklat.com/">Yafet Andromeda </a></p>
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