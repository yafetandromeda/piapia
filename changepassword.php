<?php 
	require_once("connectdb.php");
	session_start();
	$sukses=false;
	if (!empty($_POST['update'])){
		//username dan password yg dikirim dari form
		$username=$_SESSION['username'];
		$password=$_POST['passbaru'];
		$pass=$_POST['password'];

		if(empty($pass)){
			header('location:changepassword.php?error=1');
		} else{
			$sql="UPDATE login SET password='".md5($pass)."' WHERE username='".$username."'";
			$result=mysql_query($sql);
			if($result){
				$sukses=true;
			} else{
				$sukses=false;
			}
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
 			<tr><td><label id="lblpass">Password Baru </label></td><td><input id="login" type="password" name="passbaru"></td></tr>
 			<tr><td><label id="lblpass">Konfirmasi Password </label></td><td><input id="login" type="password" name="password"></td></tr>
 			<tr><td></td><td><input id="changepass" type="submit" name="update" value="Change Password"/></td></tr>
 			<?php
				if($sukses==true){
					if($password==$pass){
						echo "<tr><td></td><td></td></tr>";
						echo "<tr><td colspan='2'><font color='pink'>Password Berhasil Diubah !</font></td></tr>";
						header("location:index.php");
					} else{
						echo "Password baru dan konfirmasi password harus sama!";
					}
				}
			?>

			<?php
			if (!empty($_GET['error'])) {
				if ($_GET['error'] == 1) {
					 echo '<div id="error">Password belum diisi !<div>';
					}
			}
			?>
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