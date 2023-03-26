<?php 
    session_start();
    ob_start();
	unset($_SESSION['userid']);
    unset($_SESSION['managerid']);
    if(!(isset($_SESSION['adminid']) && isset($_SESSION['email'])))
    {
        header('location:../signin.php');
    }
    date_default_timezone_set("Asia/Calcutta");
    include '../manager/conn.php';
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        if(isset($_POST['submit'])) {
            $pname = $_POST['name'];
            $exp = $_POST['experience'];
            $duration = $_POST['duration'];
            $assign_date = strtotime(date('d-m-Y'));
            $query = mysqli_query($conn,"SELECT * FROM projects WHERE name='$pname'");
            if(mysqli_num_rows($query)>0) {
                $_SESSION['error'] = "Project is already Available";
            }
            else {
                if($exp=="Easy") {
                    $q1 = mysqli_query($conn, "SELECT IFNULL(MIN(counts.projects_count), 0) as min_count, managers.email FROM ( SELECT MIN(projects_count) as projects_count FROM managers ) counts JOIN managers ON managers.projects_count = counts.projects_count;");
                    $row = mysqli_fetch_assoc($q1);
                    if(mysqli_num_rows($q1)>0 && $row['min_count']!=NULL) {
                        $manager_email = $row['email'];
                        $query_success = mysqli_query($conn, "INSERT INTO projects (name,manager,assign_date,duration,total_staffs,exp) VALUES ('$pname','$manager_email','$assign_date','$duration',0,'$exp')");
                        if($query_success) {
                            $query_update = mysqli_query($conn, "UPDATE managers SET projects_count=projects_count+1 WHERE email='$manager_email'");
                            $_SESSION['success'] = "Project added successfully";
                        }
                        else {
                            $_SESSION['error'] = "Failed to add Project";
                        }
                    }
                    else {
                        $_SESSION['error'] = "Project failed to upload. No Easy/Intermediate/Export Manager have capability to select";
                    }
                }
                else if($exp=="Intermediate") {
                    $q2 = mysqli_query($conn, "SELECT IFNULL(MIN(counts.projects_count), 0) as min_count, managers.email FROM ( SELECT MIN(projects_count) as projects_count FROM managers WHERE exp NOT IN ('Beginner') ) counts JOIN managers ON managers.projects_count = counts.projects_count;");
                    $row = mysqli_fetch_assoc($q2);
                    if(mysqli_num_rows($q2)>0 && $row['min_count']!=NULL) {
                        $manager_email = $row['email'];
                        $query_success = mysqli_query($conn, "INSERT INTO projects (name,manager,assign_date,duration,total_staffs,exp) VALUES ('$pname','$manager_email','$assign_date','$duration',0,'$exp')");
                        if($query_success) {
                            $query_update = mysqli_query($conn, "UPDATE managers SET projects_count=projects_count+1 WHERE email='$manager_email'");
                            $_SESSION['success'] = "Project added successfully";
                        }
                        else {
                            $_SESSION['error'] = "Failed to add Project";
                        }
                    }
                    else {
                        $_SESSION['error'] = "Project failed to upload. No Intermediate/Export Manager have capability to select";
                    }
                }
                else {
                    $q3 = mysqli_query($conn, "SELECT MIN(projects_count) as pc, email FROM managers WHERE exp='Expert' ORDER BY RAND() LIMIT 1");
                    $row = mysqli_fetch_assoc($q3);
                    if(mysqli_num_rows($q3)>0 && $row['pc']!=NULL) {
                        $manager_email = $row['email'];
                        $query_success = mysqli_query($conn, "INSERT INTO projects (name,manager,assign_date,duration,total_staffs,exp) VALUES ('$pname','$manager_email','$assign_date','$duration',0,'$exp')");
                        if($query_success) {
                            $query_update = mysqli_query($conn, "UPDATE managers SET projects_count=projects_count+1 WHERE email='$manager_email'");
                            $_SESSION['success'] = "Project added successfully";
                        }
                        else {
                            $_SESSION['error'] = "Failed to add Project";
                        }
                    }
                    else {
                        $_SESSION['error'] = "Project failed to upload. No Expert Manager available to assign this project";
                    }
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
              setTimeout(()=>{ window.location.href='add_projects.php'; },5000);
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
              setTimeout(()=>{ window.location.href='add_projects.php'; },3000);
              </script>";
			unset($_SESSION['success']);
		}
  	?>
</body>
</html>