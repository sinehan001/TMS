<?php
	include './manager/conn.php';
    date_default_timezone_set("Asia/Kolkata");
    $day = date('l');
    $today = date('Y/m/d');
    if($day != "Sunday") {
        $admin_table = mysqli_query($conn,"SELECT * FROM admin_table WHERE assigned_time = '$today'");
        if(mysqli_num_rows($admin_table) == 0)
        {
        $staffs = mysqli_query($conn, "SELECT * FROM staffs ORDER BY RAND()");
        while($row = mysqli_fetch_assoc($staffs)) {
            $clients = mysqli_query($conn, "SELECT * FROM clients WHERE assign = '0' ORDER BY RAND() LIMIT 20");
            while($col = mysqli_fetch_assoc($clients)) {
                $client = $col['name'];
                $address = $col['address'];
                $email = $col['email'];
                $phone = $col['phone'];
                $staff = $row['name']; 
                $city = $col['city'];
                mysqli_query($conn, "INSERT INTO admin_table (client, address, email, phone, staffs, call_status, whatsapp_status, email_status, assigned_time, city, updated_time, status) VALUES ('$client','$address', '$email', '$phone', '$staff', '0', '0', '0', '$today', '$city','None', 'none')");
                mysqli_query($conn, "UPDATE clients SET assign = '1' WHERE address = '$address'");
                }
            }
            echo "Successfully assigned";
        }
        else {
            echo "Nothing to Assign today";
        }
    }
?>