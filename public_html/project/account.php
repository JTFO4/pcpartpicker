<?php
$GLOBALS['errExists'] = "";
$GLOBALS['errEmail'] = "";
$GLOBALS['errFirstName'] = "";
$GLOBALS['errLastName'] = "";
$GLOBALS['errPass'] = "";
$GLOBALS['errString'] = "";
$GLOBALS['didSuccess'] = 0;

class Account 
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $password2;

    public function __construct($em, $pass, $fn = null, $ln = null, $pass2 = null)
    {   
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->email = $em;
        $this->password = $pass;
        $this->password2 = $pass2;
    }
        
    public function registerUser()
    {
        $this->email = $this->sanitizeString($this->email);
        $this->password = $this->sanitizeString($this->password);
        $this->password2 = $this->sanitizeString($this->password2);
        $this->firstName = $this->sanitizeString($this->firstName);
        $this->lastName = $this->sanitizeString($this->lastName);

        $didEmail = 0;
        $didFistName = 0;
        $didLastName = 0;

        if(preg_match('/^[a-zA-Z0-9_]+@[a-z]+\.[a-zA-Z0-9]+$/' , $this->email))
        {
            $didEmail = 1;
        }
        else
        {
            $GLOBALS['errEmail'] = "Please enter a valid email address. (xxxxxx@xxxx.xxx)";
        }

        if(preg_match('/^[A-Z][a-zA-Z]+$/' , $this->firstName))
        {
            $didFirstName = 1;
        }
        else
        {
            $GLOBALS['errFirstName'] = "Please enter a valid first name. (Xxxxx)";
        }
        if(preg_match('/^[A-Z][a-zA-Z]+$/' , $this->lastName))
        {
            $didLastName = 1;
        }
        else
        {
            $GLOBALS['errLastName'] = "Please enter a valid last name. (Xxxxx)";
        }

        if ($didEmail == 1 && $didFirstName == 1 && $didLastName == 1)
        {
            require_once 'loginInfo.php';
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error)
                die($conn->connect_error);

            $query = "SELECT * FROM member WHERE email = '$this->email'";
            $result = $conn->query($query);

            if ($result->num_rows)
            {
                $GLOBALS['errExists'] = "E-mail currently exists, please use a different e-mail or login.";   
            }

            else
            {
                if ($this->password != $this->password2)
                {
                    $GLOBALS['errPass'] = "Passwords must match.";   
                }

                else
                {
                    $salt1 = "allthoseflavors";
                    $salt2 = "andyouchosetobesalty";

                    $dbPass = hash('ripemd128', "$salt1$this->password$salt2");

                    $insertQuery = "INSERT INTO member (email, password, isAdmin) VALUES ('$this->email', '$dbPass', '0')";
                    $conn->query($insertQuery);

                    $insertQuery = "INSERT INTO account (firstName, lastName, email, hasCheckedOut, passwordReset) VALUES ('$this->firstName', '$this->lastName', '$this->email', '0', '0')";
                    $conn->query($insertQuery);

                    $GLOBALS['didSuccess'] = 1;
                }
            }
        }
    }
    

    public function loginUser()
    {
            $didEmail = 0;
            if(preg_match('/^[a-zA-Z0-9_]+@[a-z]+\.[a-zA-Z0-9]+$/' , $this->email))
            {
                $didEmail = 1;
            }
            else
            {
                $GLOBALS['errEmail'] = "Please enter a valid email address. (xxxxxx@xxxx.xxx)";
            }

            if ($didEmail)
            {
                require_once 'loginInfo.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                    if ($conn->connect_error)
                        die($conn->connect_error);

                $query = "SELECT * FROM member WHERE email = '$this->email'";
                $result = $conn->query($query);

                $salt1 = "allthoseflavors";
                $salt2 = "andyouchosetobesalty";
    
                $row = $result->fetch_array();

                if ($row['password'] == hash('ripemd128', "$salt1$this->password$salt2"))
                {

                    $GLOBALS['didSuccess'] = 1; 
                    $GLOBALS['email'] = $this->email;

                    session_start();
                    $_SESSION['email'] = $this->email;
                }

                else
                {
                    $GLOBALS['errPass'] = "Email/password is incorrect.";
                }


            }
    }

    public function sanitizeString($var)
    {
        $var = stripslashes($var);
        $var = strip_tags($var, '<br>');
        $var = htmlentities($var);
        $var = trim($var);
        $var = rtrim($var);
        $var = htmlspecialchars($var);
        $var = str_replace('<br>','', $var);

        return $var;
    } 
}?>