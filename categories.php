<?php
require_once("include/config.php");
require_once("include/conn.php");
$page=2;
$invisible='';
$errors=array();
if(isset($_POST['QuerySubmit']) && $_POST['QuerySubmit']=='Submit')
{
$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$email=$_POST['email'];
$days=$_POST['days'];
$persons=$_POST['person'];
$trip=$_POST['placeInterested'];
$query=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
$to="info@banzaras.in";
$sub= "Enquiry From : ".$name;
$mailBody="Name : ".$name. "<br>";
$mailBody.="Email: ". $email. "<br>";
$mailBody.="Days: ".$days. "<br>";
$mailBody.="Persons: ".$persons. "<br>";
$mailBody.="Trips Interested: " .$trip. "<br>";
$mailBody.="Query: " .$query. "<br>";
//var_dump($mailBody);
$header= "From:care@banzaras.in \r\n";
$header.="CC: info@banzaras.in \r\n";
$header.="MIME-Version: 1.0 \r\n";
$header.="Content-type: text/html \r\n";
$mailSent=mail($to,$sub,$mailBody,$header);
if($mailSent)
{
  echo "<script> alert('\Mail Sent Successfully\')</script>";
  #We can also sent a confiramtion  mail to the user
}
}

function getAlltrips()
{
  $queryDestination="select placeName from detail where isActive=1 and isVisible=1 order by placeId desc";
  $allDetail= mysql_query($queryDestination) or die("Error in Query");
  $queryBlogs="select title from blog where isActive=1 and isVisible=1 order by blogId desc";
  $allBlogs=mysql_query($queryBlogs) or die("Error in Query");
  echo"<select class=\"form-control\" id=\"placeInterested\" name=\"placeInterested\">";
  echo"<option selected>Trip Intersted</option>";
  while($result=mysql_fetch_array($allDetail))
  {
    $placeName=$result['placeName'];
    echo"<option>$placeName</option>";
 }
 while($result=mysql_fetch_array($allBlogs))
 {
   $title=$result['title'];
   echo"<option>$title</option>";
}
echo"</select>";
}


function showImage()
{
    $SlideArray= array('First','Second','Third', 'Fourth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth');
    $query="select path from image where imageId in (0,1,2,3,4,5,6,7,8,9,10)";
    $allImages= mysql_query($query) or die("Error in Query");
    $i=0;
    echo "<ol class=\"carousel-indicators\">";
    while($images=(mysql_fetch_array($allImages)))
    {
      //var_dump($images);
      $state='';
      if($i==0)
        $state='class="active"';
      echo "<li data-target={$images['path']} data-slide-to=$i {$state}></li>";
      $i++;
    }
      echo "</ol>";
      echo "<div class=\"carousel-inner\">";

    $i=0;
    $allImages= mysql_query($query) or die("Error in Query");
    while($images=(mysql_fetch_array($allImages)))
    {
      $slideNo=$SlideArray[$i]." Slide";
      $item='item';
      if($i==0)
      $item='item active';
      echo "<div class='$item'>";
      echo "<img src={$images['path']}  alt='$slideNo'>";
      echo "</div>";
      $i++;
    }

}



function setInvisible()
{
  global $invisible;
  echo"$invisible";
}


function showDetail()
{
  if(isset($_GET['destinationId']))
  {
    $dId=(int)$_GET['destinationId'];
    $query="select placeName,description,routeDetails from detail where placeId=$dId";
    $result= mysql_query($query) or die("Error in Query");
    $detail= (mysql_fetch_array($result));
    echo "<div class=\"page-header\">";
    echo "<br><h2>$detail[0]</h2></div>";
    echo "<p>$detail[1]</p>";
    if(!empty($detail[2]))
    {
    echo "<br><ul><li><h3>How to Reach</h3></li></ul>";
    echo "<p>$detail[2]</p>";
    }
    echo"</div>";
  }
}

function showWeekendGetaways()
{
  if(isset($_GET['category']) && $_GET['category']<3 && $_GET['category']>=0)
  {
  $category=array('Mountain Love','Nature\'s lap','Beach Calling');
  $catId=filter_var((int)$_GET['category'],FILTER_SANITIZE_NUMBER_INT);
  $query="select placeId,placeName,images from detail where category={$catId} and isActive=1 and isVisible=1";
  $allDetail= mysql_query($query) or die("Error in Query");
  if(!empty($allDetail))
    echo"<h2>{$category[$catId]}</h2>";
  while($result=mysql_fetch_array($allDetail))
  {
  $image=$result['images'];
  $placeId=$result['placeId'];
  $p=$result['placeName'];
  $place=explode(' ',$p);
  $placeName=$place[0];
  //var_dump($placeName);
  $imageArray=explode(',',$image);
  $imageId=(int)$imageArray[0];
  $imageQuery="select path from image where imageId = $imageId";
  $imageResult=mysql_query($imageQuery) or die("Error in Query");
  $imageLocation=mysql_fetch_array($imageResult);
  echo"<li> <img src={$imageLocation['path']} class=\"w3-hover-grayscale\" alt={$placeName}>";
  $len=strlen($placeName);
  if($len > 12 && $len <= 14)
  {
  echo "<span style='left:82px;'>$placeName</span>";
  }
  else if($len >= 16 && $len < 18)
  {
  echo "<span style='left:60px;'>$placeName</span>";
  }
  else if($len >= 18 && $len <=21)
  {
  echo "<span style='left:50px;'>$placeName</span>";
  }
  else if($len> 21 && $len<= 25)
  {
    echo "<span style='left:32px;'>$placeName</span>";
  }
  else if($len>25)
  {
    echo "<span style='left:13px;'>$placeName</span>";
  }
  else
  {
    echo "<span style='left:88px;'>$placeName</span>";
  }
  echo"<button type=\"button\" class=\"btn btn-default\"> <a href=\"weekEndGetaways.php?destinationId=$placeId\">Explore</a>
   </button></li>";

  }

showBlogs($catId);
}
}


function showBlogs($catId)
{
  $query="select title,images,blogId from blog where categoryId=$catId and isActive=1 and isVisible=1";
  $allDetail= mysql_query($query) or die("Error in Query");
  while($result=mysql_fetch_array($allDetail))
  {
  $image=$result['images'];
  $title=$result['title'];
  $blogId=$result['blogId'];
  //var_dump($placeName);
  $imageArray=explode(',',$image);
  $imageId=(int)$imageArray[0];
  $imageQuery="select path from image where imageId = $imageId";
  $imageResult=mysql_query($imageQuery) or die("Error in Query");
  $imageLocation=mysql_fetch_array($imageResult);
  $title = trim($title);
  echo"<li> <img src={$imageLocation['path']} alt={$title}>";
  $len=strlen($title);
  if($len > 12 && $len <= 14)
  {
  echo "<span style='left:82px;'>$title</span>";
  }
  else if($len >= 16 && $len < 18)
  {
  echo "<span style='left:60px;'>$title</span>";
  }
  else if($len >= 18 && $len <=21)
  {
  echo "<span style='left:40px;'>$title</span>";
  }
  else if($len> 21 && $len<= 25)
  {
    echo "<span style='left:32px;'>$title</span>";
  }
  else if($len>25)
  {
    echo "<span style='left:13px;'>$title</span>";
  }
  else
  {
    echo "<span style='left:85px;'>$title</span>";
  }
  getUrl($blogId);
  }

}

function getUrl($blogId)
{
  $query="select Url from permalink where blogId=$blogId";
  //var_dump($query);
  $allDetail= mysql_query($query) or die("Error in Query");
  $result=mysql_fetch_array($allDetail);
  $blogUrl=$result['Url'];
  echo"<button type=\"button\" class=\"btn btn-default\"> <a href={$blogUrl}>Explore</a>
   </button></li>";
}

function show_comments($article_id)
{
  $perpage=3;
  if(isset($_GET['page']))
  {
    $pageno=$_GET['page'];

  }
  else
    {
      $pageno=1;
    }

  $start=($pageno-1)*$perpage;
  $blog_q="select * from blog limit {$start},{$perpage}";
  $allBlogs=mysql_query($blog_q) or die("Error in Query");

  if($allBlogs)
  {

  while($blog_q=mysql_fetch_array($allBlogs))
   {
     $text=$blog_q['body'];
     $body=substr(ucfirst($text),0,300);
     //var_dump($comments_row);
     echo "<div class=\"col-xs-12 col-md-4\">";
     echo "<p> {$body} .... <a href='#'> Read more </a></p>";
     echo "<button type=\"button\" class=\"btn btn-success\">Read More</button>";
     echo "</div>";
   }

  }

  $blog_q="select count(*) from comments";
  $allBlogs=mysql_query($blog_q) or die("Error in Query");
  $count= (mysql_fetch_array($allBlogs));

  $totalBlogs=(int)$count['count(*)'];
  $totalpage=ceil($totalBlogs/$perpage);

echo "<div class=\"text-center\"> <ul class=\"pagination pagination-lg\">";
  if($pageno>1)
  {
    $ppage=$pageno-1;
    echo  "<li><a href=\"hDemo.php?page={$ppage}\">Previous</a></li>";
  }
  else
  {
    echo  "<li class=\"previous disabled\"><a href=\"hDemo.php\">Previous</a></li>";
  }


  for($p=1;$p<=$totalpage;$p++)
  {
    if($p==$pageno)
      echo "<li class=\"active\"><a href=\"hDemo.php?page={$p}\">{$p}</a></li>";
    else
      echo "<li><a href=\"hDemo.php?page={$p}\">{$p}</a></li>";
  }


  if($pageno<$totalpage)
  {
    $ppage=$pageno+1;
    echo  "<li><a href=\"hDemo.php?page={$ppage}\">Next</a></li>";
  }
  else
  {
    echo  "<li class=\"next disabled\"><a href=\"hDemo.php?page={$pageno}\">Next</a></li>";
  }
  echo "</ul></div>";



}

function setMetadata()
{
   if(isset($_GET['destinationId']))
   {
     $destinationId=$_GET['destinationId'];
     $queryBlogs="select * from permalink where DestinationId=$destinationId";
     $blog=mysql_query($queryBlogs) or die("Error in Query");
     $result=mysql_fetch_array($blog);
     global $invisible;
	 $blogId=$result['BlogId'];
     $keyword=$result['Keyword'];
     $description=$result['Description'];
     $title=$result['Title'];
	 $invisible = $result['Invisible'];
     echo"<meta name='keywords' content='$keyword'>";
     echo"<meta name='description' content='$description'>";
     echo"<title>$title</title>";
  }
  else
    {
      echo"<meta name='keywords' content=\"weekEnd GetaWays,Holiday\">";
      echo"<meta name='description' content=\"Weekend travel Guide\">";
      echo"<title>Categories</title>";
    }
  }


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php setMetadata();?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="temp/style.css" rel="stylesheet">
    <link href="temp/style2.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
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
	<?php include_once("analyticstracking.php") ?>
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
<div>

<div class="container-fluid">
<div class="carosal">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
      <?php showImage(); ?>
        <!-- Carousel controls -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
  </div>
  <div>
        <!-- Wrapper for carousel items -->

        <!-- Carousel controls -->

    </div>
 <!-- end of row -->
<div class="container">

        <div class="row">
          <div class="col-xs-12 col-md-9">
<div class="blog-thumbnail">
<ul>
<?php echo showWeekendGetaways()?>;
 <div class="clearfix visible-xs"></div>


</div>
</ul>

</div>
<div class="col-xs-12 col-md-3 freeTripPlaning">
<div class="clearfix visible-xs">&nbsp;<br></div>
<div class="formHeader"><h3>Write to us</h3></div>
<div class="formbody">
<form name="TripPlaning" method="post" action="index.php" class="form-horizontal">
<div class="form-group">
  <!-- <label for="name" class="control-label "> Name: </label> -->
   <div class="col-sm-12" style='padding-top:15px;'>
  <input type="text" id="name" name="name" class="form-control" placeholder="*Name" required>
</div>
</div>
<div class="form-group">
  <!-- <label for="email" class="control-label ">Email: </label> -->
  <div class="col-sm-12">
  <input type="email" id="email" name="email" class="form-control" placeholder="*Email Id" required>
</div>
</div>

<div class="form-group">
  <!-- <label for="phoneNo" class="control-label ">Phone No: </label> -->
  <div class="col-sm-12 input-group" style="padding-left: 15px;padding-right: 12px;" >
    <span class="input-group-addon">+91</span>
  <input type="text" id="phoneNo" name="phoneNo" class="form-control" placeholder="*Phone" required onkeypress="return isNumber(event)">
</div>
</div>

<div class="form-group">
  <!-- <label for="trip" class="control-label  ">Trip Interested: </label> -->
  <div class="col-sm-12">
    <?php getAlltrips();?>
</div>
</div>

<div class="form-group">
<!-- <label class="control-label col-sm-4">No of Person </label> -->
<div class="col-sm-12">
    <!-- <label for="days">Select:</label> -->
    <select class="form-control" id="days" name="days">
      <!-- <option value="0">Select Days</option> -->
      <option value="1">2 days 1 Night </option>
      <option selected>2 days 1 Night</option>
      <option>3 days 2 Night</option>
      <option>4 days 3 Night</option>
      <option>5 days 4 Night</option>
      <option>6 days 5 Night</option>
      <option>7 days 6 Night</option>
    </select>
  </div>
</div>
<div class="form-group">
<!-- <label class="control-label col-sm-4">No of Person </label> -->
<div class="col-sm-12">
    <!-- <label for="days">Select:</label> -->
    <select class="form-control" id="person" name="person">
      <option value="0">No. of Person</option>
      <option value="1">1</option>
      <option selected>2 persons</option>
      <option>3 persons</option>
      <option>4 persons</option>
      <option>5 persons</option>
      <option>6 persons</option>
      <option>7-10 persons</option>
    </select>
  </div>
</div>
  <div class="form-group">
    <!-- <label for="comment" class="control-label" >Comment: </label> -->
    <div class="col-sm-12">
   <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Query"></textarea>
   <div class="col-sm-12" style='padding-top:15px;'>
    <button type="button" class="btn btn-success" data-toggle="popover" data-placement="top"  data-content="9674287787"><span class="glyphicon glyphicon-earphone">Call</span></button>
   </div>
  </div>
  </div>

<div class="col-sm-2">
  &nbsp;
</div>

<div>
<div class="col-sm-3">
<div class="form-group">
  <button type=reset class="btn btn-default"> Reset </button>
</div>
</div>

<div class="col-sm-1">
<div class="form-group">
</div>
</div>
</div>

<div class="col-sm-3">
<div class="form-group">
  <button type=submit class="btn btn-primary" name="QuerySubmit" value="Submit"> Submit </button>
</div>
</div>
</form>
</div>

</div>

</div>
</div>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>

<div class="invisible">
<?php setInvisible(); ?>
</div>

</body>

<div class="clearfix visible-md-block visible-lg-block"><br></div>
  <div class="footer" id="footer">
    <div class="container-fluid">
      <ul class="social">
        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
        <li> <a href="#"> <i class="fa fa-instagram">   </i> </a> </li>

      </ul>
  <p class="pull-right"> Home is where heart belongs <mark>@banzaras.in</mark></p>
</div>
</div>
</html>
