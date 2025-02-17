<?php
include('connection.php');
$id = $_GET['id'];
$name = $_GET['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books to be returned</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
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
        <a style= "float: left; margin-top:0.3%; width:  10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
        </div>
        <br><br><br><br>
        <div class2="row mb-1 container my-5 offset-sm-6">
                <div class="offset-sm-8 col-sm-1">
                <a class="btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
        </div>-->
        <br><br><br><br><br>
    <div class= "container my-6 ">
      <h2>Books Yet to be Returned</h2>
      <br>
      <table class="table">
        <thead>
            <tr>
          <th>S/N</th>
          <th>BOOK</th>
          <th>BOOK ID</th>
          <th>DATE BORROWED</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $id = $_GET['id'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "al-amin";

            $connection = new mysqli ($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die ("Connection Failed: " . $connection->connect_error);
            }else{
            }

            $sql = "select * from borrow where name = '$name'";
            $result = mysqli_query($connection, $sql);
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form action="bbooks.php?admnid=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value=""<?php echo $id;?>>
        </form>
                <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $row['bname']?></td>
                <td><?php echo $row['bid']?></td>
                <td><?php echo $row['date']?></td>
            </tr>
            <?php
            $count++;
            }

            ?>
            
        </tbody>
      </table>
    </div>
</body>
</html>