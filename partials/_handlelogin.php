<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '_dbconnect.php';
        $email = $_POST['loginEmail'];
        $pass = $_POST['loginpassword'];
        $th_uid = $row['thread_user_id']; 

        $sql = "SELECT * FROM users WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email;
                $_SESSION['sno'] = $row['user_sno'];
                echo "logged in ".$email;
            } 
            header("Location: /forum/index.php");
        }   
    }

?>