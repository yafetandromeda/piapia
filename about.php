<?php session_start(); ?>

<?php 
	include('connectdb.php');

    //menghilangkan notice
    $idkat=isset($_GET['idkat'])?$_GET['idkat']:null;
    $tabel=isset($_GET['tbl'])?$_GET['tbl']:null;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Piapia 37</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="StyleSheet" href="reset.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/flexslider.css" media="screen">

    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $('.flexslider').flexslider({
                animation: "slide"
            })
        })
    </script>
</head>
<body>

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

<br class="clearfloat">


<div class="post">
<div id="about">

<p>"PiaPia 37" adalah kue pia dengan kulit yang berlapis seperti pastry dengan varian rasa yang bermacam-macam</p> 
<p>dengan potongan keju di dalamnya. Varian rasanya ada kacang hijau keju, coklat keju, capuccino keju, dan durian.</p> 
<p>Produk lain adalah mochi, dengan merk "Mochi Sakura" yang memiliki bermacam-macam varian rasa.</p> 
<p>Dan juga "Wingko Jambon" yang terbuat dari kelapa asli yang segar. Semua produk tersebut kami buat sendiri </p>
<p>tanpa ada bahan pengawet dan sudah terjamin kehalalanya. Selain produk diatas kami juga menyediakan berbagai macam oleh-oleh khas lainnya.</p> 
<p>Silahkan berbelanja di toko kami dan rasakan cita rasa produk kami.</p><br/><br/>

<p>Regards,</P>
<p>PiaPia 37 Jogja</p>

<br class="clearfloat"><br><br>


</div>
</div>
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
</div>
<div class="footer">
            <p align="center">created by <a href="http://www.facebook.com/yafet.andromeda">Yafet Andromeda </a></p>
        </div>
</div>

</body></html>
<!--</body>
</html>-->