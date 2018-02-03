<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "dummylag");
    extract($_POST);
    $d1 = date('Y');
    $d2 = date('Y')+1;
    $academic_session = $d1 ."/". $d2;
    
    if(isset($_POST['reg_no']))
    {
        $_SESSION['rn'] = $_POST['reg_no'];
        $query = mysqli_query($connect, "SELECT * FROM `student_info` where `matric_no`='$reg_no'");
        if(mysqli_num_rows($query) < 1)
        {
            echo 'Missing';
            unset($_SESSION['rn']);
        }
        else
        {
            while($row = mysqli_fetch_row($query))
            {
                $output = "<h3 class='text-center text-black'><b>Verify this is you.</b></h3><br>";
                $output .= "Full Name: " .$row[2] ."<br>";
                $output .= "Matric No: " .$row[1] ."<br>";
                $output .= "Mobile Number: " .$row[3] ."<br>";
                $output .= "Department: " .$row[4] ."<br>";
                echo $output;
            }
        }
    }

    if(isset($_POST['std_lev']))
    {
        $prequery = mysqli_query($connect, "SELECT * FROM `subscribers` where `matric_no`='".$_SESSION['rn']."' and `session`='$academic_session' and `status`='Paid'");
        if(mysqli_num_rows($prequery) > 0)
        {
            echo "Exists";
        }
        else
        {
            $pquery = mysqli_query($connect, "SELECT * FROM `student_info` where `matric_no`='".$_SESSION['rn']."'");
            while($prerow = mysqli_fetch_row($pquery))
            {
                $q2 = $prerow['2'];
                $q3 = $prerow['3'];
                $q4 = $prerow['4'];
                $q5 = $prerow['5'];

                $q3 = substr($q3, 1);
                $q3 = "+234" .$q3;
            }    
            $qq = mysqli_query($connect, "SELECT * FROM `subscribers` where `matric_no`='".$_SESSION['rn']."' and `session`='$academic_session'");
            if(mysqli_num_rows($qq) > 0)
            {
                echo "Unpaid";
            }
            else
            {
                $query = mysqli_query($connect, "INSERT INTO `subscribers` VALUES (NULL, '".$_SESSION['rn']."', '$q2', '$q3', '$q5', '$q4', '".$_POST['std_lev']."', '$academic_session', 'Pending', '".date('d/m/Y')."')"); 
                if($query)
                {
                    echo "Yes";
                }              
                else
                {
                    echo "No";
                }
            }          
        }
    }

    if(isset($_POST['checkEmail']))
    {
        $query = mysqli_query($connect, "SELECT `email_address` FROM `student_info` where `matric_no`='".$_SESSION['rn']."'");
        while($row = mysqli_fetch_row($query))
        {
            $output = $row[0];
            echo $output;
        }
    }

    if(isset($_POST['checkMatric']))
    {
        $output = $_SESSION['rn'];
        echo $output;
    }

    if(isset($_POST['updatePayment']))
    {
        $pquery = mysqli_query($connect, "SELECT * FROM `subscribers` where `matric_no`='".$_SESSION['rn']."'");
            while($prerow = mysqli_fetch_row($pquery))
            {
                $q1 = $prerow['3'];
                $q2 = $prerow['2'];
            }

        $query = mysqli_query($connect, "UPDATE `subscribers` set `status`='Paid', `level`='".$_POST['lvl']."', `date`='".date('d/m/Y')."' where `matric_no`='".$_SESSION['rn']."' order by id DESC LIMIT 1");
        if($query)
        {
            echo "Yes";
            // unset($_SESSION['rn']);

            require_once('../AfricasTalkingGateway.php');

            $username   = "LhamiCodes";
            $apikey     = "127efde78b69cd1e5b160f01e07018c5d3536fdbd434216539672e4d56cea7c5";
            $recipients = $q1;
            $message = "Dear " . $q2. ", You have Successfully Subscribed For LagMobile Services for the " .$academic_session. " Session.\n\nDSA UNILAG.";

            $gateway    = new AfricasTalkingGateway($username, $apikey);

            
            try 
            { 
                $results = $gateway->sendMessage($recipients, $message);
                    
                foreach($results as $result) {
                // status is either "Success" or "error message"
                }
            }
            catch ( AfricasTalkingGatewayException $e )
            {
                // echo "Encountered an error while sending: ".$e->getMessage();
            }            
        }
        else
        {
            echo "No";
        }
    }
?>