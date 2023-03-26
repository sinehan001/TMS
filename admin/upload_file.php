<?php
include '../manager/conn.php';
date_default_timezone_set('Asia/Kolkata');
$date = date('Y/m/d H:i:s A');
session_start();
ob_start();
unset($_SESSION['userid']);
unset($_SESSION['managerid']);
if(!(isset($_SESSION['adminid']) && isset($_SESSION['email'])))
{
    header('location:../signin.php');
}
header('Content-Type: application/json');

$allowed = ['csv'];
$processed = [];
$destFolder = '../manager/uploads/files/';


foreach ($_FILES['files']['name'] as $key => $name) {
    if($_FILES['files']['error'][$key] === 0){

        $temp = $_FILES['files']['tmp_name'][$key];
        $ext = explode('.',$name);
        $ext = strtolower(end($ext));

        $newFile = uniqid('', true) . '_' . time() . '.' . $ext;

        try{

            if(in_array($ext, $allowed)){
                if(move_uploaded_file($temp, $destFolder . $newFile)){
                    $processed[] = array(
                        'name' => $name,
                        'newFile' => $newFile,
                        'destFolder' => $destFolder,
                        'uploaded' => true
                    );
                    $query = "INSERT INTO files (filename, upload_time) VALUES('$newFile','$date')";
                    mysqli_query($conn, $query);
                    $_SESSION['ufile'] = $newFile;
                } else {
                    $processed[] = array(
                        'name' => $name,
                        'error' => 'cant move uploaded file',
                        'uploaded' => false
                    );
                }
            } else {
                $processed[] = array(
                    'name' => $name,
                    'error' => 'file with \'' . $ext . '\' extension is not allowed to upload',
                    'uploaded' => false
                );
            }

        } catch(Exception $e) {

           $processed[] = array(
               'php_error: ' =>  $e->getMessage(),
               'uploaded' => false
           );

        }

    } else {
        $processed[] = array(
            'php_file_uploading_error_number: ' =>  $_FILES['files']['error'][$key],
            'uploaded' => false
        );
    }
}

echo json_encode($processed);