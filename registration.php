<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <?php require_once './header.html'?>    
        <form method="post" action="">
            <label>Full Name: <input type="text" name="fName" id="fName" required></label>
            <br>User type: 
            <br><label><input type="radio" name="userType" value="normal" checked>Normal User</label>
            <label><input type="radio" name="userType" value="operator">Admin/ Recycle Station Operator</label>
            <br><label>Email: <input type="email" name="email" id="email" required></label>
            <br><label>Password: <input type="password" name="password" id="password" required></label>
            <br><button type="submit" name="submit">Submit</button>
        </form>
    </body>
</html>
