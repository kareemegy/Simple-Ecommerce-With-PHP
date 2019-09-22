<?php
require "config/database.php";
require "classes/users.php";
$db = new DataBase();
$user = new Users($db->getConnection());

if (isset($_POST['submit'])) {

    // send user data
    $user_name = htmlspecialchars(stripslashes(trim(($_POST['user_name']))));
    $user_email = htmlspecialchars(stripslashes(trim($_POST['user_email'])));
    $user_password = htmlspecialchars(stripslashes(trim($_POST['user_password'])));
    $re_password = htmlspecialchars(stripslashes(trim($_POST['user_password_re-enter'])));

    if (!empty($user_name) && !empty($user_email) && !empty($user_password && !empty($re_password))) {

        if ($user_password === $re_password) {

            $user->user_name = $user_name;
            $user->user_email = $user_email;
            $user->user_password = $user_password;
            if (!$user->is_user_exiset()) {

                if ($user->Create_user()) {
                    echo "<div class='container'>";
                    echo "<div class='alert alert-success mt-5 ml-5 ' role='alert'>User is Created  </div>";
                    echo "</div>";

                } else {
                    echo "<div class='container'>";
                    echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'>Something wrong is happen </div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='container'>";
                echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'> the email  is taken </div>";
                echo "</div>";

            }

        } else {
            echo "<div class='container'>";
            echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'>the Password shoud be the same </div>";
            echo "</div>";

        }
    } else {
        echo "<div class='container'>";
        echo "<div class='alert alert-danger mt-5 ml-5 ' role='alert'>Fill all the fields </div>";
        echo "</div>";
    }

}
?>

<?php include "Components/header.php";?>
<div class="container">

    <form class="p-5" action="register.php" method="post" >
    <div class="form-group">
        <label class="bg-white">Your name</label>
        <input type="text" name="user_name" class="form-control" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label class="bg-white" >Email</label>
        <input type="email" name="user_email" class="form-control" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label class="bg-white" >Password</label>
        <input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
       <div class="form-group">
        <label class="bg-white" >Re-enter password</label>
        <input type="password" name="user_password_re-enter" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" name="submit" class="btn btn-outline-primary">Create new Account</button>
    </form>
</div>
<?php include "Components/footer.php";?>

