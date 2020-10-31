<?php
include_once('../conn.php');
session_start();
if(isset($_SESSION['userrole'])){
    if($_SESSION['userrole']=="Institute"){
        header('location:../InstitutePortal/index.php');
    }
    else if($_SESSION['userrole']=="Student"){
        header('location:../StudentPortal/index.php');
    }
    else if($_SESSION['userrole']=="Teacher"){
        header('location:../TeacherPortal/index.php');
    }
     else if($_SESSION['userrole']=="Admin"){
        header('location:../AdminPortal/index.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card card_login">
                <div class="card-header card_login_header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <!-- <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="login_data.php" id="loginform">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="email@ddress">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <div class="row align-items-center remember">
                            <br>
                            <!-- <input type="checkbox">Remember Me -->
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="submit" value="Login" class="btn login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="signup.php">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="forgotpassword.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- *************************** api login form ************************* -->
<script>
$("#loginform").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            console.log(data);
            // alert(data);
            var obj = JSON.parse(data);
            console.log(obj);
            if (obj.userrole == "Student") {
                window.open("../StudentPortal/index.php", "_self");
            } else if (obj.userrole == "Admin") {
                window.location.href = "../AdminPortal/index.php";
            } else if (obj.userrole == "Teacher") {
                window.location.href = "../TeacherPortal/index.php";
            } else if (obj.userrole == "Institute") {
                window.location.href = "../InstitutePortal/index.php";
            }
            // show response from the php script.
        }
    });
});
</script>

</html>