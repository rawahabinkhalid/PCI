<!DOCTYPE html>
<html>

<head>
    <title>Student SignUp Page</title>
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
                <div class="card-header text-center">
                    <img src="images/student.png" class="center" style="width:70px;">
                    <h3><u>Student Sign Up</u></h3>
                    <div class="d-flex justify-content-end social_icon">
                        <!-- <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="signup_student_data.php" id="signupstudent">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="fullname" class="form-control" placeholder="fullname" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control"
                                pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"
                                title="Email should include @ following sequence of characters. e.g. john@gmail.com"
                                placeholder="email@ddress" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="phonenumber" class="form-control"
                                pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                title="Phone # should be in format 0123-4567890" placeholder="phonenumber" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="password" required>
                        </div>
                        <div class="row align-items-center remember">
                            <br>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn signup_btn">Sign Up
                            </button>
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

<!-- *************************** api signup Student form ************************* -->
<script>
$("#signupstudent").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            // alert(data);
            var obj = JSON.parse(data);
            if (obj.studentid == null)
                alert("Error");

            window.location.href = "../StudentPortal/index.php";
        }
    });
});
</script>

</html>