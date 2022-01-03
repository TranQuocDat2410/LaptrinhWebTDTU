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

    $current = date('y-m-d');
    echo $current;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="detail_user.css">
</head>
<body>
    <!-- <a href = "logout.php" class="btn btn-danger">Logout</a> -->
    <div class="container">
        
    </div>
</body>
</html>