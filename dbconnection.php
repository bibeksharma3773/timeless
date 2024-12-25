<?php
$con = mysqli_connect("localhost", "root", "", "timeless");

if($con == false){
    die("connection Error:". mysqli_connect_error());
}

?>