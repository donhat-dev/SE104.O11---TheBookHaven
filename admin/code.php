<?php

include '../config/funtion.php';

// session_start();
if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query_run = execute("SELECT * FROM account WHERE email='$email' ");
    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO account (name,email,password, type) VALUES ('$username','$email','$password', 1)";
            $query_run = execute($query);

            if ($query_run) {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            } else {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
        } else {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }
}

//boss update cho nhân viên
if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $phone = $_POST['edit_phone'];
    $pass = $_POST['edit_password'];
    $address = $_POST['edit_address'];
    // 

    $update_query = "UPDATE account SET name='$name', email='$email', phone='$phone', password='$pass', address='$address' WHERE id='$id'";
    // $result =mysqli_query($conn, $update_query);
    // $conn->query($update_query)
    if (execute($update_query)) {
        $_SESSION['stt_update'] = "Update success";
        $_SESSION['stt_update_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['stt_update'] = "Error updating record: " . $conn->error;
        $_SESSION['stt_update_code'] = "fail";
        header('Location: register.php');
    }
}

//update của user
if (isset($_POST['update_btn'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $phone = $_POST['edit_phone'];
    $pass = $_POST['edit_password'];
    $address = $_POST['edit_address'];
    // 

    $update_query = "UPDATE account SET name='$name', email='$email', phone='$phone', password='$pass', address='$address' WHERE id='$id'";
    // $result =mysqli_query($conn, $update_query);
    // $conn->query($update_query)
    if (execute($update_query)) {
        unset($_SESSION['admin']);
        header('Location: login.php');
    } else {
        $_SESSION['stt_update'] = "Error updating record: " . $conn->error;
        $_SESSION['stt_update_code'] = "fail";
        header('Location: index.php');
    }
}

if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM account WHERE id='$id'";
    if ($conn->query($query)) {
        $_SESSION['stt_update'] = "Delete success";
        $_SESSION['stt_update_code'] = "success";
        header('Location: register.php');
    } else {
        $_SESSION['stt_update'] = "Error delete record: " . $conn->error;
        $_SESSION['stt_update_code'] = "fail";
        header('Location: register.php');
    }
}

//ajax tạo account admin
if (isset($_POST['check_submit_btn'])) {
    $email = $_POST['email_id'];

    $email_query_run = execute("SELECT * FROM account WHERE email='$email' ");
    if (mysqli_num_rows($email_query_run) > 0) {
        echo 0;
    } else {
        echo 1;
    }
}
