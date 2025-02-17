<?php
include ('connection.php');
$id = $_GET['id'];
$name = $_GET['name'];
$cat = $_GET['category'];
$result = mysqli_query($conn, "select * from book where bname = '$name'");
while($row = mysqli_fetch_assoc($result)){
    $category = $row['category'];
    $bdesc = $row['bdesc'];
    $author = $row['author'];
    $bid = $row['id'];
    $book = $row['book'];
    $quantity = $row['quantity'];

}
$result = mysqli_query($conn, "select * from volunteer where id = '$id'");
while($row = mysqli_fetch_assoc($result)){
$pass = $row['password'];
$phrase = $row['secret'];
$pname = $row['name'];
$phone = $row['phone'];
}
if(isset($_POST['borrow'])){
    $sunccessMessage = "";
    $cpass = $_POST['cpass'];
    $fquantity = $quantity - 1;
    $cid = $_POST['cid'];
    $pphone = $_POST['phone'];
    if($quantity > 0){
    if($cpass==$pass or $cpass == $phrase){
    $result = mysqli_query($conn, "update book set quantity = '$fquantity' where id = '$cid'");
    if($result){
        $result = mysqli_query($conn, "insert into borrow(name, bname, bid, phone) values('$pname', '$name', '$cid', '$pphone')");
        if($result){
            $successMessage = "Library has been updated you may collect the book from the library";
        }else{
            $errorMessage = "Invalid Query";
        }
    }else{
        $errorMessage = "Problem Updating Records";
    } 
}else{
    $errorMessage = "Incorrect Password";
}
}else{
    $errorMessage = "Book is not Available, Feel free to read it here";
}
}

if(isset($_POST['Read'])){
    $cpass = $_POST['cpass'];
    if($cpass == $pass or $cpass == $phrase){
        $sunccessMessage = $book;
        if(!empty($book)){
        $successMessage = "Your Book Should be displayed below, shortly";
    }else{
        $successMessage = "Apologies.... There are no records of the text of this book<br>Pls return at a later time";
    }
    }else{
        $errorMessage = "Incorrect Password";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
            <a class="btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
    </div>
    <div class = "col-sm-1">
    <form action="booka.php?id=<?php echo $id; ?>&name=<?php  echo $name; ?>&category=<?php echo $cat; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" >
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="cid" value="<?php echo $bid; ?>">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
    </div>
    </div>
    <br><br>
    <h1><?php echo $name; ?></h1>
    <h3><?php echo $bdesc; ?></h3>
    <div class="bg-info">
    <div class="row offset-1 container my-5" >
    <div class="col">
       <h1 class="offset-sm-2 col-sm-6 container my-5">Borrow / Read Book</h1>

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
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-pen-fancy col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               Author: <?php echo $author; ?>
              </div>
    </div>
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-pen-fancy col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               Category: <?php echo $category; ?>
              </div>
    </div>
    
    <div class="row mb-3 my-3">
         <i class="fa-solid fa-key col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="password" name="cpass" id="cpass" placeholder="Use password or secret phrase to verify identity" required>
              </div>
    </div>
         <div class="row mb-3">
            <div class="offset-sm-1 col-sm-3 d-grid">
             <input type="submit" name="borrow" value="Borrow" class="btn btn-outline-primary ">
            </div>
            <div class="col-sm-3 d-grid">
             <input type="submit" name="Read" value="Read Book Online " class="btn btn-outline-primary ">
            </div>
            <?php
       if (!empty($successMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$successMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
       }
       ?>
         </div>
        </form>
    </div>
    </div>
    </div>
        <?php
       if (!empty($sunccessMessage) ) {
        echo "
        <div class='alert offset-sm-2 col-sm-7 alert-warning alert-dismissible fade show' role='alert'>
        <div class ><strong <p  dir='rtl' lang='ar'>نعم$sunccessMessage</p></strong></div>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
       }
       ?>
</body>
</html>