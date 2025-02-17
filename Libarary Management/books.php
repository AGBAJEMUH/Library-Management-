<?php
include('connection.php');
$id = $_GET['adminid'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books...</title>
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
        <h2 class='col-sm-6'><u>List of Books in THE LIBRARY</u></h2>
        <h3 class='col-sm-6'>These are the list of books that have passed through the library and which its information is still stored in our database <br>Feel free to edit and delete books as your admin status indicates</h3>

    </div>
<form action="books.php?adminid=<?php echo $id;?>" method="post">
<input type="search" name="search" id="search" placeholder = "Search.. for books in the library" class="offset-sm-1">
<input type="submit" value="submit" name="ok" class="btn btn-success">
</form>
<?php
if(isset($_POST['ok'])){
    $search = $_POST['search'];
    $sql = "select * from book where bname like '%$search%'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
    $search = $_POST['search'];
    $sql = "select * from book where bname like '%$search%'";
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
    $errorMessag = "Book not Available in This Library";
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
    $sql = "select * from book where bname!='null'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class= "btn col-sm-2 container my-5 offset-sm-1 btn-outline-dark" ><img src="stylesheet/images/aut-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "book.php?adminid=<?php echo $id; ?>&name=<?php echo $row['bname'];?>&category=<?php echo $row['category']; ?>"><b style= "font-size:100%;color: black;"><?php echo $row['bname']?>(<?php echo $row['quantity'];?>)</b></a></div>
        <?php
    }
    ?>
         <div class= "col col-sm-4 offset-sm-8 container my-5 text-white"style='padding-bottom: 13%;'><h1>THE LIBRARY<br></h1>Alamin Library Provides A vast section of books, specializing in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br></div>
    </div>
        
</body>
</html>