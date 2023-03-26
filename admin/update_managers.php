<?php 
    session_start();
    ob_start();
	unset($_SESSION['userid']);
    unset($_SESSION['managerid']);
    if(!(isset($_SESSION['adminid']) && isset($_SESSION['email'])))
    {
        header('location:../signin.php');
    }
    if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['submit'])) {
        include '../manager/conn.php';
        $filename = '';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $hashp04 = hash("sha256",$password);

        $flag = 0;
        $query = mysqli_query($conn,"SELECT * FROM managers");
        while($row = mysqli_fetch_assoc($query)) {
            if($row['email'] == $email) {
                $_SESSION['error'] = "Email already available";
                $flag = 1;
                break;
            }
            if(strcasecmp($row['name'], $name) == 0) {
                $_SESSION['error'] = "Name already available. So, try with surname for unique username";
                $flag = 1;
                break;
            }
        }

        $query1 = mysqli_query($conn,"SELECT * FROM staffs");
        while($row = mysqli_fetch_assoc($query1)) {
            if($row['email'] == $email) {
                $_SESSION['error'] = "Email already available";
                $flag = 1;
                break;
            }
            if(strcasecmp($row['name'], $name) == 0) {
                $_SESSION['error'] = "Name already available. So, try with surname for unique username";
                $flag = 1;
                break;
            }
        }

        $query2 = mysqli_query($conn,"SELECT * FROM admin");
        while($row = mysqli_fetch_assoc($query2)) {
            if($row['email'] == $email) {
                $_SESSION['error'] = "Email already available";
                $flag = 1;
                break;
            }
            if(strcasecmp($row['username'], $name) == 0) {
                $_SESSION['error'] = "Name already available. So, try with surname for unique username";
                $flag = 1;
                break;
            }
        }

        if($flag == 0)
        {
            $filename = $_FILES['image']['name'];
            $temp = $_FILES['image']['tmp_name'];
            if(!is_null($filename)) {
                $destFolder = 'uploads/images/managers/';
                $ext = explode('.',$filename);
                $ext = strtolower(end($ext));
                $newFile = uniqid('', true). '.' . $ext;
                try{
                    if(move_uploaded_file($temp, $destFolder . $newFile)) {
                        $query = "INSERT INTO managers (name, address, password, email, phone, image) VALUES ('$name','$address','$hashp04','$email','$phone','$newFile')";
                        mysqli_query($conn, $query);
                        $_SESSION['success'] = "Information Added Successfully...";
                        // echo "succcess";
                    } else {
                        $_SESSION['error'] = "Error in uploading image";
                        // echo "error";
                    }
    
                }   catch(Exception $e) {
                $_SESSION['error'] = "Image cannot able to upload";
                // echo "image not upload";
                }
            }
            else {
                // echo "not full";
                $query = "INSERT INTO managers (name, address, password, email, phone, image) VALUES ('$name','$address','$hashp04','$email','$phone','client.svg')";
                mysqli_query($conn, $query);
                $_SESSION['success'] = "Information Updated Successfully...";
            }
        }
    }
    else 
    {
        $_SESSION['error'] = 'Unauthorized User';
    }
}
else 
{
    $_SESSION['error'] = 'Unauthorized User';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../manager/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="../manager/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<body data-kt-name="Marketino" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<script>if ( document.documentElement ) { const defaultThemeMode = "system"; const name = document.body.getAttribute("data-kt-name"); let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); }
</script>
<?php
  		if(isset($_SESSION['error'])){
  			echo "<script>Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '".$_SESSION['error']."'
              });
              setTimeout(()=>{ window.location.href='add_managers.php'; },2000);
              </script>";
  			unset($_SESSION['error']);
  		}
		  if(isset($_SESSION['success'])){
			echo "<script>Swal.fire({
                position: 'center',
                icon: 'success',
                title: '".$_SESSION['success']."',
                showConfirmButton: false
              });
              setTimeout(()=>{ window.location.href='add_managers.php'; },2000);
              </script>";
			unset($_SESSION['success']);
		}
  	?>
</body>
</html>