<?php
include('connection.php');
$id = $_GET['adminid'];
if(isset($_POST['submit'])){
    $catname = $_POST['catname'];
    $catdesc = mysqli_real_escape_string($conn, $_POST['catdesc']);
    $result = mysqli_query($conn, "select * from category where catname = '$catname'");
    $count = mysqli_num_rows($result);
    if($count == 0){
    $y =  strlen($catdesc);
    if($y > 40){
    $result = mysqli_query($conn, "INSERT INTO category(catname, catdesc) VALUES('$catname', '$catdesc')");

    if($result){
        $result = mysqli_query($conn, "insert into book(id, bname, bdesc, category, author, quantity) values('', 'null', 'null', '$catname', 'null', '0')");
        if($result){
            $successMessage = "CATEGORY ADDED SUCCESSFULLY";
        }else{
            $errorMessage = "CATEGORY ADDED SUCCESSFULLY YET INCOMPLETELY";
        }
    }else{
        $errorMessage = "Problem Updating category";
    }
}else{
    $errorMessage = "Description isnt descriptive enough Minimum of 40 characters is required";
}
}else{
    $errorMessage = "Category Already Exists";
}
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORIES</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <br>
    <div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-1 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success btn-success" href= "dasha.php?adminid=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
    </div>
    <div class = "col-sm-1">
    <form action="category.php?adminid=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id">
    </form>
    </div>
<form action="category.php?adminid=<?php echo $id;?>" method="post" class = "col">
<input type="search" name="search" id="search" placeholder = "Search Book categories" class="col offset-sm-1">
<input type="submit" value="submit" name="ok" class="col btn btn-success">
</form>
</div>
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
<div class= "btn col-sm-2 container my-5 offset-sm-1" ><img src="stylesheet/images/icon2-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "categ.php?adminid=<?php echo $id; ?>&name=<?php echo $row['catname'];?>"><b style= "font-size:100%;color: black;"><?php echo $row['catname']?></b></a></div>
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
   <div class= "row">
<?php
    $sql = "select * from category";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class= "col btn col-sm-2 container my-5  btn-outline-dark" ><img src="stylesheet/images/icon2-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "categ.php?adminid=<?php echo $id; ?>&name=<?php echo $row['catname'];?>"><b style= "font-size:100%;color: black;"><?php echo $row['catname']?></b></a></div>
        <?php
    }
    ?>
    </div>
    <div class="bg-primary">
    <div class="row offset-1 container my-5" >
    <div class="col">
       <h1 class="offset-sm-2 col-sm-6 container my-5">Add New Category</h1>

       <?php
       if (!empty($errorMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
       }
       ?>
       <form method="post">
         <div class="row mb-2 my-5">
         <i class="fa-solid fa-pen col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="catname" class="form-control" value="" required placeholder="category Name">
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-paperclip col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="catdesc" class="form-control" value="" required placeholder= "Description">
              </div>
    </div>

         <?php

         if ( !empty($successMessage) ) {
            echo " 
            </div>
            <div class='row mb-3'>
                <div class= ' col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
            </div>
            ";
         }
         ?>
         </div>
         <div class="row mb-3">
            <div class="offset-sm-1 col-sm-3 d-grid">
             <input type="submit" name="submit" value="ADD CATEGORY" class="btn btn-outline-dark btn-info">
            </div>
         </div>
         <div class= "col col-sm-4 offset-sm-8 container my-5 text-white"style='padding-bottom: 13%;'><h1>THE LIBRARY<br></h1>Alamin Library Provides A vast section of books, specializing in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br></div>
         
    </div>
</body>
</html>