<?php 
// require_once './head.html'
?>
<form method="post" action="">
    <br><label>Email: <input type="email" name="email" id="email" required></label>
    <br><label>Password: <input type="password" name="password" id="password" required pattern="^(\S{8,14})" title="8 to 14 non-whitespace characters"></label>
    <br>User type: 
    <br><label><input type="radio" name="userType" value="normal" checked>Normal User</label>
    <label><input type="radio" name="userType" value="operator">Admin/ Recycle Station Operator</label>
    <br><button type="submit" name="submit">Submit</button>
</form>
