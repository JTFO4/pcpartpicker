<?php
$GLOBALS['errExists'] = "";
$GLOBALS['errEmail'] = "";
$GLOBALS['errFirstName'] = "";
$GLOBALS['errLastName'] = "";
$GLOBALS['errPass'] = "";
$GLOBALS['errString'] = "";
$GLOBALS['didSuccess'] = 0;

class Login 
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $password2;

    public function __construct($em, $pass)
    {
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