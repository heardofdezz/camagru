<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

 require(ROOT . 'Config/core.php');

require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
Database::getBdd();
?>

<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
function advance()
{
    
}

</script>
<title>Camagru</title>
</head>

<body>
<div>
    <h1>Welcome to Camagru Project.42</h1>
</div>
<div class="42_logo">

<img src="/42_logo.png" alt="">
</div>

<button onclick="advance()">click me to login or signup</button>
</body>
<style type="text/css">
    body, html {
        background: url("/bckground.gif") fixed;
        margin: 0;

    }
    h1{
            position: relative;
            background-color: #666;
            padding: 30px;
            text-align: center;
            font-size: 35px;
            color: white;
            font-style: ;
    }
    img {
        position: relative;
    }
</style>
</html> -->