<?php
require_once("include/config.php");
require_once("include/conn.php");
$page=4;
$blogId=-1;
$prevBlogId=-1;
$nextBlogId=-1;
$authorId=-1;
$authorFb='';
$authorInsta='';
$authorTwitter='';
$authorBio='';
$authorName='';

function setAuthorDetails()
{
  global $blogId, $authorFb, $authorInsta,$authorTwitter,$authorBio,$authorName;
  $query="select * from author where authorId = (select authorId from blog where blogId = $blogId)";
  //var_dump($query);
  $authorDetails= mysql_query($query) or die("Error in Query");
  $result= mysql_fetch_array($authorDetails);
  $authorFb=$result['facebook'];
  $authorInsta=$result['instagram'];
  $authorTwitter=$result['twitter'];
  $authorName=$result['name'];
  $authorBio=$result['bio'];
}

function showAuthorBio()
{
  global $authorBio;
  echo"$authorBio";
}

function showAuthorName()
{
  global $authorName;
  echo"$authorName";
}


function showFbLink()
{
  global $authorFb;
  echo"$authorFb";
}

function showTwitter()
{
  global $authorTwitter;
  echo"$authorTwitter";
}

function showInsta()
{
  global $authorInsta;
  echo"$authorInsta";
}


function showNextBlog()
{

  global $nextBlogId, $blogId;
  $nextBlogId=$blogId+1;
  $queryBlogs="select Url from permalink where BlogId=$nextBlogId";
  $blog=mysql_query($queryBlogs) or die("Error in Query");
  $result=mysql_fetch_array($blog);
  $nextBlogUrl=$result['Url'];

  if(empty($nextBlogUrl))
    echo"<li class=\"next disabled\"><a href=\"#\">Next Article</a></li>";
  else {
    echo"<li class=\"next\"><a href=$nextBlogUrl>Next Article</a></li>";
  }
}

function showPrevBlog()
{
  global $prevBlogId, $blogId;
  $prevBlogId=$blogId-1;
  $queryBlogs="select Url from permalink where BlogId=$prevBlogId";
  $blog=mysql_query($queryBlogs) or die("Error in Query");
  $result=mysql_fetch_array($blog);
  $prevBlogUrl=$result['Url'];
  if(empty($prevBlogUrl))
    echo"<li class=\"previous disabled\"><a href=\"#\">Previous Article</a></li>";
  else {
    echo"<li class=\"previous\"><a href=$prevBlogUrl>Previous Article</a></li>";
  }
}


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
  $queryBlogs="select title,blogId from blog where isActive=1 and isVisible=1 order by blogId desc";
  $allBlogs=mysql_query($queryBlogs) or die("Error in Query");
  global $blogId;
  echo"<select class=\"form-control\" id=\"placeInterested\" name=\"placeInterested\">";
  while($result=mysql_fetch_array($allDetail))
  {
    $placeName=$result['placeName'];
    echo"<option>$placeName</option>";
 }
 while($result=mysql_fetch_array($allBlogs))
 {
   $title=$result['title'];
   echo"<option>$title</option>";
   if($result['blogId']==$blogId)
     echo"<option selected>$title</option>";
}
echo"</select>";

}

function setMetadata()
{
   $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $queryBlogs="select * from permalink where Url like '%{$url}%' ";
   $blog=mysql_query($queryBlogs) or die("Error in Query");
   $result=mysql_fetch_array($blog);
   global $blogId;
   $blogId=$result['BlogId'];
   $keyword=$result['Keyword'];
   $description=$result['Description'];
   $title=$result['Title'];
   echo"<meta name='keywords' content='$keyword'>";
   echo"<meta name='description' content='$description'>";
   echo"<title>$title</title>";
   setAuthorDetails();
}

function showImage()
{
    global $blogId;
    //var_dump($blogId);
    $SlideArray= array('First','Second','Third', 'Fourth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth');
    $query="select images from blog where blogId=$blogId";
    $allImages= mysql_query($query) or die("Error in Query");
    $images= (mysql_fetch_array($allImages));
    $image=$images[0];
    $imageArray=explode(',',$image);
    $arrayLength = sizeOf($imageArray);
    //var_dump($images);
    echo "<ol class=\"carousel-indicators\">";
    for($i=0;$i<$arrayLength;$i++)
    {
      $imageId=(int)$imageArray[$i];
      $imageQuery="select path from image where imageId = $imageId";
      $result=mysql_query($imageQuery) or die("Error in Query");
      $imageLocation=(mysql_fetch_array($result));
      $state='';
      if($i==0)
        $state='class = \"active\"';
      echo "<li data-target='$imageLocation[0]' data-slide-to=$i $state></li>";
    }
    echo "</ol>";
    echo "<div class=\"carousel-inner\">";
    //var_dump($imageArray);
    for($i=0;$i<$arrayLength;$i++)
    {
      $imageId=(int)$imageArray[$i];
      $imageQuery="select path from image where imageId = $imageId";
      $result=mysql_query($imageQuery) or die("Error in Query");
      $imageLocation=(mysql_fetch_array($result));
      $slideNo=$SlideArray[$i]." Slide";
      $item='item';
      if($i==0)
      $item='item active';
      echo "<div class='$item'>";
      echo "<img src='$imageLocation[0]' alt='$slideNo' class=\"w3-hover-grayscale\">";
      echo "</div>";
    }


}

function showWeekendGetaways()
{
  $query="select placeId,placeName,images from detail where isActive=1 and isVisible=1 order by placeId desc";
  $allDetail= mysql_query($query) or die("Error in Query");
  $i=0;
  while($result=mysql_fetch_array($allDetail))
  {
  $i++;
  if($i>6)
  break;
  $image=$result['images'];
  $placeId=$result['placeId'];
  $placeName=$result['placeName'];
  //var_dump($placeName);
  $imageArray=explode(',',$image);
  $imageId=(int)$imageArray[0];
  $imageQuery="select path from image where imageId = $imageId";
  $imageResult=mysql_query($imageQuery) or die("Error in Query");
  $imageLocation=mysql_fetch_array($imageResult);
  echo"<li> <img src={$imageLocation['path']}>";
  $placeName=trim($placeName);
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

}

function showBlogs()
{
  $query="select title,images from blog where isActive=1 and isVisible=1 order by blogId desc";
  $allDetail= mysql_query($query) or die("Error in Query");
  $i=0;
  while($result=mysql_fetch_array($allDetail))
  {
    $i++;
  if($i>6)
    break;
  $image=$result['images'];
  $title=$result['title'];
  //var_dump($placeName);
  $imageArray=explode(',',$image);
  $imageId=(int)$imageArray[0];
  $imageQuery="select path from image where imageId = $imageId";
  $imageResult=mysql_query($imageQuery) or die("Error in Query");
  $imageLocation=mysql_fetch_array($imageResult);
  echo"<li><img src={$imageLocation['path']}>";
  $title = trim($title);
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
  echo"<button type=\"button\" class=\"btn btn-default\"> <a href=\"weekEndGetaways.php?destinationId=1\">Explore</a>
   </button></li>";
  }

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
    echo  "<li><a href=\"index.php?page={$ppage}\">Previous</a></li>";
  }
  else
  {
    echo  "<li class=\"previous disabled\"><a href=\"index.php\">Previous</a></li>";
  }


  for($p=1;$p<=$totalpage;$p++)
  {
    if($p==$pageno)
      echo "<li class=\"active\"><a href=\"index.php?page={$p}\">{$p}</a></li>";
    else
      echo "<li><a href=\"index.php?page={$p}\">{$p}</a></li>";
  }


  if($pageno<$totalpage)
  {
    $ppage=$pageno+1;
    echo  "<li><a href=\"index.php?page={$ppage}\">Next</a></li>";
  }
  else
  {
    echo  "<li class=\"next disabled\"><a href=\"index.php?page={$pageno}\">Next</a></li>";
  }
  echo "</ul></div>";



}




?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php setMetadata();?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="temp/style.css" rel="stylesheet">
    <link href="temp/style2.css" rel="stylesheet" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="temp/w3.css" rel="stylesheet" >
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
            <div class="container">

                    <div class="row">
                      <div class="col-xs-12 col-md-9">
                        <br><br>
                        <h2 title="Weekend destination from kolkata"> Baranti  -  A small Hamlet in Purulia    </h2>
                      <a href="#">  <span class="label label-success">West Bengal</span></a><a href="#"><span class="label label-warning">India</span></a>
                      <br>
                      <div class="col-xs-12 col-md-12">
                      <br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        If you are looking for a place to just relax and refresh your mind far from the crowds then it’s the perfect place for you. Baranti is a small village surrounded with greenery, hills and a big natural lake.

                      </p><br>
                    </div>
                    <div class="col-xs-12 col-md-12">
                      <div class="col-xs-12 col-md-6">
                        <p class="picture">
                        <a href="images\Baranti\Baranti_Hill.jpg"><img src="images\Baranti\Baranti_Hill.jpg" alt=Baranti_Hill class="w3-hover-grayscale"></a></p>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <p class="picture">
                        <a href="images\Baranti\Baranti_Sunset1.jpg"><img src="images\Baranti\Baranti_Sunset1.jpg" alt=Baranti_Sunset class="w3-hover-grayscale"></a></p>
                      </div><br>
                      
					<div class="clearfix visible-md-block visible-lg-block"><br><br><br></div>
					<br>
                      <p>We boarded the Chakradharpur Passenger from Howrah on a Thursday night. Next morning around 5.30 am we reached Adra. Car was waiting for us at station and before 7.30 we reached Lake Hill Resort. Don’t go by the name, it’s nothing like a resort. There were only three rooms with basic facilities. No AC, no power backup but the view paid off everything.</p>

                      </div>
                        <div >
                        <div class="col-xs-12 col-md-6">
                          <br><br>
                          <p>
                            It was raining and the place was so peaceful that we could hear the sound of rain. Caretaker Birbal was very efficient and he soon served us with a delicious breakfast – luchi, aloor dom. We spent the day at leisure appreciating the beauty of the place. There was nothing nearby not a single shop, so it’s better to carry everything you need. We went for a walk in the afternoon, enjoyed the breathtaking sunset. But due to rain we had to get back soon. It was raining heavily and lightning almost struck the lake water. It was terrific! The food was tasty but you will get only Bengali food. Fooding charge is Rs.300 per day (Morning bed tea to dinner).

                        </div>
                        <div class="col-xs-12 col-md-6">
                        <p class="picture">
                              <br><br>
                        <a href="images\Baranti\Baranti_Sunset2.jpg"><img src="images\Baranti\Baranti_Sunset2.jpg" alt=Baranti_Sunset class="w3-hover-grayscale"></a></p>
                        </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                          <div class="col-xs-12 col-md-6">
                            <br><br><br><br>
                            <p class="picture">
                          <a href="images\Baranti\Baranti_View_from_room.jpg"><img src="images\Baranti\Baranti_View_from_room.jpg" alt=Baranti_View_from_room class="w3-hover-grayscale"></a></p>
                          </div>
                          <div class="col-xs-12 col-md-6">
                            <br>
                            One can hire a car and visit the nearby attractions like Biharinath, Garpanchkot, Maithon Dam, Ayodhya Pahar, Kashipur Rajbari, Joychondi Pahar. Though we preferred to sit and relax. You may consider us lazy but we just wanted an escape from our busy life. We walked along the red mud road with the lake at our side upto Baranti Hill, climbed a bit, clicked few pics and returned back.

                        It was our last day and our train was at 4.24 pm from Adra. We booked a car and went to Garpanchkot and Joychondi Pahar on our way back to Adra. The car took 1000 bucks. Garpanchkot was nice but you shouldn’t miss Joychondi Pahar. It offers a great view of the surroundings. We spent some time there. We headed back to Kolkata by Rupasibangla Express and our beautiful journey ended with a satisfactory smile.</p><br>
                          <br>
                        </div>
                        </div>



                      <div class="col-xs-12 col-md-12">
                        <p><h3>How to reach :</h3>
                      <!--  <ul ><li class="button"><h4>By Train : </h4></li></ul> -->


                        <ul><li><h4>By Train : </h4></li></ul>
                        <p class="path"> From Howrah go to Adra or Asansol. Take a local train to reach Muradi (Journey time approx.. 30 mins).
                          It’s on the Adra-Asansol line. From Muradi you can take trekker, riskshaw or a hired taxi to reach Baranti.You can also book direct car from Adra.

                        <ul><li><h4>By Car :</h4></li></ul>
                        <p class="path">Kolkata > Dankuni - NH 2 > Asansol - leave NH 2 and take the old GT Road through Asansol city, just before entering Asansol > Neamatpur – turn left > Disergarh Bridge across the Damodar River > Sarbori Morh on Barakarar Purulia Road> Subhas Morh – turn left > Kotaldih village > Ramchandrapur village >Muradi village> Baranti  (263 kms)

                        <ul><li><h4>One can also take :</h4></li></ul>
                        <p class="path">Raniganj Punjabi More > turn left > Before Raniguanj Station turn right > Mejia More > Cross Mejia Bridge > Turn right for Saltora > Just cross Santuri Police Station – turn right > Baranti (237 kms)</p>




                        <h4>Places to Stay:</h4>
                        <p>  Lake Hill Resort (Nearest to the Lake)
                          Contact Person: P. K. Ghosh , Mobile No: 9432296178 / 7059970618 ,   E-mail : <u>pulak@lakehillresort.in</u>, <u>pulak3398@gmail.com</u>, Room rent: Rs 800 per day
                          Akashmoni Resort (Just behind Lake Hill Resort)
                          Contact Person: Jolly Das in Salt Lake Kolkata , Mobile No: +91 8017215958 , Website:<a class="http_link" href="http://www.akaashmoni.in">www.akaashmoni.in</a>,Standard Cottages: Rs 850 per day , Deluxe Cottages: Rs 1200 per day
                          Ankhaibari Village Resort (Better option)
                          Mobile: +91-9051267310 /+91-9609811544 /+91-9800420013 , Website:<a class="http_link" href="http://barantiankhairesort.com" target="_blank">www.barantiankhairesort.com</a>
                          We were not aware of this place. It’s beside Lake Hill Resort. We peeked in and it looked good.
                          There are many other options available but these are closer to the lake.
                        </p>

                        <h4>When to Visit:</h4>
                        <p>You can visit it at any time of the year. During rainy season the lash green will soothe your eye. And I am sure it will look awesome in Autumn with the fiery red of Palash flowers.
                        Tips:
                        1.Carry Mosquito repellent cream and basic medicines.
                        2.If you want to have alcohol it’s better to carry your drinks.

                        </p>
                        <ul class="pager">
                          <?php showPrevBlog();?>
                          <?php showNextBlog(); ?>
                          </ul>
                          <div class="alert alert-info fade in"> <strong> Season Offer :</strong> Get 10% discount on Hotel booking
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-danger btn-md disabled"><span class="glyphicon glyphicon-earphone"></span> Book Hotel Now </button>
                          <button type="button" class="btn btn-primary" data-toggle="popover" data-placement="top"  data-content="9674287787"><span class="glyphicon glyphicon-earphone">Call</span></button>
                          <button type="button" class="btn btn-primary"  data-toggle="popover" data-placement="right"  data-content="info@banzaras.in"><span class="glyphicon glyphicon-envelope">Mail</span></button>

                          </div>

</div>
</div>





<div class="col-xs-12 col-md-3">
  <br>
  <h3> Author : <?php showAuthorName();?> </h3>
  <p><?php showAuthorBio()?></p>
  <div class="container-fluid">
    <ul class="social">
      <li> <a href=<?php showFbLink();?>> <i class=" fa fa-facebook">   </i> </a> </li>
      <li> <a href=<?php showTwitter();?>> <i class="fa fa-twitter">   </i> </a> </li>
      <li> <a href=<?php showInsta();?>> <i class="fa fa-instagram">   </i> </a> </li>
    </ul></div>
  </div>
<div class="clearfix visible-xs">&nbsp;<br></div>
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
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5954e95d0bda439b"></script> 
</body>
<div class="clearfix visible-md-block visible-lg-block"><br></div>
  <div class="footer" id="footer" style='height:12%;'>
    <div class="container-fluid">
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
