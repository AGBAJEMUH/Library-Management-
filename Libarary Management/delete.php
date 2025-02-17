<?php
include ('connection.php');
$adid = $_GET['adminid'];
$bid  =$_GET['bid'];
$result = mysqli_query ($conn , "select * from borrow where id = '$bid'");
while($row = mysqli_fetch_assoc($result)){
    $name = $row['name'];
    $bname = $row['bname'];
    $date = $row['date'];
    $phone = $row['phone'];
}
$result = mysqli_query($conn, "select * from book where bname = '$bname'");
while($row = mysqli_fetch_assoc($result)){
    $qua = $row['quantity'];
}
if(isset($_POST['delete'])){
    $quan = $qua + 1;
    $result = mysqli_query($conn, "update book set quantity = '$quan' where bname = '$bname'");
    if($result){
    $result = mysqli_query($conn, "delete from borrow where id = '$bid'");
    if($result){
        header("location: bbooks.php?adminid=$adid");
    }
}else{
    echo "error";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPOINTMENT</title>
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
            <a class="btn btn-outline-success btn-success" href= "dasha.php?adminid=<?php echo $adid; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
    </div>
    </div>
    <br><br>
    <div class = "container offset-sm-1 bg-secondary col-sm-7">
        <div class = "col-sm-6 offset-sm-1 ">
        <br>
        <div class= "row my-2"><h4>Borrow-<?php echo $bid; ?></h4></div>
        <br><br>
        <u>On <?php echo $date; ?></u>
        <br><br>
        <b ><?php echo $name; ?>,<b id="phone">(<?php echo $phone?>)</b> Borrowed <?php echo $bname;?> from The Library Via The Library Management System.</b>
        <br><br><br>
        <p>The Book Borrowed Has Been Returned, If so.....</p>
        <form action="" method="post">
        <div><input type="submit" name="delete" value="DELETE" class ="btn btn-danger"></div>
        </form>
        <br>Else;<br>
        <p>You may Use The <a href="#phone" onclick="<?php echo $phone; ?>">contact Information</a> above to remind him/her of their obligation</p>
        </div>
        <br><br>
    </div>
</body>
</html>