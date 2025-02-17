<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'al-amin';

$conn = new mysqli($servername, $username, $password, $database);
if($conn -> connect_error){
    die ('connection error');
}else{
}
