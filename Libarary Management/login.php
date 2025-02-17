<?php
   include('connection.php');
    if(isset($_POST["submit"])){
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $sql = "select * from volunteer where email= '$email'";
        $result = mysqli_query($conn, $sql);
        $count_email= mysqli_num_rows($result);
        $result = mysqli_query($conn, "select * from volunteer where email = '$email'");
        while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $cpass = $row['password'];
    }
        if($count_email>0){
            
            if($password==$cpass){
                echo "<script>
                            window.location.href='login.php';
                            alert('Welcome');
                            </script>";
                    header("location: dash.php?id=$id");
                    exit;
                }else{
                    $errorMessage = "Incorrrect Password";
                    }
                }else{
                    $errorMessage = "You are not Registered In our Database";
                }

        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<br>
    <!--<div style='float:left; margin-left: 10%; width: 100%;'>
    <div>
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-1 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success" href= "new.php"><b style= "font-size:75%; color: black;">HOME</b></a>
            </div>
            <div class="col-sm-1 ">
            <a class="btn btn-outline-primary btn-primary" href= "login.php"><b style= "font-size:75%;color: black;">LOGIN</b></a>
            </div>
            <div class="col-sm-1">
            <a class="btn btn-outline-danger" href= "sign.php"><b style= "font-size:75%; color: black;">SIGNUP</b></a>    
            </div>
            <div class="col">
            <a class="btn btn-outline-secondary" href= "logon.php"><b style= "font-size:75%; color: black;">ADMIN LOGIN</b></a>
            </div>
         </div>
</div>-->
<nav class="navbar navbar-expand-lg  bg-secondary fixed-top data-bs-theme='dark' ">
  <div class="container-fluid">
  <i class="fa-solid fa-bookmark fa-2x col-sm-1 "></i>
    <a class="navbar-brand col-sm-5 text-white "><h2>AL-AMEEN Library</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
    </button>
    <div class="collapse navbar-collapse" id="">
      <ul class="nav nav-underline offset-sm-3" >
        <li class="nav-item">
          <a class="nav-link text-white active" aria-current="page" href="new.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white active" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white active" href="sign.php">Sign Up</a>
        </li>
        <li>
            <a class="nav-link  text-white active" href="logon.php"> Admin Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active text-white"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
            INFO
          </a>
          <ul class="dropdown-menu ">
            <li><a class="dropdown-item" >Contact : 07033733912</a></li>
            <li><a class="dropdown-item" >WhatsApp : O9017121642</a></li>
            <li><a class="dropdown-item" > Facebook : Alameen Estate</a></li>

      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<div class="container my-5" >
    <form action="" method="post">
       <h1 class="offset-sm-3 col-sm-6">USER LOGIN</h1>
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
       <form method="post" action="login.php" >
         <div class="row mb-3 my-3 ">
         <i class="fa-solid fa-envelope col-sm-1 col-form-label"></i>
              <div class="col-sm-6 col-form-label-lg  form-floating ">
               <input type="email" name="email" class="form-control " required>
               <label for="floatingInput">Email address</label>
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-key col-sm-1 col-form-label"></i>
              <div class="col-sm-6 form-floating">
               <input type="password" name="password" class="form-control " required>
               <label for="floatingInput">Password</label>
              </div>
         </div>
         <?php

         if ( !empty($successMessage) ) {
            echo " 
            </div>
            <div class='row mb-3'>
                <div class= 'offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
            </div>
            ";
         }
         ?>

         <div class="row mb-3">
            <div class="offset-sm-2 col-sm-3 d-grid">
             <input type="submit" name="submit" value="LOGIN" class="btn btn-outline-primary ">
            </div>
         </div>
        <div class="row mb-3">
        <div class="offset-sm-1 col-sm-3 d-grid">
            <a class="btn btn-secondary" role="button" href="sign.php">Don't Have an account? Sign up..</a>
            </div>
         <div class="col-sm-3 d-grid">
            <a class="btn btn-dark" role="button" href="forgot.php">Forgot Password</a>
            </div>

       </form> 
       </form>

</body>
</html>