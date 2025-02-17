<?php
include('connection.php');
$id = $_GET['id'];
$phone = $_GET['phone'];
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
            <div class= "col my-2"><a class=" btn btn-outline-success btn-success" href= "newc.php?id=<?php echo $id; ?>&phone=<?php echo $phone; ?>"><b style= "font-size:75%; color: black;">NEW CONTACT</b></a></div>
        </div>
</div>
        <p><b>CONTACTS</b><p>
<table style ="width:30%;">
<?php
$result = mysqli_query($conn, "select * from link where num1='$phone' or num2='$phone'");
while($row = mysqli_fetch_assoc($result)){
    ?>
    <?php
    if($row['num1']==$phone){ 
        $reciever = $row['num2'];
    }else{
        $reciever = $row['num1'];
    } 
    $message = $row['message'];
    $link = $row['id'];
    $status = $row['status'];
    $time = $row['time'];
        $resul = mysqli_query($conn, "select * from volunteer where phone = '$reciever'");
        while($row = mysqli_fetch_assoc($resul)){
            ?>
            <tr class= "btn btn-outline-dark col-sm-4 container my-1 offset-sm-1" style= "width:150%;">
            <td><div><a class="btn" href="contact.php?id=<?php echo $id; ?>&phone=<?php echo $phone ;?>&reciever=<?php echo $reciever;?>&linkid=<?php echo $link?>#bottom"><b style= "font-size:100%;color: black;"><?php echo $row['name']; ?><br></b><?php echo $message; ?></a></div></td>
            <td style = "float: right;"><!--<?php /*echo $status;*/?> Message--><br><?php echo $time; ?></td>
        </tr>    
    <?php
    }
}
?>
</table>
</body>
</html>