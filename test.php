<?php
    // session_start();
    // print_r($_SESSION);
    // $str = 'mvmanh';
    // $strhash = password_hash($str,PASSWORD_DEFAULT);
    // echo $strhash;
    // echo "       ";

    // if(password_verify($str,$strhash)){
    //     echo "true";
    // }
    // else{
    //     echo "false";
    // }
    session_start();
    print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <a href = "logout.php" class="btn btn-danger">Logout</a>
</body>
</html>