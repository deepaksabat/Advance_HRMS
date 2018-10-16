<?php

error_reporting(0);

$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
$cn = '1';

if ($cn == '1') {
    $input = "<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mysql',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => '$db_host',
            'port' => '3306',
            'database' =>'$db_name',
            'username' => '$db_user',
            'password' => '$db_password',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host' => env('REDIS_HOST', 'localhost'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];

";

    $wConfig = '../../application/config/database.php';

    $fh = fopen($wConfig, 'w');

    if ($fh==false) {

        echo "can't create config file, your server does not support 'fopen' function, please provide the permisson of your root folder or create a file named - database.php with following contents in application/config/ folder.";
        echo "<pre>";
        echo htmlentities($input);
        exit();

    }


    fwrite($fh, $input);
    fclose($fh);

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $sql = file_get_contents('advanced-hrm.sql');
    $qr = $dbh->exec($sql);
} else {
    header("location: step3.php?_error=1");
    exit;
}
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
        <?php
        if ($cn == '1') {
            $cururl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $appurl = str_replace('/install/step4.php', '', $cururl);
            $orginal_path=str_replace('application','',$appurl);
            ?>
            <p>
                <strong>Config File Created and Database Imported.</strong><br>
            </p>
            <form action="step5.php" method="post">
                <fieldset>
                    <legend>Configure your Application URL in the Database</legend>
                    <label>URL</label>
                    <input type='text' name="appurl" class="form-control" value="<?php echo $orginal_path; ?>">
                    <span class='help-block'>Please do not edit above url if you are unsure. Just click continue.</span>

                    <button type='submit' class='btn btn-primary'>Continue</button>
                </fieldset>
            </form>
        <?php
        } elseif ($cn == '2') {
            ?>
            <p>
                MySQL Connection was successful. An error occurred while adding data on MySQL. Unsuccessful
                Installation. Please refer manual installation in the Documentation or Contact coderpixel@gmail.com for
                helping on installation
            </p>

        <?php
        } else {
            ?>
    <p> MySQL Connection Failed. </p>
        <?php

        }
        ?>
    </div>
</div>
<!--  contents area end  -->
</div>
<div class="footer">Copyright &copy; CoderPixel 2016 All Rights Reserved<br/>
    <br/>
</div>
</body>
</html>

