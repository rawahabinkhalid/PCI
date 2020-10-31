<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password Page</title>
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
                <div class="card-header">
                    <h3>Forgot Password</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <!-- <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    <form action="forgot_password_api.php" id="forgotpassword_api">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" pattern="^\(?([0-9]{4})\)?([-])([0-9]{7})$"
                                title="Phone # should be in format 0123-4567890" class="form-control"
                                placeholder="phone Number" id="PhoneNumber" name="PhoneNumber">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="emailaddress" id="Email" name="Email">
                        </div>
                        <div class="row align-items-center remember">
                            <br>
                            <!-- <input type="checkbox">Remember Me -->
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Send" class="btn login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Already have an account?<a href="index.php">Sign in here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<script>
$("#forgotpassword_api").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    var data = {
        'Email': $('#Email').val(),
        'PhoneNumber': $('#PhoneNumber').val()
    };

    $.ajax({
        type: "POST",
        url: url,
        data: JSON.stringify(data), // serializes the form's elements.
        contentType: "json",

        success: function(data) {
            console.log(data);
            // alert(data);
            var obj = JSON.parse(data);
            // if (obj.data_temp == null)
            alert(obj.message);

            // window.location.href = "index.php";
        }
    });
});
</script>