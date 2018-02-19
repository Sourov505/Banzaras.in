<?php $page=5; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Banzaras is a place where you can truely be banzara">
    <meta name="keywords" content="Banzaras, travel, trek,holiday, weekend getaways">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="temp/style.css" rel="stylesheet">
    <link href="temp/style2.css" rel="stylesheet" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="temp/w3.css" rel="stylesheet">
    <link href="temp/contact.css" rel="stylesheet">
    <script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
  });
  $(document).ready(function () {
  $(".title-contact, .contact-email").fadeIn("slow");
});

  </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="clearfix visible-md-block visible-lg-block"><br></div>
      <nav class="navbar">
        <div class="container-fluid">
          <ul class="nav nav-pills nav-justified">
            <li <?php echo ($page==1)?'class="active"':'""'; ?>><a href="index.php">Home</a></li>
            <li <?php echo ($page==2)?'class="dropdown active"':'"dropdown"'; ?>>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="categories.php?category=0">Mountain Love</a></li>
                <li><a href="categories.php?category=1">Nature's Lap</a></li>
                <li><a href="categories.php?category=2">Beach Calling</a></li>
              </ul>
            </li>
            <li <?php echo ($page==3)?'class="active"':'""'; ?>><a href="weekEndGetaways.php">Weekend Getaways</a></li>
            <li <?php echo ($page==4)?'class="active"':'""'; ?>><a href="travelogues.php">Travelogues</a></li>
            <li <?php echo ($page==5)?'class="active"':'""'; ?>><a href="contact.php">Contacts</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        </ul>
      </div>
    </nav>
    <div class="clearfix visible-md-block visible-lg-block"><br><br></div>
<div class="contract">
  <br><br>
    <h3 style="color:#fff">Reach out to us anytime and we will happily answer your queries.</h3>
   <a href="#"> <i class="glyphicon glyphicon-envelope"></i>info@banzaras.in </a>
   <a href="#"> <i class="glyphicon glyphicon-earphone"></i>+91 9674287787 </a>
 </div>
 <br><br><br>
    <div class="container">
      <div class="clearfix visible-md-block visible-lg-block"><br><br></div>
      <div class="center-horizontal-align"><img src="images/group.png" ></div>

      <h3 style="text-align:center;">Meet our team</h3>
      <div class="team">
        <div class="col-xs-12 col-md-6">
      <img src="images/person.png" >
      <h3>Sourov Pramanik</h3>
      <h3>Full Stack Developer</h3>
    </div>
    <div class="col-xs-12 col-md-6">
  <img src="images/person.png" >
  <h3>Madhurima Pramanik</h3>
  <h3>Content Writer</h3>
    </div>

    </div>


</div>

  </body>

<div class="clearfix visible-md-block visible-lg-block"><br><br><br><br><br><br><br><br><br></div>
  <div class="footer" id="footer" style='height:12%;'>
    <div class="container-fluid" style ='margin-left:5px;'>
      <ul class="social">
        <br>
        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
        <li> <a href="#"> <i class="fa fa-instagram">   </i> </a> </li>

      </ul>
    <p class="pull-right"> Home is where heart belongs <mark>@banzaras.in</mark></p>
  </div>
  </div>


</html>
