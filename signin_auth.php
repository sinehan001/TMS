<?php 
    session_start();
    ob_start();
    if(isset($_POST['submit']) && $_POST['email']!='' && $_POST['password'])
    {
        include 'manager/conn.php';
        $email = $_POST['email'];
        $sql = "SELECT * FROM managers WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) 
        {
            $row = mysqli_fetch_assoc($query);
            $id = $row['id'];
            $hashed_password = $row['password'];
            if(isset($_POST['password']))
            {
                if(hash_equals(hash("sha256", $_POST['password']), $hashed_password))
                {
                    $_SESSION['message'] = 'Successfully Logged in';
                    $_SESSION['email'] = $email;
                    $_SESSION['managerid'] = $id;
                    echo "success";
                    header('Location: manager/index.php');
                }
                else {
                    $_SESSION['error'] = 'Password is Wrong';
                    header('Location: signin.php');
                }
            }
            else {
                $_SESSION['error'] = 'Password not given';
                header('Location: signin.php');
            }
        }
        else if(mysqli_num_rows($query) == 0) {
            $sql = "SELECT * FROM staffs WHERE email = '$email'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0) 
            {
                $row = mysqli_fetch_assoc($query);
                $id = $row['id'];
                $staffs = $row['name'];
                $password = $row['password'];
                $password = str_replace('$2a$','$2y$',$password);
                if(isset($_POST['password']))
                {
                    echo $password;
                    if(password_verify($_POST['password'], $password))
                    {
                        $_SESSION['message'] = 'Successfully Logged in';
                        echo 'success';
                        $_SESSION['email'] = $email;
                        $_SESSION['staffs'] =  $staffs;
                        $_SESSION['userid'] = $id;
                        header('Location: index.php');
                    }
                    else {
                        $_SESSION['error'] = "Password is wrong";
                        header('Location: signin.php');
                    }
                }
                else {
                    $_SESSION['error'] = 'Password is Wrong';
                    header('Location: signin.php');
                }
            }
            else {
                $_SESSION['error'] = 'Email not registered';
                header('Location: signin.php');
            }
        }
        else 
        {
            $_SESSION['error'] = 'Email is not registered';
            header('Location: signin.php');
        }
    }
    else 
    {
        if($_POST['email']=='') {
            $_SESSION['error'] = 'Please Enter the Email Address';
        }
        else {
            if($_POST['password']=='') {
                $_SESSION['error'] = 'Please Enter the password';
            }
            else {
                $_SESSION['error'] = 'Unauthorized Email';
            }
        }
        header('Location: signin.php');
    }
?>