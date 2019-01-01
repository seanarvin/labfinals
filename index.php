<?php
session_start();

if (isset($_SESSION['full'])) {
    $ty = $_SESSION['userType'];
    if ($ty == "admin") {
        header('Location:Admin/index.php');
    } elseif ($ty == "sp") {
        header('Location:ServiceProvider/dashboard.php');
    }elseif ($ty == "user") {
        header('Location:../user/delivery.php');
    } else {

    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Login</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/style2.css"/>
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css"/>
</head>
<html>
<body>
<div class="container">
    <header>
        <h1>Traba<strong>Who</strong></span></h1>

    </header>
    <br>
    <br>
    <br>
    <br>

    <section>
        <div id="container_demo">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form action="php/login.php" method="post">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname" data-icon="u"> Username </label>
                            <input id="username" name="username" required="required" type="text" placeholder=""/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                            <input id="password" name="password" required="required" type="password" placeholder=""/>
                        </p>
                        <p class="login button">
                            <input type="submit" value="Login"/>
                        </p>
                        <p class="change_link">
                            Not a member yet ?
                            <a href="#toregister" class="to_register">Join us</a>
                        </p>
                    </form>
                </div>

                <div id="register" class="animate form">
                    <form action="ServiceProvider/backend/register.php" autocomplete="on" method="post">
                        <h1> Sign up </h1>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">First Name</label>
                            <input  name="first_name" required="required" type="text"
                                   placeholder=""/>
                        </p>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">Last Name</label>
                            <input  name="last_name" required="required" type="text" placeholder=""/>
                        </p>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">Address</label>
                            <input  name="address" required="required" type="text" placeholder=""/>
                        </p>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">Contact No</label>
                            <input  name="num" required="required" type="text" placeholder=""/>
                        </p>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">Email</label>
                            <input  name="email" required="required" type="email" placeholder=""/>
                        </p>
                        <p>
                            <label for="usernamesignup" class="uname" data-icon="u">Username</label>
                            <input  name="username" required="required" type="text" placeholder=""/>
                        </p>
                        <p>
                            <label for="pass" class="youpasswd" data-icon="p">Your password </label>
                            <input id="pass" name="password" required="required" type="password"
                                   placeholder=""/>
                        </p>
                        <p>
                            <label for="pass2" class="youpasswd" data-icon="p">Please confirm your
                                password </label>
                            <input id="pass2" name="password2"  required="required" type="password"
                                   placeholder=""/>
                        </p>
                        <span id="msg"></span>
                        <div class="styled-select slate">
                            <select name="type" class="form-control">
                                <option value="sp">Service Provider</option>
                                <option value="client">Client</option>
                            </select>
                        </div>
                        <p class="signin button">
                            <input type="submit" id="sub" value="Sign up"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href="#tologin" class="to_register"> Go and log in </a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
</body>

</html>