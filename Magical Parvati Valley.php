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
$invisible = '';
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

function setInvisible()
{
  global $invisible;
  echo"$invisible";
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
  global $blogId;
  $queryDestination="select placeName from detail where isActive=1 and isVisible=1 order by placeId desc";
  $allDetail= mysql_query($queryDestination) or die("Error in Query");
  $queryBlogs="select title,blogId from blog where isActive=1 and isVisible=1 order by blogId desc";
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
   if($result['blogId']==$blogId)
     echo"<option selected>$title</option>";
}
echo"</select>";
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

function setMetadata()
{
   $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $queryBlogs="select * from permalink where Url like '%{$url}%' ";
   $blog=mysql_query($queryBlogs) or die("Error in Query");
   $result=mysql_fetch_array($blog);
   global $blogId;
   global $invisible;
   $blogId=$result['BlogId'];
   $keyword=$result['Keyword'];
   $description=$result['Description'];
   $title=$result['Title'];
   $invisible = $result['Invisible'];
   echo"<meta name='keywords' content='$keyword'>";
   echo"<meta name='description' content='$description'>";
   echo"<title>$title</title>";
   setAuthorDetails();
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
                        <div class="clearfix visible-xs">&nbsp;<br><br></div>
                        <br><br>
                        <h2 title="Weekend destination from kolkata"> Mulkharka Lake Trek – Less explored part of North Bengal   </h2>
                      <a href="#">  <span class="label label-success">West Bengal</span></a><a href="#"><span class="label label-warning">India</span></a>
                      <br>>
                      <div class="col-xs-12 col-md-12">
                      <br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      A lot of photos and stories I have heard about Parvati Valley, but now it's the time to
                      explore! The day has finally came and we started our journey to Delhi as we have to catch our volvo bus to Bhuntar at 9 pm.</p><br>
                    </div>
                    <div class="col-xs-12 col-md-12">
                      <div class="col-xs-12 col-md-6">
                        <p class="picture">
                        <a href="images/Mulkharka/Lingsey.JPG"><img src="images/Mulkharka/Lingsey.JPG" alt="Lingsey" class="w3-hover-grayscale"></a></p>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <p class="picture">
                      <a href="images/Mulkharka/WaterFall.JPG"><img src="images/Mulkharka/WaterFall.JPG" alt="WaterFall.JPG" class="w3-hover-grayscale"></a></p>
                        <br>
                      </div>
                      <div>
                      </div>
                      <br><br><br>
                      <p>Day 1: Around 6 o'clock in the morning I opened my eyes and then without thinking
slightly folded the window curtain of our bus and oh yes! I finally got the glimpses ofbeautiful Himalayan range and my eyes were full of joy and heart got melted. The sun is
almost rising and the colour of the sky was just unexplainable. I got super-excited! We
had some breakfast on our way and due to
some problem in our bus we reached
Bhuntar at around 1 pm which scheduled at
10 am. Then we booked our cab to Choj, a
small village in the lap of mountains just
2kms away from Kasol. As in recent days
Kasol got a bit crowded, I chose to stay at
Choj as I wanted to stay away from crowds
and it was heaven. To reach at our homestay,
named Highland at choj, surrounded by apple
orchids and oak, pine rich Mountains, we had
to cross a foot hanging bridge over electrifying
Parvati River. The view was absolutely awesome! As we had a long journey we got
freshened and started chilling at the outside of our homestay. After having our food and
some rest, we decided to go out for an
adventure walk to Kasol market through pine
and oak forest and our journey was
remarkable. On our way we lost into trails of
that pine forest and finally from a local guy we
found out the right trail to Kasol market. In
between then we had some time spent just
beside of Parvati river, clicked some photos
and dps of my friends! We spent our evening
roaming through Kasol market and bought
few things and had some light snacks in
Rainbow cafe, whose ambience was awesome and food was great too. You can have
Choj valley with Parvati river
Highland, Choj
some imported beer over there if you want
to. But most important part of this day is
still pending. I know what you are thinking
what it could be! yes you may got right, its
bonfire time! Well, Roshan bhai, manager of
Highland, he is awesome helpful guy who
arranged chickens and bar-b-q setup for that
night and it was great memorable late
evening with bonfire, music and bar-b-q
chicken! It was getting late and we finally
</p>

                      </div>
                        <div >
                        <div class="col-xs-12 col-md-6">
                          <br>
                          <p>
                          When we woke up next morning it was still raining. And it looks like Mother Nature is taking bath. It was not possible for us to trek in rain so we had to change our plan. Lalit arranged a car for our next destination, Tagathang. The road was fully covered with mist. We were not able to see a single thing out of the car window. I absolutely have no idea how the guy was driving. It was half an hour journey. We stayed at Dilu Chettri’s Homestay and to me it was lot more than a luxurious hotel. The room was very sweet – wooden chairs, divan, a small bed, dressing table, white curtains and the view from the windows was mesmerizing. I was awestruck by the beauty of this place. Rain had almost stopped and we went out for a stroll. A guy from the homestay accompanied us. As we came by car we missed Dhoksing Waterfall, it was on the trek route. We asked Bhaiya if he could take us to the waterfall and he eagerly guided us. The path became dangerous as well as beautiful due to rain and it was literally breathtaking. We passed Jhusing village on the way. This area is the extended part of Neora Valley National Park. While climbing up I was losing my breath frequently. We stopped at a homestay in Jhusing for water and they treated us with tea. What a nice gesture! We came back to our homestay at around 4 pm and had our lunch. After almost 12 kms of trekking and a lip-smacking lunch, a rest was much needed but again I couldn’t keep myself inside the room. And we experienced probably the best sunset of our life. I have never seen so many colors in the sky before. We lost track of time and stood spellbound till the last sunshine faded away. As soon as it became dark, the room was flooded with moonlight. The moon seemed like a high power bulb. I spent hours sitting at the windows.
                        </div>
                        <div class="col-xs-12 col-md-6">
                        <p class="picture">
                              <br><br><br><br>
                        <a href="images/Mulkharka/Tagathang-Sunset-3.JPG"><img src="images/Mulkharka/Tagathang-Sunset-3.JPG" alt="Tagathang" class="w3-hover-grayscale"></a></p>
                        <br><br><br><br><br>
                        <a href="images/Mulkharka/Mulkharka-1.JPG.JPG"><img src="images/Mulkharka/Mulkharka-1.JPG" alt="Mulkharka" class="w3-hover-grayscale"></a></p>
                        </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                          <div class="col-xs-12 col-md-6">
                            <br><br><br><br><br>
                            <p class="picture">
                            <a href="images/Mulkharka/Mulkharka-3.JPG"><img src="images/Mulkharka/Mulkharka-3.JPG" alt="Mulkharka" class="w3-hover-grayscale"></a></p>
                          <br><br><br><br><br>
                        <a href="images/Mulkharka/Mulkharka-Lake.JPG"><img src="images/Mulkharka/Mulkharka-Lake.JPG" alt="Mulkharka-Lake" class="w3-hover-grayscale"></a></p>
                        </div><br>
                          <div class="col-xs-12 col-md-6">

                          Next morning we headed towards Mulkharka and our guide was Ashish. He is a student of class 8 with a sweet smile. It’s only 3 km and we reached our homestay before noon. The place offers a panoramic view of the whole surrounding. We went out to visit the Mulkharka Lake. It took approx. one hour to reach the lake. The lake was calm and there was an unusual silence around the place. There’s a small temple and if you look at the temple from the lake, Mt. Kanchenjungha appears behind it but it was not visible at all. We went back to our homestay. Don’t forget to try the local wine. It’s really good. Again we were gifted with a gorgeous sunset. The temperature dropped rapidly after sunset. We woke up early to see sunrise and I was freezing. I wrapped up myself in a fluffy jacket and started towards the Lake. It took us 45 mins to reach the place and that view was worth all the pain. There was mighty Kanchenjungha bathing with first rays of Sun. The whole valley was white. Dew drops got frozen and it was so unexpected that I couldn’t comprehend at first sight. We just wanted to stay there and look at Kanchenjhungha as long as we could. But we had to leave. We started downhill trek after breakfast and it was a different route. After few hours we reached Mankhim, a hilltop near the popular Aritar Lake. We stayed at Kanchenjungha Mirror Homestay. It’s declared as the best homestay of East Sikkim probably for the excellent view of Kanchenjungha. We spent the day at leisure relishing the beauty of surroundings. It’s a perfect place to unwind from your hectic life with awesome views of Mt. Kanchenjungha. I badly wanted to stay for a couple of more days but work-life was calling. We left for Kolkata next morning with loads of memories and a promise to come back soon.</p><br>
                          <br>
                        </div>
                        </div>



                      <div class="col-xs-12 col-md-12">
                        <p><h4>How to Reach Lingsey:</h4>
                      <!--  <ul ><li class="button"><h4>By Train : </h4></li></ul> -->



                        <p>Day 3: Next day early morning we woke up and
had our bath in the hot spring and visited the old
temple over there. Then we returned our
campsite repacked our bags and left the place
around 9 am. It
was our downhill
trek via Rudranag
and we were headed to Tosh, a beautiful small village
in Parvati Valley, famous for great view of snowcapped Mountains. We reached Barsheni at around 3
pm and headed to Tosh by cab but you can reach by
trekking of 3 kms. At around 4 pm we checked in our
home-stay, named hotel blue diamond. We were
tired but I rushed to the rooftop of our hotel and had
a cup of tea enjoying a magical view of Tosh as hotel
was at the top por tion of Tosh. We spent that
evening in our hotel cafe, enjoying musics,
Israeli foods! Oh yes, if you are in Tosh don't
forget to have some Israeli food. So, that's
how ended another day in Parvati valley at
Tosh village.
</p>
                        <p>Day 5 : Next morning we woke up
and it was beautiful, surrounded by
pine rich Mountains and in the
North side snow-capped Mountains
glowing in the sun. We had
morning tea and breakfast, then
our next plan to leave Parvati Valley
until next time. My mind was not
set up to leave but we had to. We
planned with sonu bhaiya to go to
Prashar Lake, a sacred lake in
Way to Magic Valley
Magic Valley
Way to Magic Valley
Mandi district and he arranged gypsies for us. So we trek down to Malana dam and
left Parvati Valley with some emotions and a lot of memories over there. So we
headed to Prashar lake and reached there at around 8 pm as we stuck into traffic
jams. We stayed at Forest guest house over there for that night.
<p>Day 6 : Next day was the last day in Himachal, as I heard Sunrise at Prashar lake
would be great to enjoy, so I woke
up early but unfortunately the
weather was not clear to visible
the sunrise. Then after having tea
and breakfast we started to roam
near Prashar Lake and clicked
some pictures. And finally after
having lunch we headed back to
Bhuntar to catch our bus to Delhi.
We had some last party in a cafe
beside Beas river near Bhuntar,
then we boarded our bus at around
8 pm. So it all ended here but
remained in our hearts forever with lots of memories and hope I will visit you, Parvati
Valley, soon again.</p>

</p><br>

                        <h4>Best time to Visit:</h4>
                        <p>Prashar Lake
Any time throughout the year. In Winter season Kheerganga trek may be closed for
deep snow. Best time to visit should be from April- June and September- November.

                        Staying:
Camping at Kheerganga- Now recently Govt. has banned camping and cafes at
Kheerganga due to pollution, so if you wish to camp at Kheerganga you have to carry
yourself or you can find some cafes or camps near Rudranag or contact Yadav bhai at
+91-8894460211.
Camping at Magic Valley, Malana- No need to prebook as you can get camps or cafes
over here if you are not in a big group. If you want to prebook then you can contact
Sonu Bhai at +91-8894407500.
</p>


                        <ul class="pager">
                          <?php showPrevBlog();?>
                          <?php showNextBlog(); ?>
                          </ul>
                          <div class="alert alert-info fade in"> <strong> Season Offer :</strong> Get 10% discount on Hotel booking
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-danger btn-md disabled"><span class="glyphicon glyphicon-earphone disabled"></span> Book Hotel Now </button>
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
<div class="invisible">
<?php setInvisible(); ?>
</div>

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
