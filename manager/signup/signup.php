<?php 
    session_start();
    ob_start();
    if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['email']))
    {
        include '../conn.php';
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM admin WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0) 
        {
            $opts04 = [ "cost" => 10];
            $hashp04 = password_hash($password, PASSWORD_BCRYPT, $opts04);
            mysqli_query($conn,"INSERT INTO admin (username, email, password) VALUES ('$name', '$email', '$hashp04')");
            $_SESSION['success'] = 'Admin Account Created Successfully';
        }
        else 
        {
            $_SESSION['error'] = 'Email already registered';
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
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
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
              setTimeout(()=>{ window.location.href='index.php'; },2000);
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
              setTimeout(()=>{ window.location.href='../../signin.php'; },2000);
              </script>";
			unset($_SESSION['success']);
            $_SESSION['info'] = 'Now, You can login using the credentials as an admin';
		}
  	?>
</body>
</html>