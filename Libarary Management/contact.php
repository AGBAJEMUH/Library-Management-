<?php
include('connection.php');
$id = $_GET['id'];
$phone = $_GET['phone'];
$phone2 = $_GET['reciever'];
$linkid = $_GET['linkid'];
$resu = mysqli_query($conn, "select * from link where id = '$linkid'");
while($row = mysqli_fetch_assoc($resu)){
    $res = $row['date'];
}
if(isset($_POST['submit'])){
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $result = mysqli_query($conn, "insert into message(linkid, senderno, recieverno, message) values('$linkid', '$phone', '$phone2', '$message')");
    $resul = mysqli_query($conn, "select * from message where linkid = '$linkid' and message = '$message'");
    while($row = mysqli_fetch_assoc($resul)){
        $time = $row['time'];
    }
    $res =  mysqli_query($conn, "update link set message = '$message', status = 'unread', time = '$time'  where id = '$linkid'");
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
<a class="btn btn-secondary offset-sm-1 my-5" href= "message.php?id=<?php echo $id; ?>&phone=<?php echo $phone; ?>"><b><i class="fa-solid fa-bookmark"></i></b><a>
<br><br>
<Center>On <b><?php echo $res; ?></b> <br>This Conversation Began</Center>
<div >
    <center><table class="col-sm-12 offset-sm-3" style="margin-bottom: 10%;">
        <br>
    <?php
    $count = 1;
    $result = mysqli_query($conn, "select * from message where linkid = '$linkid'");
    while($row = mysqli_fetch_assoc($result)){
        $senderno = $row['senderno'];
        $recieverno = $row['recieverno'];
        $messages = $row['message'];
        $time = $row['time'];
        
        if($senderno == $phone){
            $class = "btn btn-outline-dark btn-primary offset-sm-4 col-sm-3";
        }else{
            $class = "btn btn-outline-dark btn-success col-sm-3";
        }
        $resul = mysqli_query($conn, "select * from volunteer where phone = '$senderno'");
        while($row = mysqli_fetch_assoc($resul)){
    
            if($senderno == $phone){
                $name = "You";
            }else{
                $name = $row['name'];
            }
        ?>
        <tr>
        <td><div class="<?php echo $class; ?>"><b><?php echo $name;?> </b>.<br><?php echo $messages;?><br><?php echo $time; ?></div></td>
        </tr>
        <?php
        $count++;
        }
    }
    ?>
    </table></center>
    <p id="bottom"></p>
    <form class="fixed-bottom" action="contact.php?id=<?php echo $id; ?>&phone=<?php echo $phone ;?>&reciever=<?php echo $phone2;?>&linkid=<?php echo $linkid?>#bottom" method="post">
    <center><input  style="width: 70%; "type="text" name="message" id="message" ><input style="width: 10%;" class="btn btn-success"type="submit" Value = "send "name="submit"></center>
    </form>
    <?php
    ?>
    </div>
</body>
</html>
