<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <!--?php require_once './head.html'?-->    
        <form method="post" action="">
            <label>Full Name: <input type="text" name="fName" id="fName" required></label>
            <br>User type: 
            <br><label><input type="radio" name="userType" value="normal" checked>Normal User</label>
            <label><input type="radio" name="userType" value="operator">Admin/ Recycle Station Operator</label>
            <br><label>Email: <input type="email" name="email" id="email" required></label>
            <br><label>Password: <input type="password" name="password" id="password" required pattern="^(\S{8,14})" title="8 to 14 non-whitespace characters"></label>
            <br><button type="submit" name="submit">Submit</button>
        </form>

        <dialog id="registerSuccess">
            <h4>Successfully registered</h4>
            <a href="./login.php">Ok</a>
        </dialog>

        <dialog id="registerFail">
            <h4>Registration failed</h4>
            <span></span>
            <button>Ok</button>
        </dialog>

<?php
if (isset($_POST['submit'])) {
    $fName = $_POST['fName'];
    $userType = $_POST['userType'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = new PDO('sqlite:recycle.db');
    $sql = "insert into users(fName, userType, email, password) values(?, ?, ?, ?)";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $fName);
    $statement->bindValue(2, $userType);
    $statement->bindValue(3, $email);
    $statement->bindValue(4, $password);

    try {
        if ($statement->execute()){ ?> 

            <script>
                document.querySelector('#registerSuccess').showModal();
            </script>

            <?php 
        }
    } catch (PDOException $e) { ?>

        <script>
            const failDialog = document.querySelector('#registerFail');
            failDialog.showModal();
            failDialog.querySelector('button').onclick = () => failDialog.close();
            failDialog.querySelector('span').innerText = <?=$e->getMessage()?>
        </script>
<?php
    } 
}
?>
    </body>
</html>

