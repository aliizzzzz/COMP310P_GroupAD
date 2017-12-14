<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(function(){
            $("ul a").each(function(){
                if (this.href == document.URL) {
                    $(this).css("background" , "rgb(150, 191, 176)");
                }
            });
        });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Adamina" rel="stylesheet">
    <link rel="stylesheet" href="includes/styles.css">

    <title>Bright Tutors</title>
</head>

<body>
    <header>
        <a href= "<?php echo create_url('index.php'); ?>"><h1>Bright Tutors</h1></a>

        <?php

        if(isset($_SESSION["first_name"])) {
            echo "<div id=\"username\">Hello " . "{$_SESSION["first_name"]}" . "! <a href=\"logout.php\" onclick=\"return confirm('Are you sure?')\">logout</a></div>";
        } else {
            echo "<div id=\"username\">Please log in <a href=\"login.php\"> here</a></div>";
        }

        echo "<ul>";
        if(isset($_SESSION["user_id"])) {
            echo "<a href=\"" . create_url('index.php') . "\">
                <li>Home</li>
            </a>
            <a href=\"" . create_url('lessons.php') . "\">
                <li>Lessons</li>
            </a>";
        }
        echo "</ul>";

        ?>

<!--
        <ul>
            <a href="<?php echo create_url('index.php'); ?>">
                <li>Home</li>
            </a>
            <a href="<?php echo create_url('lessons.php'); ?>">
                <li>Lessons</li>
            </a>
        </ul>
-->
    </header>
