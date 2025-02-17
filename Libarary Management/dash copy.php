<?php
include('connection.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
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
    <div class="row mb-1 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success btn-success" href= "dash.php?id=<?php echo $id; ?>"><b style= "font-size:75%; color: black;">HOME</b></a>
            </div>
            <div class = "col-sm-1">
    <form action="dash.php?id=<?php echo $id; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id">
        <input type="submit" value="User info" name="info" class="btn btn-info">
    </form>
    <?php
       if (!isset($_POST['submit']) ) {
        $id = $_GET['id'];
        $sql = "select * from volunteer where id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        $email = $row['email'];
        }
        echo "
        <div class='alert alert-primary alert-dismissible fade show' role='alert' style='width: 200%;'>
        <strong>Name: $name Id: $id <br><br><a href='new.php'>Logout</a></strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
       }else{

       }
       ?>
</div>
         </div>
</div>
    <div class= "row"style="float: left; margin-top: 2%;">
    <div class= "btn col-sm-2 container my-5 offset-sm-5 btn-outline-dark" ><img src="stylesheet/images/categ-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "category.php"><b style= "font-size:100%;color: black;">CATEGORIES</b></a></div>
    <div class= "btn col-sm-2 container my-5 offset-sm-2 btn-outline-dark" ><img src="stylesheet/images/aut-removebg-preview.png" style="width: 100%;"alt=""><br><a class="btn" href= "books.php"><b style= "font-size:100%;color: black;">BOOKS LIST</b></a></div>
    <div class= "btn col-sm-2 container my-5 offset-sm-7 btn-outline-dark" ><img src="stylesheet/images/at-removebg-preview.png" style="width: 100%;"alt=""><b><a class="btn" href= "author.php"><b style= "font-size:100%;color: black;">AUTHORS</b></a></div>
    </div>
    <br><br>
</body>
</html>