<?php
session_start();
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
// require_once './head.html'
?>
<form method="post" action="">
    <fieldset>
        <legend>Login</legend>
        <br><label>Email: <input type="email" name="email" id="email" required></label>
        <br><label>Password: <input type="password" name="password" id="password" required pattern="^(\S{8,14})" title="8 to 14 non-whitespace characters"></label>
        <br><button type="submit" name="submit">Submit</button>
    </fieldset>
</form>

<dialog id="loginFail">
    <span></span>
    <button>Ok</button>
</dialog>

<?php
function setFail($message) {
    ?>
    <script>
        const failDialog = document.querySelector('#loginFail');
        failDialog.showModal();
        failDialog.innerText = <?=$message?>;
        failDialog.querySelector('button').onclick = () => failDialog.close();
    </script>
    <?php
}

if (isset($_POST['submit'])) {
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    $pdo = new PDO('sqlite:recycle.db');
    $emailSql = "select userId, email, password, userType from users where email = '$email' limit 1";
    $emailStatement = $pdo->query($emailSql);

    if (!$emailStatement) {
        setFail('Couldn\'t find an account with this email');
    } else {
        $result = $emailStatement->fetch(PDO::FETCH_ASSOC);
        if (strcmp($password, $result['password']) == 0) {
            $_SESSION['userId'] = $result['userId'];
            redirect("dashboard/dashboard-{$result['userType']}.php");
        } else {
            setFail('Password is incorrect');
        }
    }
}

// require_once './footer.html'
?>
