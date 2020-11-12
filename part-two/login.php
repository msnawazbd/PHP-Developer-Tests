<?php
/* Starts the session */
session_start();
/* Check login or not */
if (isset($_SESSION['UserData']['Username'])) {
    header("location:index.php");
    exit;
}
/* Check Login form submitted */
if (isset($_POST['Submit'])) {
    /* Define username and associated password array */
    $logins = array('admin' => '123456', 'username' => 'password');

    /* Check and assign submitted Username and Password to new variable */
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    /* Check Username and Password existence in defined array */
    if (isset($logins[$Username]) && $logins[$Username] == $Password) {
        /* Success: Set session variables and redirect to Protected page  */
        $_SESSION['UserData']['Username'] = $logins[$Username];
        header("location:index.php");
        exit;
    } else {
        /*Unsuccessful attempt: Set error message */
        $msg = "<span style='color:red'>Invalid Login Details</span>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 border">
            <h3 class="text-center border-bottom p-2">User Login</h3>
            <?php if (isset($msg)) { ?>
                <p><?php echo $msg; ?></p>
            <?php } ?>
            <form action="" method="post" name="Login_Form">
                <div class="form-group">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control" id="Username" name="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="Password">
                </div>
                <div class="form-group text-center">
                    <input name="Submit" type="submit" value="Login" class="btn btn-primary">
                </div>
            </form>
            <p class="text-center border-top pt-1 mt-1"><small>Username: admin, Password: 123456</small></p>
        </div>
    </div>
</div>
</body>
</html>
