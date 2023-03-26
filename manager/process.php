<?php
session_start();
ob_start();
// include 'conn.php';
// unset($_SESSION['userid']);
// if(!isset($_SESSION['ufile']))
// {
//     $_SESSION['error'] = "Please upload the file first";
//     header("Location: upload.php");
//     exit();
// }
// if(!(isset($_SESSION['managerid']) && isset($_SESSION['email'])))
// {
//     header('location:../signin.php');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

.container {
    height:50px;
    width:40px;
    position:absolute;
    left:0;
    right:0;
    top:0;
    bottom:0;
    margin:auto;
}
.container::after {
    content:'Sending Data';
    color:#007298;
    font-weight:700;
    width: 93px;
    position:absolute;
    bottom:-50px;
    left:-10px;
}
.box {
    position:relative;
    height:50px;
    width:40px;
    animation: box 5s infinite linear;
}

.border {
    background:#007298;
    position:absolute;
}

.border.one {
    height:4px;
    top:0;
    left:0;
    animation: border-one 5s infinite linear;
}

.border.two {
    top:0;
    right:0;
    height:100%;
    width:4px;
    animation: border-two 5s infinite linear;
}

.border.three {
    bottom:0;
    right:0;
    height:4px;
    width:100%;
    animation: border-three 5s infinite linear;
}

.border.four {
    bottom:0;
    left:0;
    height:100%;
    width:4px;
    animation: border-four 5s infinite linear;
}

.line {
    height:4px;
    background:#007298;
    position:absolute;
    width:0%;
    left:25%;
}

.line.one {
    top:25%;
    width:0%;
    animation: line-one 5s infinite linear;
}

.line.two {
    top:45%;
    animation: line-two 5s infinite linear;
}

.line.three {
    top:65%;
    animation: line-three 5s infinite linear;
}

@keyframes border-one {
    0%   {width:0;}
    10%  {width:100%;}
    100% {width:100%;}
}

@keyframes border-two {
    0%   {height:0;}
    10%  {height:0%;}
    20%  {height:100%;}
    100% {height:100%;}
}

@keyframes border-three {
    0%   {width:0;}
    20%  {width:0%;}
    30%  {width:100%;}
    100% {width:100%;}
}

@keyframes border-four {
    0%   {height:0;}
    30%  {height:0%;}
    40%  {height:100%;}
    100% {height:100%;}
}

@keyframes line-one {
    0%   {left:25%;width:0;}
    40%  {left:25%;width:0%;}
    43%  {left:25%;width:50%;}
    52%  {left:25%;width:50%;}
    54%  {left:25%;width:0% }
    55%  {right:25%;left:auto;}
    63%  {width:10%;right:25%;left:auto;}
    100% {width:10%;right:25%;left:auto;}
}

@keyframes line-two {
    0%   {width:0;}
    42%  {width:0%;}
    45%  {width:50%;}
    53%  {width:50%;}
    54%  {width:0% }
    60%  {width:50%}
    100% {width:50%;}
}

@keyframes line-three {
    0%   {width:0;}
    45%  {width:0%;}
    48%  {width:50%;}
    51%  {width:50%;}
    52%  {width:0% }
    100% {width:0%;}
}

@keyframes box {
    0%   {opacity:1;margin-left:0px;height:50px;width:40px;}
    55%  {margin-left:0px;height:50px;width:40px;}
    60%  {margin-left:0px;height:35px;width:50px;}
    74%  {msthin-left:0;}
    80%  {margin-left:-50px;opacity:1;}
    90% {height:35px;width:50px;margin-left:50px;opacity:0;}
    100% {opacity:0;}
}
    </style>
</head>
<body onload="render()">
    <h2 style="text-align:center; color: white;">Updating File data to Database</h2><br/>
    <h4 style="text-align:center; color: white;">Don't Close the tab or else You will lose the data</h4>
    <div class="container">
    <div class="box">
        <div class="border one"></div>
        <div class="border two"></div>
        <div class="border three"></div>
        <div class="border four"></div>

        <div class="line one"></div>
        <div class="line two"></div>
        <div class="line three"></div>
    </div>
</div>
</body>
<script>
//   window.location.href="files.php";
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