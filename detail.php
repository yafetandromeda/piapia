<?php session_start() ?>
<?php 
	include('connectdb.php');
	$kode=$_GET['id'];
    $tabel=$_GET['tbl'];
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
                // echo "<li><a href='testimoni.php'>Add Testimoni</a></li>";
              }
              ?>
            <li><a href="about.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul><br>
            <br class="clearfloat"><div class="LeftContent">
    

</div>

<div id="isidetail">
	<?php
    	$query='SELECT * FROM produk WHERE kodeproduk="'.$kode.'"';
		$result=mysql_query($query);

		while($data=mysql_fetch_array($result)){
			echo '<div class="detailproduk">';
        	echo "<img src='".$data['gambar']."' width='200px' height='200' data-imagezoom='true'>";
    		echo '</div>';
            echo "<div class='deskripsiproduk'><table>
                    <tr height='50'>
                        <td width='150'>Kode Produk</td>
                        <td>".$data['kodeproduk']."</td>
                    </tr>
                    <tr height='50'>
                        <td>Nama Produk</td>
                        <td align='left'>".$data['namaproduk']."</td>
                    </tr>
                    <tr height='50'>
                        <td>Deskripsi</td>
                        <td align='left'>".$data['deskripsi']."</td>
                    </tr>
                    <tr height='50'>
                        <td>Harga</td>
                        <td align='left'>Rp. ".number_format($data['harga'],2,',','.')."</td>
                    </tr>
                    <tr height='50'>
                        <td>Status</td>
                        <td>".$data['status']."</td>
                    </tr>
                </table></div>";
   		}
       ?>
</div>


<br class="clearfloat">

<div class='cp'>
        <div class='isicp'>
          <form>
            <table>
                <tr><td>Contact Person :</td></tr>
            </table><br>
            <table>
              <tr><td align="center" width="100px"><img src='Contact/BBM.png' width="30px"></td><td>51FCC22F</td></tr>
              <tr><td align="center" width="70px"><img src='Contact/WA.png' width='30px' height='30px'></td><td>082225098323</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/BCA.png' width="50px"></td><td>126-051-9090 a/n Ferditya Dwi Putra</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/email.png' width="40px"></td><td>piapia37jogja@gmail.com</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/fb.png' width="40px"></td><td>Piapia37Jogja</td></tr>
              <tr><td align="center" width="100px"><img src='Contact/Instagram.png' width="40px"></td><td>Piapia37Jogja</td></tr>
            </table>
          </form>
        </div>
    </div>
        <div class="footer">
            <p align="center">created by <a href="http://www.facebook.com/yafet.andromeda">Yafet Andromeda </a></p>
        </div>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body></html>

<!--</body>
</html>-->