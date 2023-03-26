<?php
session_start();
ob_start();
include '../manager/conn.php';
unset($_SESSION['userid']);
unset($_SESSION['managerid']);
if(!isset($_SESSION['ufile']))
{
    $_SESSION['error'] = "Please upload the file first";
    header("Location: upload.php");
    exit();
}
if(!(isset($_SESSION['adminid']) && isset($_SESSION['email'])))
{
    header('location:../signin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../manager/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Authentication</title>
    <style>
body
{
    margin:0; 
    padding:0;
    background: #202124;
    /* background: white; */
    font-family: Arial, Helvetica, sans-serif;
}

.container
{
    height: 200px;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.progress-bar {
    color: white;
}
    </style>
</head>
<body onload="render()">
    <div class="container">
        <center>
        <h2 style="text-align:center; color: white;">Updating File data to Database</h2><br/>
        <h4 style="text-align:center; color: white;">Don't Close the tab or else You will lose the data</h4><br/>
        <div class="progress" style="height: 25px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="progressbar" role="progressbar" style="width: 0%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><b>0%</b></div>
        </div>
        <h3 id="information" style="color: white;"> Setting up ...</h3>
        <div id="set-back"></div>
        </center>
        <iframe id="loadarea" style="display:none;"></iframe><br/>
    </div>
</body>
<script>
window.onload = function() {
document.getElementById('loadarea').src = 'file-processing1.php';
}
function render() {
  $(window).on('beforeunload', function(){
var c=confirm();
if(c){
  return true;
}
else
return false;
});
}
</script>
</html>