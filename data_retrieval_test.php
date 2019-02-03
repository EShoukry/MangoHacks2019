<?php
ob_start();
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carnival_testing";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$average_ratings = array();
for($x = 1; $x <=200; $x++)
{
    $view = "SELECT AVG(rating) AS average FROM category_rating WHERE customer_ID = $x";
    $result = $mysqli->query($view);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($average_ratings, $row['average']);
            echo $row['average'];
            echo  "<br>";
        }
    }
}


for($x = 1; $x <=200; $x++)
{
    $view2 = "SELECT COUNT(rating) AS count, customer_ID FROM category_rating WHERE customer_ID = $x AND rating < " . $average_ratings[$x-1];
    $result2 = $mysqli->query($view2);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            echo $row2['count'];
            echo  "<br>";
            echo $row2['customer_ID'];
            echo  "<br>";
        }
    }
}


