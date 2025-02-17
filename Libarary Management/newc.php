<?php
include('connection.php');
$id = $_GET['id'];
$phone = $_GET['phone'];

if(isset($_POST['submit'])){
    $num2 = $_POST['num2'];
    $result= mysqli_query($conn, "select * from volunteer where phone ='$num2'");
    $count = mysqli_num_rows($result);
    $result= mysqli_query($conn, "select * from link where num1 ='$phone' and num2 = '$num2'");
    $countm = mysqli_num_rows($result);
    $result= mysqli_query($conn, "select * from link where num2 ='$phone' and num1 = '$num2'");
    $county = mysqli_num_rows($result);
    if ($count == 1) {
        if ($countm ==0 and $county == 0) {
                $result = mysqli_query($conn, "INSERT INTO link(num1, num2) VALUES('$phone', '$num2')");
                if ($result) {
                    header("location: message.php?id=$id&phone=$phone");
                    exit;
                } else {
                    $errorMessage = "Error Linking Contact Info";
                }
        } else {
            if ($countm > 0) {
                $errorMessage = "You Have Created a link with this person";
            }
            if ($county > 0) {
                $errorMessage = "This Person Has Created A link with You";
            }
        }
        
    } else {
        $errorMessage = "No such Number exists on the Library Database";
    }
        
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATS</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row ">


    </div>
    <br>
    <div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-1 container my-5 offset-sm-1">
            <div class="row offset-sm-5 col-sm-1">
            <div class = "col"><a class=" btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a></div>
            <div class= "col my-2"><a class=" btn btn-outline-success btn-success" href= "message.php?id=<?php echo $id; ?>&phone=<?php echo $phone; ?>"><b style= "font-size:75%; color: black;">CHATS</b></a></div>
            </div>
<form action="newc.php?id=<?php echo $id; ?>&phone=<?php echo $phone; ?>" method="post">
<input type="number" name="num2" id="num2" placeholder="Enter Recipient Phone Number">
<input type="hidden" name="phone" value = "<?php echo $phone; ?>">
<input type="submit" value="MESSAGE" name="submit">
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
</form>
</body>
</html>