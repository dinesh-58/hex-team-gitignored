<?php
// check if user has legitimately logged in
// redirect back to login if not isset session value or if userId isn't present in database
session_start();
if (!isset($_SESSION['userId'])) {
    ob_start();
    header('Location: ./login.php');
    ob_end_flush();
    die();
}

$pdo = new PDO('sqlite:recycle.db');
$sql = "select fName, rewardPoints from users where userId = {$_SESSION['userId']}";
$statement = $pdo->query($sql);
$result = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
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
                <span>✨ Reward points: <?=$result['rewardPoints']?><span> 
        </div>

        <div class="rewards-container">
            <?php
                $costs = [50, 100, 200];
                for ($i=0; $i<3; $i++) {
                    ?>
                    <div>
                        <img src="reward-$i.png" <?php 
                            if ($costs[$i] > $result['rewardPoints']) 
                                echo 'class = "grayscale"'; ?>>
                        <!-- in css, just use filter: saturate(0);-->
                        <span>Recycled paper</span>
                        <span>Cost: <?=$costs[$i]?></span>
                    </div>
                    <?php
                }
            ?>
        </div>

        <div>
            <h3>Nearby Recycling Stations</h3>
            <ul>
                <li><h4>Station 1</h4>
                    <span>Koteshwor, Kathmandu</span>
                    <span>near Police Staion</span>
                </li>
                <li><h4>Station 2</h4>
                    <span>Chyasal, Lalitpur</span>
                    <span>near ANFA football ground</span>
                </li>
                <li><h4>Station 3</h4>
                    <span>Singha Durbar</span>
                    <span>beside NTC office</span>
                </li>
            </ul>
        </div>
    </body>
</html>
