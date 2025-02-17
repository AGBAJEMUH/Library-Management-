<?php
include ('connection.php');
$id = $_GET['adminid'];
$name = $_GET['name'];
$cat = $_GET['category'];
$result = mysqli_query($conn, "select * from book where bname = '$name'");
while($row = mysqli_fetch_assoc($result)){
    $category = $row['category'];
    $bdesc = $row['bdesc'];
    $quantity = $row['quantity'];
    $author = $row['author'];
    $bid = $row['id'];
    $book = $row['book'];
}
if(isset($_POST['edit'])){
    $fname = mysqli_real_escape_string($conn, $_POST['bname']);
    $fdesc = mysqli_real_escape_string($conn, $_POST['bdesc']);
    $fcat = mysqli_real_escape_string($conn, $_POST['category']);
    $fauthor = mysqli_real_escape_string($conn, $_POST['author']);
    $fquantity = $_POST['quantity'];
    $cid = $_POST['cid'];
    $result = mysqli_query($conn, "select * from book where category = '$fcat'");
    $count_category = mysqli_num_rows($result);
    $resul = mysqli_query($conn, "select * from book where bname = '$fname'");
    $count_name = mysqli_num_rows($resul);
    if($count_category >0){
        if($count_name >0){
            if($fname == $name){
                $result = mysqli_query($conn, "update book set bdesc ='$fdesc', category ='$fcat', author ='$fauthor', quantity = '$fquantity' where id = '$cid'");
            if($result){
                header("location: categ.php?adminid=$id&name=$cat");
            }else{
                $errorMessage = "Invalid Query";
            }
            }else{
            $errorMessage = "Book Already Exists";
        }
        }else{
            $result = mysqli_query($conn, "update book set  bname ='$fname', bdesc ='$fdesc', category ='$fcat', author ='$fauthor', quantity = '$fquantity' where id = '$cid'");
            if($result){
                header("location: categ.php?adminid=$id&name=$cat");
            }else{
                $errorMessage = "Invalid Query";
            }
        }
    }else{
        $errorMessage = "Category does not Exist";
    }
}
if(isset($_POST['delete'])){
    $errorMessage = "Are you sure <br><form action='book.php?adminid=$id&name=$name&category=$cat' method='post'> <div class='col-sm-3 d-grid'>
    <input type='submit' name='sure' value='Yes'' class='btn btn-outline-primary'>
    <input type='hidden' name='cid' value='$bid''>
   </div>
</div>
</form>";
}
if(isset($_POST['sure'])){
    $cid = $_POST['cid'];
    $result = mysqli_query($conn, "delete from book where id  = $cid;");
    if($result){
        header("location: categ.php?adminid=$id&name=$cat");
    }
}
if(isset($_POST['submit'])){
    $cid = $_POST['cid'];
    $fbook  = mysqli_real_escape_string($conn, $_POST['book']);
    $result = mysqli_query($conn, "update book set  book ='$fbook' where id = '$cid'");
            if($result){
                header("location: categ.php?adminid=$id&name=$cat");
            }else{
                $errorMessage = "Invalid Query";
            }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
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
    <form action="book.php?adminid=<?php echo $id; ?>&name=<?php  echo $name; ?>&category=<?php echo $cat; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" >
        <input type="hidden" name="id" value="<?php echo $name; ?>">
        <input type="hidden" name="cid" value="<?php echo $bid; ?>">
    </div>
    </div>
    <br><br>
    <div class="bg-info">
    <div class="row offset-1 container my-5" >
    <div class="col">
       <h1 class="offset-sm-2 col-sm-6 container my-5">Edit / Delete Book</h1>

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
       <form method="post" >
         <div class="row mb-2 my-5">
         <i class="fa-solid fa-pen col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="bname" class="form-control" value="<?php echo $name; ?>" required placeholder="Book Name">
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-paperclip col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="bdesc" class="form-control" value="<?php echo $bdesc; ?>" required placeholder= "Description">
              </div>
    </div>
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-pen-fancy col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="author" class="form-control" value="<?php echo $author; ?>" required placeholder= "Author">
              </div>
    </div>
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-pen-fancy col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="category" class="form-control" value="<?php echo $category; ?>" required placeholder= "Category">
              </div>
    </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-info col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>" required placeholder= "Quantity of books available">
              </div>
    </div>
         <div class="row mb-3">
            <div class="offset-sm-1 col-sm-3 d-grid">
             <input type="submit" name="edit" value="Edit" class="btn btn-outline-primary ">
            </div>
            <div class="col-sm-3 d-grid">
             <input type="submit" name="delete" value="Delete Book " class="btn btn-outline-primary ">
            </div>
         </div>
        </form>
        <form action="book.php?adminid=<?php echo $id; ?>&name=<?php  echo $name; ?>&category=<?php echo $cat; ?>" method="post">
        <h1 class="offset-sm-2 col-sm-6 container my-5">Input Book Content</h1>
        <input type="hidden" name="cid" value="<?php echo $bid; ?>">
        <div class="row mb-2 my-5">
         <i class="fa-solid fa-pen col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="book" class="form-control form-control-lg" value="<?php echo $book; ?>" required placeholder="Paste Book Text">
              </div>
         </div>
        <div class="row mb-3">
            <div class="offset-sm-1 col-sm-3 d-grid">
             <input type="submit" name="submit" value="Submit" class="btn btn-outline-primary ">
            </div>
         </div>
        </form>
</body>
</html>