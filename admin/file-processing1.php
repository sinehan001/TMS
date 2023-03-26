<?php
session_start();

ini_set('max_execution_time', 0);
include '../manager/conn.php';

$row = 1;
$email=[];
$users = [];
$errors=[];
// $opts04 = [ "cost" => 10];
$filename = $_SESSION['ufile'];
$filePath = "../manager/uploads/files/$filename";
$lines = count(file($filePath));
function get_duplicates ($array) {
  return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
}
$query = mysqli_query($conn, "SELECT email FROM `admin`;");
while($row=mysqli_fetch_assoc($query)) {
  array_push($email,$row['email']);
}
$query = mysqli_query($conn, "SELECT email FROM `managers`;");
while($row=mysqli_fetch_assoc($query)) {
  array_push($email,$row['email']);
}
$query = mysqli_query($conn, "SELECT email FROM `staffs`;");
while($row=mysqli_fetch_assoc($query)) {
  array_push($email,$row['email']);
}
$count_loops = 0;
$db_email = count($email);
if (($handle = fopen("../manager/uploads/files/$filename", "r")) !== FALSE) {
  echo '<script>parent.document.getElementById("information").innerHTML=" Initializing file ... ";</script>';
  while (($data = fgetcsv($handle, 0, ",","\"")) !== FALSE) {
    if(!in_array($data[3],$email)) {
      array_push($email, $data[3]);
      array_push($users,array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8]));
    }
  }
  fclose($handle);
}
$total_email = count($email);
$total = count($users);
$start_time = microtime(true);
$checking_process = 0;
$message = '';
for($i=0;$i<$total;$i++)
{
    $information_progress = intval($i/$total * 100);   
	
    // sleep(1);
    // usleep( 1000 );
    $name = $users[$i][0];
    $address = $users[$i][1];
    // $hashp04 = password_hash($users[$i][4], PASSWORD_BCRYPT, $opts04);
    $password = hash("sha256",$users[$i][4]);
    $email = $users[$i][3];
    $phone = $users[$i][2];
    $image = 'client.svg';
    $experience = $users[$i][5];
    $designation = $users[$i][6];
    $projects_count = (int)$users[$i][7];
    $completed_projects = (int)$users[$i][8];
    try {
      mysqli_query($conn,"INSERT INTO managers (name, address, password, email, phone, image, exp, designation, completed_projects, projects_count) VALUES ('$name','$address','$password','$email','$phone','$image','$experience','$designation',$completed_projects,$projects_count)");
    }
    catch(Exception $e) {
      $checking_process = 1;
      break;
    }

    echo '<script>
        parent.document.getElementById("progressbar").innerHTML="'.$information_progress.'%";
        parent.document.getElementById("progressbar").style.width="'.$information_progress.'%";
        parent.document.getElementById("information").innerHTML=" Uploading '.$information_progress.'%";</script>';

    ob_flush(); 
    flush(); 
}
$end_time = microtime(true);
$total_time = $end_time - $start_time;
$count_emails = $total_email - $db_email;
$not_updated = $lines - $count_emails;
if($checking_process==0) {
echo '<script>parent.document.getElementById("progressbar").innerHTML="100%";
      parent.document.getElementById("progressbar").style.width="100%";
      parent.document.getElementById("information").innerHTML=" File Uploaded Successfully in '.round($total_time, 0).' seconds.<br>'.$count_emails.' Staffs Updated.<br>'.$not_updated.' Staffs not Updated.";
      parent.document.getElementById("set-back").innerHTML=\'<a href="add_managers.php" class="btn btn-primary">Back</a>\';</script>';
}
else {
  echo '<>
  parent.document.getElementById("progressbar").innerHTML="0%";
  parent.document.getElementById("progressbar").style.width="0%";
  parent.document.getElementById("information").innerHTML=" Failed to Upload file !";
  parent.document.getElementById("set-back").innerHTML=\'<a href="add_managers.php" class="btn btn-primary">Back</a>\';</script>';
}
?>