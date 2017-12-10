<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1">

    <link href="https://fonts.googleapis.com/css?family=Adamina" rel="stylesheet">
    <link rel="stylesheet" href="includes/styles.css">
    <title>Bright Tutors</title>
</head>

<body>
    <header>
        <h1>Bright Tutors</h1>

        <?php

        if (isset($_SESSION["first_name"])) {
            echo "<div id=\"username\">Welcome " . "{$_SESSION["first_name"]}" . " ! <a href=\"logout.php\">logout</a></div>";
        } else {
            echo "<div id=\"username\">Please log in <a href=\"login.php\"> here</a></div>";
        }

        function create_url($path) {
        if(isset($_SESSION["user_id"])){
            $url = $path . '?first_name=' . $_SESSION["first_name"];
            return $url;
        } else
            $url = "";
            return $url;
        }
        ?>
        <ul>
            <a href="<?php echo create_url('index.php'); ?>">
                <li>Home</li>
            </a>
            <a href="<?php echo create_url('lessons.php'); ?>">
                <li>Lessons</li>
            </a>
        </ul>
    </header>
