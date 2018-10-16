<?php
error_reporting(0);
$appurl = $_POST['appurl'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advance HRM Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style type="text/css">


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link href="../../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>


</head>
<body style='background-color: #deead3;'>
<div class='main-container'>
    <div class='header'>
        <div class="header-box wrapper">
            <div class="hd-logo"><a href="#"><img src="../../assets/img/logo.png" alt="Logo"/></a></div>
        </div>

    </div>
    <!--  contents area start  -->
    <div class="col-lg-12">
        <h4>Advance HRM Auto Installer </h4>

        <p>
            <strong>Congratulations!</strong><br>
            You have just install Advance HRM!<br>
            To Login Admin Portal:<br>
            Use this link -
            <?php
            $cururl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $appurl = str_replace('/install/step5.php', '', $cururl);
            $orginal_path=str_replace('application','',$appurl);

            echo '<a href="' . $orginal_path .'">' . $orginal_path . '</a>';
            ?>
            <br>
            Username: admin<br>
            Password: admin.password<br>
            After login, go to Setup -> System Settings to change other Configurations.
        </p>

    </div>
</div>
<!--  contents area end  -->
</div>
<div class="footer">Copyright &copy; CoderPixel 2016 All Rights Reserved<br/>
    <br/>
</div>
</body>
</html>