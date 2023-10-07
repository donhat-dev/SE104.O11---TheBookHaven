<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <title>Đăng nhập</title>
    <link rel=stylesheet href=css/style.css />
    <?php
    @ob_start();

    session_start();
    ?>
</head>
<style>
    .clearfix:before,
    .clearfix:after {
        content: "";
        display: table
    }

    .clearfix:after {
        clear: both
    }

    a {
        color: #0067ab;
        text-decoration: none
    }

    a:hover {
        text-decoration: underline
    }

    .form {
        width: 700px;
        margin: 13rem auto;
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

    input[type='text'],
    input[type='email'],
    input[type='password'] {
        width: 300px;
        border-radius: 5px;
        border: 1px solid #CCC;
        padding: 15px;
        color: #333;
        font-size: 14px;
        margin: 10px
    }

    input[type='submit'] {
        padding: 10px 25px 8px;
        color: black;
        background-color: white;
        text-shadow: rgba(0, 0, 0, 0.24) 0 1px 0;
        font-size: 25px;
        border-radius: 25px;
        margin-top: 10px;
        cursor: pointer;
        -webkit-appearance: none;
    }

    input[type='submit']:hover {
        background-color: black;
        color: white;

    }

    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
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

    .login-box {
        border: 1px solid #f5eae4;
        border-radius: 10px;
        padding: 5em;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        background: #606f91
    }

    ::placeholder {
        color: #81f7dd
    }

    h1 {
        color: white;
        text-transform: uppercase;
    }

    .textbox {
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 1px solid white
    }

    .textbox i {
        width: 26px;
        float: left;
        text-align: center
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
        transition: 0.5s;
    }

    .btn:hover {
        background-color: inherit !important;
        transform: translateY(-8px);
    }

    .btn:active,
    .btn:focus,
    .btn:target {
        transform: translateY(8px);
    }


    ::placeholder {
        color: black
    }

    .form h3 {
        font-size: 2rem;
        color: black
    }

    .form p {
        font-size: 1.25rem;
        color: black
    }

    .bd-rd {
        border: 10px solid;
        border-image-source: linear-gradient(45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        border-image-slice: 4;
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
    <?php require('config/connect.php');
    ?>
    <?php
    require('config/connect.php');
    //khởi động session
    if (isset($_POST['submit'])) {
        $username = stripslashes($_REQUEST['username']); // để bỏ dấu /
        $username = mysqli_real_escape_string($conn, $username); // php chuyển xuống cho mysql xử lí
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM `account` WHERE (phone='$username' or email='$username') and password='$password'";
        $result = mysqli_query($conn, $query); //or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $row = $result->fetch_assoc();
            $customer = [
                'id' => $row['id'],
                'name' => $row['name'],
                'phone' => $row['phone'],
                'birthday' => $row['birthday'],
                'email' => $row['email'],
                'address' => $row['address'],
                'type' => $row['type']
            ];
            $_SESSION['customer'] = $customer;
            if (isset($_SESSION['cart'])) {
                header("Location: cart.php");
            } else {
                header("Location: category.php");
            }
        } else {
            echo "<div class='form'><h3>Tên đăng nhập hoặc mật khẩu không đúng!</h3></br><a href='login.php'>Đăng nhập lại</a></div>";
        }
    } else {
    ?>
        <div class="form bd-rd">
            <form action method=post name=login>
                <h3>Vui lòng đăng nhập để mua hàng!</h3>
                <h1>Login</h1>
                <div class=textbox>
                    <input type=text placeholder="Tên đăng nhập" id=username name=username required>
                </div>
                <div class=textbox>
                    <input type=Password placeholder="Mật khẩu" id=password name=password required>
                </div>
                <input class=btn type=submit name=submit value="Đăng nhập">
            </form>
            <p>Bạn chưa có tài khoản? <a href=register.php>Đăng ký ngay</a></p>
            <a href=index.php>Trang chủ</a>
            <script src=https://kit.fontawesome.com/be19f55546.js crossorigin=anonymous></script>
        </div><?php }
            ob_flush(); ?>
</body>

</html>