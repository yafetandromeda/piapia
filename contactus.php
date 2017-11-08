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

<div class="LeftContent">

</div>
<div class="post">
<div class="contactus">
<?PHP
/*
    Contact Form from HTML Form Guide
    This program is free software published under the
    terms of the GNU Lesser General Public License.
    See this page for more info:
    http://www.html-form-guide.com/contact-form/php-contact-form-tutorial.html
*/
require_once("./include/fgcontactform.php");

$formproc = new FGContactForm();


//1. Add your email address here.
//You can add more than one receipients.
$formproc->AddRecipient('piapia37jogja@gmail.com'); //<<---Put your email address here


//2. For better security. Get a random tring from this link: http://tinyurl.com/randstr
// and put it here
$formproc->SetFormRandomKey('CnRrspl1FyEylUj');


if(isset($_POST['submitted']))
{
   header("location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Contact us</title>
      <link rel="STYLESHEET" type="text/css" href="contact.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>

<!-- Form Code Start -->
<form id='contactus' action='<?php echo $formproc->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<legend>Contact us</legend>
&nbsp
<p>Untuk segala pertanyaan yang ingin disampaikan, silahkan mengisi kolom berikut atau langsung dapat menghubungi contact yang tertera pada bagian bawah.</p>
&nbsp
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
<input type='hidden'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' />

<div class='short_explanation'>* required fields</div><br>

<div><span class='error'><?php echo $formproc->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='name' >Your Full Name*: </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $formproc->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='contactus_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >Email Address*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $formproc->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='contactus_email_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='message' >Message:</label><br/>
    <span id='contactus_message_errorloc' class='error'></span>
    <textarea rows="10" cols="50" name='message' id='message'><?php echo $formproc->SafeDisplay('message') ?></textarea>
</div>


<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("message","maxlen=2048","The message is too long!(more than 2KB!)");

// ]]>
</script>
</body>
</html>

</div>

<br class="clearfloat"><br><br>

</div>
    <div class='cp'>
        <div class='isicp'>
        <form>
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
</div>
<div class="footer">
    <p align="center">created by<a href="http://www.hitamcoklat.com/">Yafet Andromeda </a></p>
</div>
</div>

</body></html>
<!--</body>
</html>-->