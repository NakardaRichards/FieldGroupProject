<?php

if (!isset($_SESSION)) {
    session_start();
}








class Users
{

    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $database   = "cread2";
    public  $con;


    public function
    __construct()
    {


        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_errno());
        } else {

            return $this->con;
        }
    }


    public function signupData($post)
    {
        $fname = $this->con->real_escape_string($_POST['fname']);
        $lname = $this->con->real_escape_string($_POST['lname']);
        $email = $this->con->real_escape_string($_POST['email']);
        $password = $this->con->real_escape_string($_POST['pass']);

        $query = "INSERT INTO users(fname,lname,email,pass) VALUES('$fname','$lname','$email','$password')";
        $sql = $this->con->query($query);

        $showQuery = "SELECT * FROM users WHERE email ='$email' && pass ='$password'";
        $newsql = $this->con->query($showQuery);
        $row = $newsql->fetch_assoc();

        if ($sql == true) {
            $_SESSION['username'] = $fname;



            // header("Location:../dashboard/dashboard.php");
            header("Location:diagnostics.php");
            
        } else {
            echo "Failed to signup!";
        }
    }


    public function loginData($post)
    {

        $email = $this->con->real_escape_string($_POST['email']);

        $password = $this->con->real_escape_string($_POST['pass']);

        $query = "SELECT * FROM users WHERE email ='$email' && pass ='$password'";



        $result = $this->con->query($query);
        $row = $result->fetch_assoc();


        if ($result->num_rows > 0) {

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['fname'] . " " . $row['lname'];
            $_SESSION['class'] = $row['class'];
            header("Location:../dashboard/dashboard.php");
        } else {
            echo "Login failed!";
        }
    }
}