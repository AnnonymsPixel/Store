<?php

include 'connect.php';
header('Content-Type: application/json');

//signup

if(isset($_POST['SignUp']))
{
    
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

     $checkemail = "SELECT * From users where email= '$email'";
     $result = $conn->query($checkemail);
     if($result->num_rows>0){
        echo "Email Already Exists!!";
    }

    else
    {
        $insertquery = "INSERT INTO users(firstName, lastName, email, password) 
                         VALUES ('$firstName', '$lastName', '$email', '$password')";
            if($conn->query($insertquery) == TRUE) 
            {
                header("location: index.php");
            }

            else 
            {   
                echo 'Error:'.$conn->error;
            }
    }
}

// signin

if(isset($_POST['SignIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if($result && $result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("location: index.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password.";
    }
}

//phone no.

if(isset($_POST['Update Settings'])) 
{
    $Adress = $_POST['Address'];
    $Phone = $_POST['Phone Number'];

    $checkPhone = "SELECT * FROM users where Phone = '$Phone'";
    $result = $conn->query($checkPhone);
    if ($result-> num_rows>0)
    {
        echo 'Phone Number Exists';
    }

    else
    {
        $insertquery = "INSERT INTO users(Address, Phone)
            VALUES('$Address', '$Phone')";
            
        if($conn->query($insertquery) == TRUE)
        {
            echo 'Update Sucess';
            exit();
        }
        else
        {
            echo 'Error'.$conn->error;
        }
    }
}


/*end of the login code*/

?>