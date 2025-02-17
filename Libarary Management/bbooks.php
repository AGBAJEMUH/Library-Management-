<?php
include('connection.php');
$id = $_GET['adminid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Books</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
<form action="bbooks.php?adminid=<?php echo $id;?>" method="post">
<input type="search" name="search" id="search" placeholder = "Search.. Records of borrow"class="offset-sm-1">
<input type="submit" value="submit" name="ok" class="btn btn-success">
</form>
<?php
if(isset($_POST['ok'])){
    $search = $_POST['search'];
    $sql = "SELECT * from borrow where CONCAT(id,bname,name,bid,phone,date) like '%$search%'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
    $search = $_POST['search'];
    $sql = "SELECT * from borrow where CONCAT(id,name,bname,bid,phone,date) like '%$search%'";
    $result = mysqli_query($conn, $sql);
    echo "<div class = 'row col-sm-7 offset-sm-1'  style='box-shadow: 2px 2px 2px 2px silver; border-radius: 10px;'>";
    echo"<table class='tale'>
        <thead>
            <tr>
          <th>Id</th>
          <th>Name</th>
          <th>BOOK</th>
          <th>BOOK ID</th>
          <th>DATE BORROWED</th>
            </tr>
        </thead>
        <tbody>
        
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>";
    while ($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><a class="btn" href="bbooks.php?adminid=<?php echo $id?>#<?php echo $row['id']?>"><?php echo $row['id']?></a></td>
    <td><a class="btn" href="bbooks.php?adminid=<?php echo $id?>#<?php echo $row['id']?>"><?php echo $row['name']?></a></td>
    <td><a class="btn" href="bbooks.php?adminid=<?php echo $id?>#<?php echo $row['id']?>"><?php echo $row['bname']?></a></td>
    <td><a class="btn" href="bbooks.php?adminid=<?php echo $id?>#<?php echo $row['id']?>"><?php echo $row['bid']?></a></td>
    <td><a class="btn" href="bbooks.php?adminid=<?php echo $id?>#<?php echo $row['id']?>"><?php echo $row['date']?></a></td>
<a>
</tr>
<?php
    } 
    echo "</tbody>
    </table>
    </div>";
}else{
    $errorMessag = "There is no such Borrow in record";
}
}
?>
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
    <div class= "container my-6 ">
      <h2>List of Books Borrowed</h2>
      <br>
      <table class="table">
        <thead>
            <tr>
          <th>Id</th>
          <th>Name</th>
          <th>BOOK</th>
          <th>BOOK ID</th>
          <th>DATE BORROWED</th>
          <th>Additions</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $id = $_GET['adminid'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "al-amin";

            $connection = new mysqli ($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die ("Connection Failed: " . $connection->connect_error);
            }else{
            }

            $sql = "select * from borrow";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form action="bbooks.php?admnid=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value=""<?php echo $id;?>>
        </form>
                <tr>
                <td id='<?php echo $row['id']?>'><?php echo $row['id']?></td>
                <td id='<?php echo $row['id']?>'><?php echo $row['name']?></td>
                <td id='<?php echo $row['id']?>'><?php echo $row['bname']?></td>
                <td id='<?php echo $row['id']?>'><?php echo $row['bid']?></td>
                <td id='<?php echo $row['id']?>'><?php echo $row['date']?></td>
                <td><div class="btn btn-success"><a href="delete.php?adminid=<?php echo $id; ?>&bid=<?php echo $row['id'];?>">COMPLETE</a></div></td>
            </tr>
            <?php
               
            }

            ?>
            
        </tbody>
      </table>
    </div>
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
</body>
</html>