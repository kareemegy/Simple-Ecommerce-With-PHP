<?php
require "config/database.php";
require "classes/users.php";
$db = new DataBase();
$user = new Users($db->getConnection());

if (isset($_POST['submit'])) {

    $user_email = htmlspecialchars(stripslashes(trim($_POST['user_email'])));
    $user_password = htmlspecialchars(stripslashes(trim($_POST['user_password'])));

    if (!empty($user_email) && !empty($user_password)) {
        $user->user_email = $user_email;
        $user->user_password = $user_password;
        $email_exiest = $user->is_user_exiset();
        if ($email_exiest && password_verify($user_password, $user->user_password)) {
            echo "<div class='container'>";
            echo "<div class='alert alert-success mt-5 ml-5 ' role='alert'>  Created  </div>";
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'>  something wrong happen try again later  </div>";
            echo "</div>";

        }
    } else {
        echo "<div class='container'>";
        echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'>  Please fill All Fileds  </div>";
        echo "</div>";

    }
}
?>
<?php include "Components/header.php";?>
<div class="container">

    <form class="p-5" action="login.php" method="post" >

    <div class="form-group ">
        <label class="bg-white" >Email</label>
        <input type="email" name="user_email" class="form-control" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label class="bg-white  " >Password</label>
        <input type="password" name="user_password" class="form-control mb-3" id="exampleInputPassword1" placeholder="Password">

    <div class="form-group form-check">
        <input type="checkbox" name="user_remember_me" class="form-check-input mt-2  "id="exampleCheck1">
        <label class="form-check-label bg-white " for="exampleCheck1">Remember me</label>
    </div>

    <button type="submit" name="submit" class="btn btn-outline-primary mt-3"">Login</button>
    </form>
</div>
<?php include "Components/footer.php";?>