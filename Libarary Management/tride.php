<?php
//include ("connect12.php")
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['submit'])){
    if(isset($_POST["good"])){
        $result = "Thanks For Yor Feddback We hope you enjoy your fture rides";
    }
    echo $result;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Ride</title>
</head>
<body>
    <div class="head" style= "margin-left: 10%;">
        <p>
            <h1>First Time On a train</h1>
        </p>
    </div>
    <!--
        Headong of the page
-->
<div>
    <form action="" method="post">
        <ul>
            <p>
                <li id="q1">How was the ride</li>
                <input type="radio" name="good" id="q1" >Good <br>
                <input type="radio" name="verygood" id="q1" >Very Good <br>
                <input type="radio" name="poor" id="q1" >Poor <br>
                <input type="radio" name="okay" id="q1" >Okay <br>
            </p>
            <br>
        </ul>
        <big><input type="submit" value="Submit"></big>
    </form>
</div>
</body>
</html>