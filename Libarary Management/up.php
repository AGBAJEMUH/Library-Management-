<?php
include ('connection.php');
$id = $_GET['id'];
$sql = "select * from admin where id = '$id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
$n = $row['name'];
$e = $row['email'];
$nu = $row['phone'];
}

if (isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["phone"];
    $id = $_POST['id'];


do {
    if ( empty($name)  and  empty($email)  and   empty($number) ) {
        echo"
        <script>
        window.location.href = 'up.php?id=$id';
        alert('All fields are required');
        </script>";
        break;
    }else{

    // add new client to the database
    $sql= "UPDATE `admin` SET  `name` ='$name', `email` ='$email', `phone` ='$number' WHERE id = '$id'" ;
    $result = mysqli_query($conn, $sql);
    

    if ($result) {
        header("location: dasha.php?adminid=$id");
        exit;
    }else{
    }
    
}

    } while (false);
} 

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
       <h2>Edit Volunteer</h2>
       <form method="post" action= "up.php?id=<?php echo $id ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
         <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-6">
               <input type="text" name="name" class="form-control" value="<?php echo $n; ?>" required>
              </div>
         </div>
         <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-6">
               <input type="email" name="email" class="form-control" value="<?php echo $e; ?>" required>
              </div>
         </div>
         <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Number</label>
              <div class="col-sm-6">
               <input type="tel" name="phone" class="form-control" value="<?php echo $nu; ?>" required>
              </div>
         </div>
         <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
             <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" role="button" href="dasha.php?adminid=<?php echo $id; ?>">Cancel</a>
            </div>
         </div>
       </form>
</body>
</html>