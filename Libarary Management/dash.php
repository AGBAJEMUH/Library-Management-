<?php
include('connection.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg  bg-secondary fixed-top data-bs-theme='dark' ">
  <div class="container-fluid">
  <i class="fa-solid fa-bookmark fa-2x col-sm-1 "></i>
    <a class="navbar-brand col-sm-5 text-white "><h2>AL-AMEEN Library</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
    </button>
    <div class="collapse navbar-collapse" id="">
      <ul class="nav nav-underline offset-sm-3" >
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="dash.php?id=<?php echo $id; ?>">Home</a>
        </li>
        <div class = "col-sm-1">
    <form action="dash.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id">
    </form>
    <?php
       if (!isset($_POST['submit']) ) {
        $id = $_GET['id'];
        $sql = "select * from volunteer where id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        $email = $row['email'];
        $number = $row['phone'];
        }
    }
        
       ?>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active text-white"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
            INFO
          </a>
          <ul class="dropdown-menu bg-secondary">
            <li><a class="dropdown-item" >Contact : <?php echo $number; ?></a></li>
            <li><a class="dropdown-item" >Email: <?php echo $email; ?></a></li>
            <li><a class="dropdown-item" ></a> Name: <?php echo $name; ?></li>
            <li><a class="dropdown-item" > Status: User</a></li>
            <li><a class="dropdown-item" > Id: <?php echo $id; ?></a></li>
            <li><a class="dropdown-item" ><a href='new.php'>Logout</a></a></li>
            <li><a class="dropdown-item" ><a href ='upa.php?id=<?php echo $id; ?>'>Update User details</a></a></li>

      </ul>
    </div>
  </div>
</nav>
    <div class="row ">


    </div>
    <br>
    <!--<div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-1 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
            </div>-->
            
  <!--<a class="nav-link dropdown-toggle active"  data-bs-toggle="dropdown" role="button" aria-expanded="true">
    User info
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" >Contact : <?php echo $number; ?></a></li>
    <li><a class="dropdown-item" >Email: <?php echo $email; ?></a></li>
    <li><a class="dropdown-item" > Name: <?php echo $name; ?></a></li>
    <li><a class="dropdown-item" > Status: User</a></li>
    <li><a class="dropdown-item" > Id: <?php echo $id; ?></a></li>
    <li><a class="dropdown-item" ><a href='new.php'>Logout</a></a></li>
    <li><a class="dropdown-item" ><a href ='upa.php?id=<?php echo $id; ?>'>Update User details</a></a></li>
</ul> 
</div>
         </div>
</div>-->

<div class= "row"style="float: left; margin-top: 2%;">
    <div class= "col-sm-3 container my-5" ><img src="stylesheet/images/new4.jfif" style="width: 100%; height:70%;"alt=""></div>
    <div class= "col-sm-4 offset-sm-1 container my-5 bg-white text-dark "style='padding-bottom: 13%;'><h1>THE LIBRARY<br><br></h1>Alamin Library Provides a vast section <br><br> of books, specializing  in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br><br> The books are well versed and are not pirated copies , in which are common in this time and age. <br><br> The library user form is very helpful for any user in use . It provides all the thongs needed for a reader to excel at reading and understanding of the books</div>
    <div class= "col-sm-3 container my-5" ><img src="stylesheet/images/ne.jpg" style="width: 100%;"alt=""></div>
    </div>
    
    <div class= "row"style="float: left; margin-top: 2%;">    
    <a class= "btn col-sm-2 container my-5 offset-sm-1 btn-outline-success" href= "categorya.php?id=<?php echo $id; ?>"><img src="stylesheet/images/cate-removebg-preview.png" style="width: 100%;"alt=""><b><b style= "font-size:100%;color: black;">CATEGORIES</b></b></a>
    <a class= "btn col-sm-2 container my-5 offset-sm- btn-outline-success" href= "booksa.php?id=<?php echo $id; ?>"><img src="stylesheet/images/li-removebg-preview.png" style="width: 100%;"alt=""><b><b style= "font-size:100%;color: black;">BOOKS LIST</b></b></a>
    <a class= "btn col-sm-2 container my-5 offset-sm- btn-outline-success" href= "lbooks.php?id=<?php echo $id; ?>"><img src="stylesheet/images/icon-removebg-preview.png" style="width: 100%;"alt=""><br><br><br><br><b><b style= "font-size:100%;color: black;"><br>AVAILABLE BOOKS</b></b></a>
    <a class= "btn col-sm-2 container my-5 offset-sm- btn-outline-success" href= "bat.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>"><img src="stylesheet/images/new-removebg-preview.png" style="width: 100%;"alt=""><b><b style= "font-size:100%;color: black;"><br>BOOKS AT HANDS</b></b></a>
    <a class= "btn col-sm-2 container my-5 offset-sm- btn-outline-success" href= "message.php?id=<?php echo $id; ?>&phone=<?php echo $number; ?>" ><img src="stylesheet/images/icon-removebg-preview.png" style="width: 100%;"alt=""><br><br><br><br><b><b style= "font-size:100%;color: black;"><br>MESSAGES</b></b></a>
  </div>
  <div class= "offset-sm-1 container my-5 bg-white text-dark "style='padding-bottom: ;'><h1>SOME OF OUR BEST PICKS</div>

    <div class= "row"style="float: left; margin-top: 2%;">
    <div class= "col-sm-4 offset-sm-1 container my-5 bg-white text-dark "style='padding-bottom: 13%;'><h1>Percy Jackson And the Olympians Series<br><br></h1> One of the first few Books to be Completely Instaled in the library<br><br>It Tells the story of a how a young boy Unknown to his origins discovers the Hidden world beyond His own and is forced to not only to accept the existence of the Patrons but that he is a demigod born of the Patron of the sea.<br><br>Throughest the series He completes Five quests to stop or end the return of Kronos The Titan lord and father of the patrons<br><br>The Book Is one of the most widely read Books in the world</div>
    <div class= "col-sm-3 container my-5" ><img src="stylesheet/images/ne.jpg" style="width: 100%;"alt=""></div>
    </div>
    <nav class ="fixed-bottom">
    <div class="text-align bg-dark" >
      <ul class="nav">
        <li class="col nav-item">
          <a class="btn" href= ""><b style= "font-size:105%; color: black;"></i>FACEBOOK:Al-AMEEN Centre </b></a>
        </li>
        <br><br>
        <li class="col nav-item"> 
          <a class="btn" href= ""><b style= "font-size:105%;color: black;">INSTAGRAM:@Alamin_centre</b></a>
        </li>  
        <li class="col nav-item">
          <a class="btn" href= ""><b style= "font-size:105%; color: black;">WHATSAPP: 09017121642</b></a>
        </li>
      </ul>
    </div>
    </nav>
    <br><br>
</body>
</html>