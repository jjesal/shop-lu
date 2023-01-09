<?php

//  LOCAL CNX:
function cnx()
{
    $servername = '127.0.0.1';
    $username = 'root';
    $password = '';
    $database = 'mydb';
    $port = 3306;
    $conn = mysqli_connect($servername, $username, $password, $database, $port) or  die("Connection failed: " . mysqli_connect_error());
    return $conn;
}


//  SAVECRON-TH CNX: 
    // function cnx() {
    //     $servername = 'sql211.byethost.com';
    //     $username = 'b8_24948418';
    //     $password = 'p2rf2ct0';
    //     $database = 'b8_24948418_savecron';
    //     $port = 3306;
    // 	$conn = mysqli_connect($servername, $username, $password, $database) or  die("Connection failed: " . mysqli_connect_error());	
    //     return $conn;
    // }
