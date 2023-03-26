<?php
session_start();
ob_start();
unset($_SESSION['managerid']);
if(!(isset($_SESSION['userid']) && isset($_SESSION['email'])))
{
    header('location:signin.php');
}
include './manager/conn.php';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $client = $_SESSION['client_address'];
    $call = 0;
    $email = 0;
    $whatsapp = 0;
    $filename = '';
    $notes = $_POST['notes'];
    $status = 'none';
    if(isset($_POST['status'])) {
        $status = $_POST['status'];
    }
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y/m/d H:i:s A');
    if(isset($_POST['submit'])) {
        if(isset($_POST['call_status'])) {
            $call = 1;
        }
        if(isset($_POST['whatsapp_status'])) {
            $whatsapp = 1;
        }
        if(isset($_POST['email_status'])) {
            $email = 1;
        }
        if(file_exists($_FILES['image']['name'])) {
            $destFolder = 'uploads/images/';
            $filename = $_FILES['image']['name'];
            $temp = $_FILES['image']['tmp_name'];
            $ext = explode('.',$filename);
            $ext = strtolower(end($ext));
            $newFile = uniqid('', true) . '_' . time() . '.' . $ext;
            try{
                if(move_uploaded_file($temp, $destFolder . $newFile)){
                    $query = "UPDATE admin_table SET call_status = '$call', whatsapp_status = '$whatsapp', email_status = '$email', notes = '$notes', updated_time = '$date',status = '$status' WHERE address LIKE '$client%' ";
                    mysqli_query($conn, $query);
                    $query2 = "UPDATE clients SET image = '$newFile' WHERE address = '$client'";
                    mysqli_query($conn, $query2);
                    $_SESSION['success'] = "Information Updated Successfully...";
                } else {
                    $_SESSION['error'] = "Error in uploading image";
                    echo "Error in uploading image";
                }

        } catch(Exception $e) {
            $_SESSION['error'] = "Image cannot able to upload";
        }
        }
        else {
            $query = "UPDATE admin_table SET call_status = '$call', whatsapp_status = '$whatsapp', email_status = '$email', notes = '$notes', updated_time = '$date',status = '$status' WHERE address LIKE '$client%' ";
            mysqli_query($conn, $query);
            $_SESSION['success'] = "Information Updated Successfully...";
        }
    }
    else {
        $_SESSION['error'] = "Something went wrong! Try Again";
    }
}
else {
    $_SESSION['error'] = "Something went wrong!";
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
    <link href="manager/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="manager/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
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
              setTimeout(()=>{ history.back(); },1500);
              </script>";
  			unset($_SESSION['error']);
  		}
		  if(isset($_SESSION['success'])){
			echo "<script>Swal.fire({
                position: 'center',
                icon: 'success',
                title: '".$_SESSION['success']."',
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout(()=>{ history.back(); },1500);
              </script>";
			unset($_SESSION['success']);
		}
  	?>
</body>
</html>