<?php

//  LOCAL CNX:
function cnx()
{
    $servername = 'sql311.byethost24.com';
    $username = 'b24_33744410';
    $password = 'p2rf2ct0';
    $database = 'b24_33744410_mydb';
    $port = 3306;
    
    $conn = mysqli_connect($servername, $username, $password, $database, $port) or  die("Connection failed: " . mysqli_connect_error());
    mysqli_set_charset($conn,"utf8");
    
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
