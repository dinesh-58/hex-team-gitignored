<?php
// check if user has legitimately logged in
// redirect back to login if not 
session_start();
if (!isset($_SESSION['userId'])) {
    ob_start();
    header('Location: ./login.php');
    ob_end_flush();
    die();
}

$pdo = new PDO('sqlite:recycle.db');
$sql = "select fName, userType, rewardPoints from users where userId = {$_SESSION['userId']}";
$statement = $pdo->query($sql);
$result = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="dashboard-style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <a href="./index.html">
                <img src="" alt="Logo">
                <span>Placeholder name</span>
            </a>
        </header>

        <div class="user-info">
                <img src="" alt="Profile icon">
                <span><?=$result['fName']?></span>
                <?php 
                    if (strcmp($result['userType'], 'normal') == 0) {
                        echo "<span>✨ Reward points: {$result['rewardPoints']}<span>";
                    } else {
                        echo "<span>Recycling Station Operator</span>";
                    }
                ?>
        </div>

