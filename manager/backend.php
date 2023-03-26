<?php 
session_start();
include './conn.php';
$file = $_SESSION['ufile'];
$row = 0;
if (($handle = fopen("./uploads/files/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $row++;
    }
    fclose($handle);
}
$row = $row - 1;

$query = mysqli_query($conn,"SELECT COUNT(*) as total FROM clients");
$row1 = mysqli_fetch_assoc($query);
$initial = $row1['total'];

$remaining = $row - $initial;

$data = ($remaining / $row)*100;
$data = 100 - $data;
$data = number_format($data, 1);

$output['message'] = $initial;
$output['total'] = $data;
echo json_encode($output);

?>