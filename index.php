<?php session_start(); ?>

<?php 
	include('connectdb.php');

    //menghilangkan notice
    $idkat=isset($_GET['idkat'])?$_GET['idkat']:null;
    $tabel=isset($_GET['tbl'])?$_GET['tbl']:null;
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
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

        <!-- <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" direction="left" align="center">
          Selamat datang di website Natasyagift. Untuk melakukan pemesanan silahkan menghubungi contact person kami. Kepuasan anda adalah tanggung jawab kami. Terimakasih telah mengunjungi website Natasyagift :) dan selamat berbelanja :)
        </marquee> -->

        <div id="slider-container">
            <div class="flexslider">
              <ul class="slides">
                    <li>
                    <img src="images/slide 1.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 2.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 3.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 4.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 5.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 6.jpg" />
                    </li>
                    <li>
                    <img src="images/slide 7.jpg" />
                    </li>
                </ul>
            </div>
        </div>

            <br class="clearfloat">

<!-- <div class="LeftContent">
<?php 

    //$countkat = "SELECT idkat FROM kategori";
    //$exekat=mysql_query($countkat);
    //$hasilkat=mysql_num_rows($exekat);
   ?>
   <div class="kat">
  <div class="kategori">
    <form>
      <table>
      <tr><td><?php //echo $hasilkat; ?> Kategori :</td></tr>
      <tr><td>&nbsp</td></tr>  
      <?php 
          //$sql = mysql_query('SELECT * FROM kategori');
          //while ($kat = mysql_fetch_array($sql)){
          //$id = $kat['idkat'];
          //$nama = $kat['namakat'];
          //echo "<tr><td><a href='index.php?tbl=kategori&idkat=".$id."'>".$nama."</a></td><tr>";
      //}
       ?>
      </table>
    </form>  
  </div>
</div>

  <div class="testi">
    <form>
    <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up" width="100%" align="center">
      <table>
      <tr><td> Testimoni :</td></tr>
      <tr><td>&nbsp</td></tr>
        <?php 
          //$sql = mysql_query('SELECT * FROM testimoni');
          //while ($tes = mysql_fetch_array($sql)){
          //$id = $tes['idtes'];
          //$testi = $tes['testi'];
          //echo "<tr><td><img src='".$testi."' width='150px' height='150px'></td></tr>";
          //}
       ?>
      </table>
      </marquee>
    </form>
</div>    -->



<?php 
    $query = mysql_query("SELECT COUNT(*) jumData from produk");
  $data = mysql_fetch_array($query);
  $jumlahData = $data["jumData"];
   
  //Tentukan Jumlah Data Per Halaman
  $dataperPage = 12;
   
  //Buat kondisi saat request halaman
  if(isset($_GET['page']))
  {
    $noPage= $_GET['page'];
  }
 
  else
  {
    $noPage=1;
  }
   
  //Tentukan Awal dari data yang akan ditampilkan
  $offset = ($noPage-1)*$dataperPage;
 ?>

<div class="post">
<div id="isi">

	<?php
    if($idkat!=""){
      $query="SELECT * FROM produk WHERE idkat='".$idkat."' ORDER BY kodeproduk DESC limit $offset, $dataperPage";
     
    } else{
      $query="SELECT * FROM produk ORDER BY kodeproduk DESC limit $offset, $dataperPage"; 
    }
    $result=mysql_query($query);



		while($data=mysql_fetch_array($result)){
      echo '<div class="produk">';
           echo "<a href='detail.php?tbl=produk&id=".$data['kodeproduk']."'>";
           echo "<img src='".$data['gambar']."' width='150px' height='150px'>";
           echo '</a>';
           echo '<br class="clearfloat">';
           echo '<div class="KotakKet">';
           echo $data['namaproduk'].'<br>';
           echo 'Harga : Rp. '.number_format($data['harga'],2,',','.');
           echo '</div>';
           echo '</div>';
   		}
       ?>

<br class="clearfloat"><br><br>

<div class="paging">
<?php 
    $jumPage=ceil($jumlahData/$dataperPage);
 if($noPage > 1)
 {
  echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>Prev &nbsp&nbsp&nbsp</a>";
 }
  
 for($page = 1; $page <= $jumPage; $page++)
 {
  $showPage = 0;
  if ((($page >= $noPage - 12) && ($page <= $noPage + 12)) || ($page == 1) || ($page == $jumPage))
  {
   if (($showPage == 1) && ($page != 2)) {
     
    echo " ... ";
   }
   if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) {
     
    echo " ... ";
   }
   if ($page == $noPage){
     
     echo " <b>".$page."</b>";
   }
   else {
    echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";;
   }
   $showPage=$page;
  }
 }
 
 
 if ($noPage < $jumPage) {
  echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>&nbsp&nbsp&nbsp Next</a>";
  }
 ?>

</div>
</div>
</div>
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
</div>
</div>

</body></html>
<!--</body>
</html>-->