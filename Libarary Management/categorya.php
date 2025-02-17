<?php
include('connection.php');
$id = $_GET['id'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORIES</title>
    <link rel="stylesheet" href="stylesheet/style.css">
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body >
<nav class="navbar navbar-expand-lg  bg-secondary fixed-top data-bs-theme='dark' ">
  <div class="container-fluid">
  <i class="fa-solid fa-bookmark fa-2x col-sm-1 "></i>
    <a class="navbar-brand col-sm-5 text-white "><h2>AL-AMEEN Library</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
    </button>
    <div class="collapse navbar-collapse" id="">
      <ul class="nav nav-underline offset-sm-5" >
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="dash.php?id=<?php echo $id; ?>">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!--<br>
    <div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-1 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
    </div>
    <div class = "col-sm-1">
    <form action="categorya.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id">
    </form>
    </div>
    </div>-->
    <br><br><br><br>
    <form action="categorya.php?id=<?php echo $id;?>" method="post" class = "col">
    <!--<div class="col-sm-6 col-form-label-lg  form-floating ">
    <input type="search" name="search" id="search"  class="col offset-sm-4">
    <label for="floatingInput">Search</label>
    <input type="submit" value="submit" name="ok" class="col btn btn-light">-->
    <div class=" row col-sm-10  offset-sm-1">
              <div class="col-sm-3 mb-3 col-form-label  form-floating ">
               <input type="search" name="search" id="search" class="form-control" >
               <label for="floatingInput">Search</label>
               </div>
              <div clas="row col-sm-12">
              <input type="submit" value="submit" name="ok" class="col btn btn-light">
              </div>
              
         </div>
</form>
<?php
if(isset($_POST['ok'])){
    $search = $_POST['search'];
    $sql = "select * from category where catname like '%$search%'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
    $search = $_POST['search'];
    $sql = "select * from category where catname like '%$search%'";
    $result = mysqli_query($conn, $sql);
    echo "<div class = 'row col-sm-7 offset-sm-1'  style='box-shadow: 2px 2px 2px 2px silver; border-radius: 10px;'>";
    while ($row = mysqli_fetch_assoc($result)){
?>
<div class= "btn col-sm-2 container my-5 offset-sm-1 " ><img src="stylesheet/images/icon2-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "catega.php?id=<?php echo $id; ?>&name=<?php echo $row['catname'];?>"><b style= "font-size:100%;color: black;"><?php echo $row['catname']?></b></a></div>
<div class= "col-sm-6 my-5 "><b><?php echo $row['catdesc']; ?></b></div>
<?php
    } 
}else{
    $errorMessag = "There is no such Category, yet..";
}
}
?>

</div>

<?php
       if (!empty($errorMessag) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessag</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
       }
   ?>

    <?php
    $sql = "select * from category";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class= "btn col-sm-2 container my-5 offset-sm-1 btn-outline-dark" ><img src="stylesheet/images/icon2-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "catega.php?id=<?php echo $id; ?>&name=<?php echo $row['catname'];?>"><b style= "font-size:100%;color: black;"><?php echo $row['catname']?></b></a></div>
        <?php
    }
    ?>
         <div class= "col col-sm-4 offset-sm-8 container my-5 text-white"style='padding-bottom: 13%;'><h1>THE LIBRARY<br></h1>Alamin Library Provides A vast section of books, specializing in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br></div>
         
    </div>
</body>
</html>