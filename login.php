<?php 
	require_once("connectdb.php");

	if (!empty($_POST['submit'])){
		//username dan password yg dikirim dari form
		$username=$_POST['username'];
		$password=$_POST['password'];

		//untuk proteksi terhadap mySQL Injection
		$username=stripslashes($username);
		$password=stripslashes($password);
		$username=mysql_real_escape_string($username);
		$password=mysql_real_escape_string($password);

		//cek data yg dikirim apakah kosong atau tidak
		if (empty($username) && empty($password)){
			//jika username dan password kosong
			header("location:login.php?error=1");
			break;
		} else if (empty($username)){
			//jika username saja yang kosong
			header("location:login.php?error=2");
			break;
		} else if (empty($password)){
			//jika password saja yang kosong
			//redirect ke halaman index
			header("location:login.php?error=3");
			break;
		}

		$sql="SELECT * from login WHERE username='".$username."' AND password='".md5($password)."'";
		$result=mysql_query($sql);

		//mysql_num_row sedang menghitung jumlah baris yang match
		$count=mysql_num_rows($result);
		if ($data=mysql_fetch_assoc($result)){$namauser=$data['username']; $pass=$data['password'];}

		//jika username dan password match, baris tabel berjumlah 1
		if($count==1){
			//register ke session login
			session_start();
			$_SESSION['username']=$namauser;
			$_SESSION['password']=$pass;
			
			header("location:index.php");
			exit();
		} else{
			//username atau password tidak ada pada database
			header("location:login.php?error=4");
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="login">
 	<form method="post">
 		<table id="gantipass">
 			<tr><td><label id="lblusername">Username </label></td><td><input id="login" type="text" name="username"></td></tr>
 			<tr><td><label id="lblpass">Password </label></td><td><input id="login" type="password" name="password"></td></tr>
 			<tr><td></td><td><input id="inputlogin" type="submit" name="submit" value="Log In"/></td></tr>
 			<?php 
 				if (!empty($_GET['error'])){
 					if ($_GET['error']==1){
 						echo '<div id="error">Username dan Password belum diisi !';
 					} else if ($_GET['error'] == 2) {
 						echo '<div id="error">Username belum diisi !';
 					} else if ($_GET['error'] == 3) {
 						echo '<div id="error">Password belum diisi !';
 					} else if ($_GET['error'] == 4) {
 						echo '<div id="error">Username dan Password tidak terdaftar !';
 					}
 				}
 			 ?>
 		</table>
 	</form>
 </div>
</body>
</html>