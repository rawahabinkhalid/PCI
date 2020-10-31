<!DOCTYPE html>
<html>

<head>
    <title>SignUp Page</title>
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
            <div class="card">
                <div class="card-header">
                    <h3>Sign Up Portals</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <!-- <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group text-center">
                            <img src="images/student.png" width="100px;">
                            <a class="btn signup_btn" href="signup_student.php"
                                style="text-decoration:none; color:#000">Student Sign Up
                            </a>
                        </div>
                        <div class="form-group text-center">
                            <img src="images/teacher.png" width="100px;">
                            <a class="btn signup_btn" href="signup_teacher.php"
                                style="text-decoration:none; color:#000">Teacher Sign Up
                            </a>
                        </div>
                        <div class="form-group text-center">
                            <img src="images/admin.png" width="100px;">
                            <a class="btn signup_btn" href="signup_institute.php"
                                style="text-decoration:none; color:#000">Institute Sign Up
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Already have an account?<a href="index.php">Sign in here</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="forgotpassword.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>