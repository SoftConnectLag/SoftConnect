<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "dummylag");
    extract($_POST);

    if(isset($_POST['username']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `admin_data` where `username`='".$username."' and `password`='".$password."'");
        if(mysqli_num_rows($query) < 1)
        {
            echo "No";
        }
        else
        {
            while($row = mysqli_fetch_row($query))
            {
                $_SESSION['admin_username'] = $row[1];
                echo "Yes";
            }
        }
    }

    if(isset($_POST['subCount']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `subscribers` where `status`='Paid'");
        $p = mysqli_num_rows($query);
        echo $p;
    }

    if(isset($_POST['msgCount']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `sent_msgs`");
        $p = mysqli_num_rows($query);
        echo $p;
    }

    if(isset($_POST['curMsgCount']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `sent_msgs` where `date`='".date('d/m/Y')."'");
        $p = mysqli_num_rows($query);
        echo $p;
    }    

    if(isset($_POST['countbyLevel']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `subscribers` where `status`='Paid' and `level`='".$_POST['countbyLevel']."'");
        $p = mysqli_num_rows($query);
        echo $p;
    }

    if(isset($_POST['countbyDepartment']))
    {
        $query = mysqli_query($connect, "SELECT * FROM `subscribers` where `status`='Paid' and `department`='".$_POST['countbyDepartment']."'");
        $p = mysqli_num_rows($query);
        echo $p;      
    }

    if(isset($_POST['msgtosend']))
    {
        if($filter == "all")
        {
            $query = mysqli_query($connect, "SELECT GROUP_CONCAT(tel_no) FROM `subscribers` where `status`='Paid'");
            while($row = mysqli_fetch_row($query))
            {
                $recipients = $row[0];
            }
        }
        else if($filter == "level")
        {
            $query = mysqli_query($connect, "SELECT GROUP_CONCAT(tel_no) FROM `subscribers` where `status`='Paid' and `level`='".$leveltosend."'");
            while($row = mysqli_fetch_row($query))
            {
                $recipients = $row[0];
            }
        }
        else if($filter == "department")
        {
            $query = mysqli_query($connect, "SELECT GROUP_CONCAT(tel_no) FROM `subscribers` where `status`='Paid' and `department`='".$departmenttosend."'");
            while($row = mysqli_fetch_row($query))
            {
                $recipients = $row[0];
            }            
        }

        require_once('../../AfricasTalkingGateway.php');

        $username   = "sandbox";
        // $apikey     = "127efde78b69cd1e5b160f01e07018c5d3536fdbd434216539672e4d56cea7c5";
        $apikey     = "565b2e9393f2f8743b5804cabc209382c447977c0bbf5164c1de47ff0fb06cf0";
        $message = $_POST['msgtosend'];
        $total = 0;
        $gateway    = new AfricasTalkingGateway($username, $apikey, "sandbox");

        
        try 
        { 
            $results = $gateway->sendMessage($recipients, $message);
                
            foreach($results as $result) {
                $total = $total + 1;
            }

            $postquery = mysqli_query($connect, "INSERT INTO `sent_msgs` VALUES (NULL, '$message', '$total', '".date('d/m/Y')."')");
            if($postquery)
            {
                echo "Yes";
            }
        }
        catch ( AfricasTalkingGatewayException $e )
        {
            echo "Error";
        }            
    }

?>