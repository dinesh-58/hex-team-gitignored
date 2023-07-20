<?php
// check if user has legitimately logged in
// redirect back to login if not 
session_start();
if (!isset($_SESSION['userId'])) {
    ob_start();
    header('Location: ../login.php');
    ob_end_flush();
    die();
}

$pdo = new PDO('sqlite:../recycle.db');
$sql = "select fName, userType, rewardPoints from users where userId = {$_SESSION['userId']}";
$currentUserStatement = $pdo->query($sql);
$result = $currentUserStatement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../common.css" rel="stylesheet">
    </head>
    <body>
	<main class="dashboard__main">
		<div class="navbar__sitename">
			<a href="../index.php" class="navlink">
				<img src="../img/favicon.png" alt="Site Logo" class="navbar__sitename-logo" height="25">
				Placeholder
			</a>
		</div>
		<div class="login">
			<a href="#" class="navlink">
				<img src="../img/icon_login.png" alt="Login" class="icon">
				Log In
			</a>
		</div>

        <div class="user-info">
                <img src="../img/iconmonstr-user.svg" alt="Profile icon">
                <span><?=$result['fName']?></span>
                <?php 
                    if (strcmp($result['userType'], 'normal') == 0) {
                        echo "<span>🌟Reward points: {$result['rewardPoints']}<span>";
                    } else {
                        echo "<span>Recycling Station Operator</span>";
                    }
                ?>
        </div>
