<?php ob_start();
$submit_error;
$SUBMITTED_NAME = "";
$SUBMITTED_EMAIL = "";
$SUBMITTED_CITY = "";
$SUBMITTED_STATE = "";
$SUBMITTED_COLLEGE = "";
$SUBMITTED_CONTACT = "";
if(isset($_POST['REGISTER']))
{
	include("connect.php");
	include("function.php");
	$SUBMITTED_NAME =$_POST['NAME'];
	$SUBMITTED_EMAIL =$_POST['EMAIL'];
	$SUBMITTED_CITY =$_POST['CITY'];
	$SUBMITTED_STATE =$_POST['STATE'];
	$SUBMITTED_COLLEGE =$_POST['COLLEGE'];
	$SUBMITTED_CONTACT =$_POST['CONTACT'];
	$ALMA_ID = generate_ALMA_ID($con);
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");
	
    if($ALMA_ID == -1 )
	{
		$submit_error = "ERROR: We are unable to Process the request. Please contact the Support to know the problem";
		echo "<script>alert('ERROR: We are unable to Process the request. Please contact the Support to know the problem. ')</script>";
	}
	if(CA_exists($SUBMITTED_CONTACT, $SUBMITTED_EMAIL, $con))
	{
		$submit_error = "Already registered";
		echo "<script>alert('Already registered!! If you are facing any problem please contact us at @+91 9439092128/9174635048.')</script>";
	}
	else if(strlen($SUBMITTED_CONTACT) != 10)
	{
		$submit_error = "Phone Number Invalid. Please Check Again";
		echo "<script>alert('Phone Number Invalid. Please Check Again')</script>";
	}
	else if($SUBMITTED_CONTACT=="")
	{
		$SUBMITTED_CONTACT=="Not Given";
	}
	else if(!filter_var($SUBMITTED_EMAIL, FILTER_VALIDATE_EMAIL))
	{
		$submit_error = "Email Address Invalid";
		echo "<script>alert('Email Address Invalid')</script>";
	}
	else
	{
		$insert_query="INSERT INTO ca2021(ALMA_ID, NAME, EMAIL, CONTACT, COLLEGE, STATE, CITY, DATE)
VALUES('$ALMA_ID','$SUBMITTED_NAME','$SUBMITTED_EMAIL','$SUBMITTED_CONTACT','$SUBMITTED_COLLEGE', '$SUBMITTED_STATE', '$SUBMITTED_CITY', '$date')";
		
				
		$target_dir = "PHOTOS/";
		$file_name = $target_dir.strtolower(basename($_FILES['ID1']['name']));
		$uploadOk = 1;
		$imagefiletype = pathinfo($file_name,PATHINFO_EXTENSION);
		$newfile_name = $target_dir."$ALMA_ID.".strtolower($imagefiletype);
		
		if((filesize($_FILES["ID1"]["tmp_name"])/1024) > (5*1024))
		{
			$id_upload_error = "File is too big. Cannot be uploaded";
			echo "<script>alert('Image File size is too big. File should be less than 5Mb')</script>";
		}
		else if(($imagefiletype != "png")&&($imagefiletype != "jpg")&&($imagefiletype != "jpeg")&&($imagefiletype != "JPG"))
		{
			$id_upload_error = "File Not supported. File should be an Image";
			echo "<script>alert('File Not supported. File should be an Image. File type is $imagefiletype')</script>";
		}
		if(mysqli_query($con,$insert_query))
		{
			$a=0;
			
			if(move_uploaded_file($_FILES["ID1"]["tmp_name"], $newfile_name))
			{
			    $a=1;
			}
			
			
			
			if($a==1)
			{
					$submit_error = "Registered successfully";
					clearstatcache();
					$submit_error = "You have succesfully registered. Check your Email for further instructions.";
					$submit_status = 1;		
					echo "<script>alert('You have succesfully registered. Best of luck!!. Stay Home. Stay Safe. ')</script>";
					send_email($SUBMITTED_EMAIL, $SUBMITTED_NAME, $SUBMITTED_CONTACT, $SUBMITTED_COLLEGE, $SUBMITTED_STATE, $SUBMITTED_CITY, $ALMA_ID);
					echo "<script>window.location = 'http://memories.almafiesta.com'</script>";
					exit();
			}
			else
			{
				$submit_error = "ERROR: We are unable to Process the request. Please contact the Support to know the problem";
				echo "<script>alert('File_Upload ERROR: We are unable to Process the request. Please contact the Support to know the problem')</script>";
			}

					
		}
		else
		{
			$submit_error = "ERROR: We are unable to Process the request. Please contact the Support to know the problem";
			echo "<script>alert('Query ERROR: We are unable to Process the request. Please contact the Support to know the problem')</script>";
			$submit_status = 0;

			
		}
	}
}
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125406566-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  ga('require', 'GTM-NFWCSQH');

  gtag('config', 'UA-125406566-1');
</script>
<style>.async-hide { opacity: 0 !important} </style>
<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
(a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
})(window,document.documentElement,'async-hide','dataLayer',4000,
{'GTM-NFWCSQH':true});</script>


    <title>ALFAAZ | ALMA FIESTA 2021</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#121212">
    <!-- Favicon -->
    <link href="img/alma_logo.png" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Clicker+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet">


    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	@media screen and (max-width: 700px)
	{
		.section-title{
			font-size:35px;
			display: inline-block;
			background: #014242;
			padding: 0 20px;
			margin-bottom: 0;
		}
		.contact-form{
			margin-top:30px;
		}
		.register-yourself
		{
			margin-top:20px;
		}
		
	}
	@media screen and (max-width: 479px)
	{
		.header-area
		{
			position:fixed;
			margin-bottom: 202px;
		}
		.fa-bars
		{
			color:#0F6;
		}
	}
	@media screen and (min-width: 700px)
	{
		.section-title
		{
			font-size:60px;
			display: inline-block;
			background: #014242;

			margin-bottom: 0;
		}
	}
h1 {text-align: center;}
h2 {text-align: center;}
h3 {text-align: center;}
</style>
</head>

<body>
   <!-- <br>
    <br>
    <br>
<h1>Registrations Closed!!</H1>
<br>
<h3>Stay Home!! Stay Safe!!</h3>
<br>
<h3>Keep Writing!!</h3>
<br><H2>ALL THE BEST FOR THE RESULTS!!</H2> -->
	
<!-- Page section start -->
	<section class="page-section pt100" id="register">
		<div style= "background-image: url('')">
		<div class="container pb100">
			<div class="row">
            
				
				<div class="col-lg-8">
                	<div class="section-title text-center">
                		<center style="color: white"> Show Your Talent! </center>
                    </div>
                    <br><br>
					<form class="contact-form" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
						<input type="text" name="NAME" placeholder="Your Name" value="<?php echo $SUBMITTED_NAME;?>" required>
						<input type="text" name="EMAIL" placeholder="Email Id" value="<?php echo $SUBMITTED_EMAIL;?>"  required>
                        <input type="number" name="CONTACT" placeholder="Contact Number" value="<?php echo $SUBMITTED_CONTACT;?>" >
                        <input type="text" name="COLLEGE" placeholder="College/School Name (only for students)" value="<?php echo $SUBMITTED_COLLEGE?>" >
                        <select name="STATE" class="form-control" id="state" value="<?php echo $SUBMITTED_STATE;?>" >
                        <option disabled="" value="" selected="">----Select State----</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Pondicherry">Pondicherry</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttaranchal">Uttaranchal</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="West Bengal">West Bengal</option>
                        </select>
                        <br>
                        <input type="text" id="CITY" placeholder="City" name="CITY" value="<?php echo $SUBMITTED_CITY;?>" >
                        <label for="ID">Upload Your Poem:</label><input type="file" id="ID1" placeholder="work" name="ID1" title="PHOTO" accept="image/*"  required><br>
                        
                        <input type="checkbox" placeholder="Terms" style="width:20px;" required>&nbsp;&nbsp;I have read, understand and agree to all the Rules as laid by the authorities.
                        <br><br>
                        
						<input class="site-btn sb-dark" type="submit" name="REGISTER" id="REGISTER" value="Register" style="width:50%; cursor:pointer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="site-btn sb-solid-dark" type="reset"  style="width:50%; cursor:pointer">
					</form>
				</div>
			</div>

                <br>
                <br>
			</div>
		</div>
	</section>
	<!-- Page section end -->

	<hr>
	

	    
        <br><br><br>
        <center><div class="copyright">Copyright &copy; 2020 | Designed By Web Development Team</div></center>
        <br>
	</div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/isotope.pkgd.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.owl-filter.js"></script>
	<script src="js/main.js"></script>
</body>
<script>

$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
  </script>

</html>