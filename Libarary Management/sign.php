<?php
   include('connection.php');
    if(isset($_POST["submit"])){
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $phone = $_POST["phone"];
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $secret = mysqli_real_escape_string($conn, $_POST["secret"]);
        $cpass = mysqli_real_escape_string($conn, $_POST["cpass"]);

        $resut = mysqli_query ($conn, "SELECT * FROM volunteer WHERE name = '$name'");
        $count_user = mysqli_num_rows($resut);
        $y= strlen($password);
        $p = strlen($phone);
        
        $sql = "select * from volunteer where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user==0 and $count_email==0){
            if($p == 11){
                if($password==$cpass and $y>7){
                    $result = mysqli_query($conn, "INSERT INTO volunteer(name, email, phone, password, secret) VALUES('$name', '$email', '$phone', '$password', '$secret')");
                    if($result){
                        $successMessage = "SUCCESS";
                        $sql ="SELECT * FROM volunteer WHERE name = '$name'";
                        $resultt =mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($resultt)){
                            $id = $row['id'];
                        }
                        header("location: dash.php?id=$id");
                        exit;
                    }else{
                        $errorMessage = "invalid Query";
                    }
                    }
                    else{
                        if($y<8){
                            $errorMessage = "Password must contain at least 8 letters";
                        }
                        if($password!=$cpass){
                            $errorMessage = "Passwords do not match";
                        }
                    }
                }else{
                    $errorMessage = "Invalid Number <br> Phone Number must start with 0 and contain 11 numbers";
                }
        }
        else{
            if($count_user>0){
                $errorMessage = "Username is not Available";
            }
            if($count_email>0){
                $errorMessage = "Email Has been Registered";
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="shortcut icon" href="stylesheet/images/book.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<br>
    <!--<div style='float:left; margin-left: 10%; width: 100%;'>
    <div class="mb-5">
    <a style= "float: left; margin-top:0.3%; width: 10%;"><i class="fa-solid fa-bookmark" style="width: 50%;"></i><b style="font-size: 160%">LIBRARY</b><br><div style=" font-size: 86%"><b>MANAGEMENT</b></div></a>
    </div>
    <div class="row mb-5 container my-5 offset-sm-2">
            <div class="offset-sm-5 col-sm-1">
            <a class="btn btn-outline-success" href= "new.php"><b style= "font-size:75%; color: black;">HOME</b></a>
            </div>
            <div class="col-sm-1 ">
            <a class="btn btn-outline-primary" href= "login.php"><b style= "font-size:75%;color: black;">LOGIN</b></a>
            </div>
            <div class="col-sm-1">
            <a class="btn btn-outline-danger btn-danger" href= "sign.php"><b style= "font-size:75%; color: black;">SIGNUP</b></a>    
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
<br>
<br>
<br>
<div class="row offset-1 container my-5" >
    <div class="col">
       <h1 class="offset-sm-2 col-sm-6">Sign Up</h1>

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
       <form method="post">
         <div class="row mb-2 my-5">
         <i class="fa-solid fa-user col-sm-1 col-form-label "></i>
              <div class="col-sm-6 form-floating">
               <input type="text" name="name" class="form-control " value="" required>
               <label for="floatingInput">Enter Name </label>
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-envelope col-sm-1 col-form-label"></i>
              <div class="col-sm-6 form-floating">
               <input type="email" name="email" class="form-control" value="" required>
               <label for="floatingInput">Email</label>
              </div>
         </div>
         <div class="row mb-2 my-3">
         <i class="fa-solid fa-phone col-sm-1 col-form-label"></i>
              <div class="col-sm-6 form-floating">
               <input type="number" name="phone" class="form-control" value="" required>
               <label for="floatingInput">Enter Phone Number</label>
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-lock col-sm-1 col-form-label"></i>
              <div class="col-sm-6 form-floating">
               <input type="password" name="password" class="form-control" value="" required>
               <label for="floatingInput">Password</label>
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-lock col-sm-1 col-form-label"></i>
              <div class="col-sm-6 form-floating">
               <input type="password" name="cpass" class="form-control" value="" required>
               <label for="floatingInput">Re-enter Password</label>
              </div>
         </div>
         <div class="row mb-3 my-3">
         <i class="fa-solid fa-key col-sm-1 col-form-label"></i>
              <div class="col-sm-6">
               <input type="text" name="secret" class="form-control" value="" placeholder="For more safety input a 'secret phrase'">
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
         </div>
         <!--<div class= "col col-sm-4 container my-5"style='padding-bottom: 13%;'><h1>THE LIBRARY<br></h1>Alamin Library Provides A vast section of books, specializing in and through all aspects of Education. From Translated Quran's of many languages, To Islamic books of fiqh and Tawhid ,to Western Books as well. <br></div>-->
         <div class= "col-sm-3 offset-sm-1 container my-5 bg-white text-dark "style='padding-bottom: 5%;'><h1><br><img src="stylesheet/images/new2.png" style="width: 100%;"alt=""></h1> </div>
         <div class="row mb-2">
            <div class="offset-sm-1 col-sm-3 d-grid">
             <input type="submit" name="submit" value="Signup" class="btn btn-outline-primary ">
            </div>
         </div>
        <div class="row mb-2">
            <div class="offset-sm-1 col-sm-3 d-grid">
            <a class="btn btn-secondary" role="button" href="login.php">Already Have an account? Login..</a>
            </div>
         </div>
       </form>      
</body>
</html>