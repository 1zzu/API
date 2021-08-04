<?php
    //diisi dengan hosnya username, password, dan nama database
    // $conn = mysqli_connect("localhost", "root", "", "pengaduan");
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "praktik_kerja";

    // koneksi versiku OOP
    $db = new mysqli($servername, $username, $password, $databasename);

    $conn = mysqli_connect($servername, $username, $password, $databasename);
    if(!$conn){
        die("koneksi gagal");
    }
?>
