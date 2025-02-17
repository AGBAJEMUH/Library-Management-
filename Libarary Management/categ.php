<?php
include('connection.php');
$id = $_GET['adminid'];
$name = $_GET['name'];
$result = mysqli_query($conn , "select * from category where catname = '$name'");
while($row = mysqli_fetch_assoc($result)){
    $catdes = $row['catdesc'];
}

if(isset($_POST['submit'])){
    include ('connection.php');
    $bname = $_POST['bname'];
    $bdesc = mysqli_real_escape_string($conn, $_POST['bdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['catnam']);
    $quantity = $_POST['quantity'];
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $result = mysqli_query ($conn, "select * from book where bname = '$bname'");
    $count = mysqli_num_rows($result); 
    if($count == 0){
    $y =  strlen($bdesc);
        if($y > 35){
            $sql = "insert into book (bname, bdesc, category, author, quantity) values( '$bname', '$bdesc', '$category', '$author', '$quantity')";
            $resulter = mysqli_query ($conn, $sql);
                if($resulter){
                    $successMessage = "SUCCESS";
                }else{
                    $errorMessage = "Problem Adding Book, if this persists Book namemust contain only letters";
                }
        }else{
            $errorMessage = "Description isnt descriptive enough Minimum of 35 characters is required";
        }
    }else{
        $errorMessage = "Book Already Exists";
    }
}
if(isset($_POST['delete'])){
    $errorMessage = "Are you sure <br><form action='categ.php?adminid=$id&name=$name' method='post'> <div class='col-sm-3 d-grid'>
    <input type='submit' name='sure' value='Yes' class='btn btn-outline-primary'>
    <input type='hidden' name='catnam' value='$name'>
   </div>
</div>
</form>";
}
if(isset($_POST['sure'])){
    $category = $_POST['catnam'];
    $result_one = mysqli_query($conn, "delete from book where category = '$category'");
    if($result_one){
        $result_two = mysqli_query($conn, "delete from category where catname = '$category'");        
        if($result_two){
            header("location: category.php?adminid=$id");
        }else{
            $errorMessage = "problem deleting category";
        }
    }else{
        $errorMessage = "Problem deleting books in category hence delete action failed";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> Books</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <br>
    <div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width:  10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <br><br><br><br>
    <div class2="row mb-1 container my-5 offset-sm-6">
            <div class="offset-sm-8 col-sm-1">
            <a class="btn btn-outline-success btn-success" href= "dasha.php?adminid=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
    </div>
    </div>
    <br><br>
    <div class="container my-5">
    <?php
    echo "<h2 class='col-sm-6'><u>$name</u></h2>";
    echo "<h3 class='col-sm-6'>$catdes</h3>";
    ?>
    </div>
<form action="categ.php?adminid=<?php echo $id;?>&name=<?php echo $name;?>" method="post">
<input type="search" name="search" id="search" placeholder = "Search.. in <?php echo $name; ?> Books" class="offset-sm-1">
<input type="submit" value="submit" name="ok" class="btn btn-success">
</form>
<?php
if(isset($_POST['ok'])){
    $search = $_POST['search'];
    $sql = "select * from book where bname like '%$search%' and category = '$name' and bname != 'null'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
    $search = $_POST['search'];
    $sql = "select * from book where bname like '%$search%' and category = '$name' and bname != 'null'";
    $result = mysqli_query($conn, $sql);
    echo "<div class = 'row col-sm-7 offset-sm-1'  style='box-shadow: 2px 2px 2px 2px silver; border-radius: 10px;'>";
    while ($row = mysqli_fetch_assoc($result)){
?>
<div><a class="btn" href= "book.php?adminid=<?php echo $id; ?>&name=<?php echo $row['bname'];?>&category=<?php echo $row['category']; ?>">
<div class= "btn col-sm-2 container my-5 offset-sm-1" ><img src="stylesheet/images/book1-removebg-preview.png" style="width: 100%;"alt=""></div>
<b><b style= "font-size:100%;color: black;"><?php echo $row['bname']?>(<?php echo $row['quantity'];?>)</b></b>
</a>
</div>
<?php
    } 
}else{
    $errorMessag = "Book not Available in This Category";
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
    $sql = "select * from book where category = '$name' and bname!='null'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class= "btn col-sm-2 container my-5 offset-sm-1 btn-outline-dark" ><img src="stylesheet/images/aut-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "book.php?adminid=<?php echo $id; ?>&name=<?php echo $row['bname'];?>&category=<?php echo $name; ?>"><b style= "font-size:100%;color: black;"><?php echo $row['bname']?>(<?php echo $row['quantity'];?>)</b></a></div>
        <?php
    }
    ?>
    
    <div class="bg-info">
    <div class="row offset-1 container my-5" >
    <div class="col">
       <h1 class="offset-sm-2 col-sm-6 container my-5">Add New Book</h1>

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
               <input type="text" name="bname" class="form-control" value="" required placeholder="Book Name">
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-paperclip col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="bdesc" class="form-control" value="" required placeholder= "Description">
              </div>
    </div>
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-pen-fancy col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="author" class="form-control" value="" required placeholder= "Author">
              </div>
    </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-info col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="number" name="quantity" class="form-control" value="" required placeholder= "Quantity of books available">
              </div>
    </div>
<input type="hidden" name="catnam" value=<?php echo $name; ?>>
<input type="hidden" name="catnam" value=<?php echo $name; ?>>
         <?php

         if ( !empty($successMessage) ) {
            echo " 
            </div>
            <div class='row mb-3'>
                <div class= 'offset-sm-3 col-sm-6'>
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
            <div class="offset-sm-1 col-sm-6 d-grid text-white">
             <input type="submit" name="submit" value="ADD BOOK" class="btn btn-outline-dark btn-primary">
            </div>
         </div>
         </form> 
    <form action="categ.php?adminid=<?php echo $id;?>&name=<?php echo $name;?>" method="post">
         <div class="offset-sm-1 col-sm-6 d-grid ">
             <input type="submit" name="delete" value="Delete Category " class="btn btn-outline-primary btn-danger ">
            </div>
         </div>
        </form>
         <div class= "col col-sm-4 offset-sm-8 container my-5 text-white"style='padding-bottom: 13%;'><h1>THE LIBRARY<br></h1>Alamin Library Provides A vast section of books, specializing in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br></div>
    </div>
        
</body>
</html>