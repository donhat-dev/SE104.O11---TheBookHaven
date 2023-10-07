<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <link rel=stylesheet href=css/style.css />
    <script src=https://kit.fontawesome.com/be19f55546.js crossorigin=anonymous></script>


</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

    * {
        font-family: "Montserrat", Sans-Serif;
        color: black;
        text-decoration: none;
        padding: 0;
    }

    .form-control {
        background-color: rgba(0, 0, 0, 0) !important;
        color: red;
        border: none !important;

    }

    .clearfix:before,
    .clearfix:after {
        content: "";
        display: table
    }

    .clearfix:after {
        clear: both
    }

    body {
        font: 14px sans-serif;
        background-image: linear-gradient(45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 5s ease infinite
    }

    /* gradient background*/
    @keyframes gradient {
        0% {
            background-position: 0 50%
        }

        50% {
            background-position: 100% 50%
        }

        100% {
            background-position: 0 50%
        }
    }

    a {
        text-decoration: none;
        font-size: 1.25rem;
        color: black
    }

    a:hover {
        text-decoration: none;
        color: white;
    }

    ::placeholder {
        color: black !important;
    }

    .textbox input {
        border: 0;
        outline: 0;
        background: 0;
        color: white;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px
    }

    .btn {
        width: 50%;
        border: none;
        color: white;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
        background: #b2b4b8;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: inherit !important;
    }

    .textbox {
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 1px solid white
    }

    .form h3 {
        font-size: 2rem;
        color: black
    }

    .form p {
        font-size: 1.25rem;
        color: black
    }

    h1 {
        font-size: 32px;
        color: white;
        text-transform: uppercase;
    }

    .btn {
        width: 50%;
        color: white;
        border: none;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
        background: #b2b4b8;
        border-radius: 5px;
        transition: 0.5s;
    }

    .btn:hover {
        background-color: inherit !important;
        transform: translateY(-8px);
    }

    .btn:active {
        transform: translateY(8px);
    }

    input[type='text'],
    input[type='name'],
    input[type='confirm-password'],
    input[type='phone'],
    input[type='email'],
    input[type='password'] {
        width: 80%;
        border-radius: 5px;
        border: 1px solid #CCC;
        padding: 15px !important;
        color: #333;
        font-size: 18px;
        margin: 10px
    }

    input[type='submit'] {
        padding: 10px 25px 8px;
        color: black;
        background-color: white;
        text-shadow: rgba(0, 0, 0, 0.24) 0 1px 0;
        font-size: 25px;
        border-radius: 25px;
        align-items: center !important;
        margin-top: 10px;
        cursor: pointer
    }

    input[type='submit']:hover {
        background-color: black;
        color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        border: 0;
        -webkit-text-fill-color: black;
        transition: background-color 5000s ease-in-out 0s
    }

    .form {
        width: 700px;
        margin: 3rem auto;
        border-radius: 30px;
        padding: 20px;
        justify-content: center;
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px)
    }

    .bd-rd {
        border: 10px solid;
        border-image-source: linear-gradient(45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        border-image-slice: 1;
        animation: gradient 5s ease infinite
    }

    @keyframes gradient {
        0% {
            background-position: 0 50%
        }

        50% {
            background-position: 100% 50%
        }

        100% {
            background-position: 0 50%
        }
    }
</style>

<body>
    <?php
    require('config/connect.php');
    //insert vào database
    $address = "";
    $date = "";
    $phone = $name = "";
    $email = $password = $confirm_password = "";
    $email_err = $password_err = $confirm_password_err = $phone_err = $name_err = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = stripslashes($_POST['name']);
        $name = mysqli_real_escape_string($conn, $name);

        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($conn, $email);

        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $pass_check = stripslashes($_POST['confirm_password']);
        $pass_check = mysqli_real_escape_string($conn, $pass_check);
        // Validate email
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter a email.";
        } elseif (!preg_match('/^[a-zA-Z0-9_@.]+$/', trim($_POST["email"]))) {
            $email_err = "wrong format";
        } else {
            // Prepare a select statement
            $sql = "SELECT id FROM account WHERE email = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set parameters
                $param_email = trim($_POST["email"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This email is already taken.";
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }


        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["name"]))) {
            $name_err = "Vui lòng nhập tên.";
        } elseif (preg_match('/^[0-9-_. ]+$/', trim($_POST["name"]))) {
            $name_err = "Tên không hợp lệ";
        } else {
            $name = trim($_POST["name"]);
        }


        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        if (strlen(trim($_POST["phone"])) != 10) {
            $phone_err = "Số điện thoại không hợp lệ";
        } else {
            $phone = trim($_POST["phone"]);
        }


        if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an insert statement
            $sql = "INSERT into account (name, email, phone, password, address, type) VALUES ('$name', '$email','$phone', '$password', '$address', 0)";

            $result = $conn->query($sql);
            if ($result) {
                echo "<div class='form'><h3>Bạn đã đăng ký thành công!</h3><br/>Click để <a href='login.php'>Đăng nhập ngay</a><p>Chúc bạn một buổi mua sách vui vẻ!</p></div>";
            } else {
                echo $conn->error;
            }
        }
    } else {
    ?>


        <div class="form bd-rd">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h3>Vui lòng đăng ký để đăng nhập!</h3>
                <h1>Register</h1>
                <div class="login-box">
                    <div class="textbox">
                        <input type="text" placeholder="Họ Và Tên" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>
                    <div class="textbox">
                        <input type="text" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="textbox">
                        <input type="text" placeholder="Phone" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                        <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="textbox">
                        <input type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="textbox">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <input type="submit" class="btn" value="Submit">
                    <p>Bạn đã có tài khoản ?<a href="login.php">Đăng Nhập Ngay</a></p>
                    <a href=index.php>Trang chủ</a>

                </div>
            </form>
        </div>
    <?php } ?>
</body>
<script src="https://kit.fontawesome.com/be19f55546.js" crossorigin="anonymous"></script>
<script src="public/js/vendor/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="hovereffect.css">

</html>