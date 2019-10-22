<?php
$GLOBALS['errExists'] = "";
$GLOBALS['errEmail'] = "";
$GLOBALS['errFirstName'] = "";
$GLOBALS['errLastName'] = "";
$GLOBALS['errAddr1'] = "";
$GLOBALS['errAddr2'] = "";
$GLOBALS['errCity'] = "";
$GLOBALS['errState'] = "";
$GLOBALS['errZip'] = "";
$GLOBALS['errCC'] = "";
$GLOBALS['errDebug'] = "";

class Member {
    public $firstName;
    private $lastName;
    private $email;
    private $addr1;
    private $addr2;
    private $city;
    private $state;
    private $zip;
    private $isLoggedIn;
    public $isAdmin;
    private $conn;

    public function __construct($email)
    {
        require_once 'loginInfo.php';
        $this->conn = new mysqli($hn, $un, $pw, $db);
        if ($this->conn->connect_error)
            die($this->conn->connect_error);

        $query = "SELECT * FROM account WHERE email = '$email'";
        $result = $this->conn->query($query);
        echo $email;
        $row = $result->fetch_array();

        echo "WE MADE IT FROM IN HERE";
        echo $row['firstName'];
        echo $row['lastName'];
        echo $row['city'];
        echo $row['email'];
        echo $row['state'];
        echo $row['lastName'];
        
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->email = $row['email'];
        $this->addr1 = $row['address1'];
        $this->addr2 = $row['address2'];
        $this->city = $row['city'];
        $this->state = $row['state'];
        $this->zip = $row['zip'];
        $this->isLoggedIn = 1;

        $adminQuery = "SELECT * FROM member WHERE email = '$email'";
        $result = $this->conn->query($adminQuery);
        $row = $result->fetch_array();
        $this->isAdmin = $row['isAdmin'];
    }  

    // FINISHED
    public function updateShippingInformation($fname, $lname, $addr1, $addr2, $city, $state, $zip)
    {
        if ($this->isLoggedIn)
        {
            $didFirstName = 0;
            $didLastName = 0;
            $didAddr1 = 0;
            $didAddr2 = 0;
            $didCity = 0;
            $didState = 0;
            $didZip = 0;

            $tempfName = $this->sanitizeString($fname);
            if (!empty($tempfName) && preg_match('/^[A-Z][a-z]+$/' , $tempfName))
            { 
                $this->firstName = $tempfName;
                $updateFName = "UPDATE account SET firstName = '$this->firstName' WHERE email = '$this->email'";
                $this->conn->query($updateFName);
                $didFirstName = 1;
            }
            else
            {
                $GLOBALS['errFirstName'] = "Please enter a valid first name. (Xxxxx)";
            }

            $templName = $this->sanitizeString($lname);
            if (!empty($templName) && preg_match('/^[A-Z][a-z]+$/' , $templName))
            { 
                $this->lastName = $templName;
                $updateLName = "UPDATE account SET lastName = '$this->lastName' WHERE email = '$this->email'";
                $this->conn->query($updateLName);
                $didLastName = 1;
            }
            else
            {
                $GLOBALS['errLastName'] = "Please enter a valid last name. (Xxxxx)";
            }

            $tempAddr1 = $this->sanitizeString($addr1);
            if (!empty($tempAddr1) && preg_match('/^[0-9]+[a-zA-Z0-9\.\#\- ]+$/' , $tempAddr1))
            { 
                $this->addr1 = $tempAddr1;
                $updateAddr1 = "UPDATE account SET address1 = '$this->addr1' WHERE email = '$this->email'";
                $this->conn->query($updateAddr1);
                $didAddr1 = 1;
            }
            else
            {
                $GLOBALS['errAddr1'] = "Please enter a valid address.";
            }

            $tempAddr2 = $this->sanitizeString($addr2);
            if (!empty($tempAddr2) && preg_match('/^[A-Z][a-zA-Z0-9\.\#\- ]+$/' , $tempAddr2) )
            { 
                $this->addr2 = $tempAddr2;
                $updateAddr2 = "UPDATE account SET address2 = '$this->addr2' WHERE email = '$this->email'";
                $this->conn->query($updateAddr2);
                $didAddr2 = 1;
            }
            else
            {
                $GLOBALS['errAddr2'] = "Please enter a valid address.";
            }
            
            $tempCity = $this->sanitizeString($city);
            if (!empty($tempCity) && preg_match('/^[A-Z][a-zA-Z ]+$/' , $tempCity))
            { 
                $this->city = $tempCity;
                $updateCity = "UPDATE account SET city = '$this->city' WHERE email = '$this->email'";
                $this->conn->query($updateCity);
                $didCity = 1;
            }
            else
            {
                $GLOBALS['errCity'] = "Please enter a valid city.";
            }

           $tempState = $this->sanitizeString($state);
           if (!empty($tempState) && preg_match('/^[A-Z][A-Z]$/' , $tempState))
            { 
               $this->state = $tempState;
               $updateState = "UPDATE account SET state = '$this->state' WHERE email = '$this->email'";
               $this->conn->query($updateState);
               $didState = 1;
           }
           else
           {
                $GLOBALS['errState'] = "Please enter a valid state format (XX).";
           }

           $tempZip = $this->sanitizeString($zip);
            if (!empty($tempZip) && preg_match('/^[0-9][0-9][0-9][0-9][0-9]$/' , $tempZip))
            { 
                $this->zip = $tempZip;
                $updateZip = "UPDATE account SET zip = '$this->zip' WHERE email = '$this->email'";
                $this->conn->query($updateZip);
                $didZip = 1;
            }
            else
            {
                 $GLOBALS['errZip'] = "Please enter a valid zip code format (XXXXX).";
            }
        }
        else
        {
            $GLOBALS['errDebug'] = "NOT LOGGED IN WHAT HELP GOD ITS BROKEN";
        }

    } 

    // TO BE FIXED LATER DAWG
    public function updateEmail()
    {
        if ($this->isLoggedIn)
        {
            $tempEmail = $this->sanitizeString($_POST['email']);
            if (!empty($tempEmail) && preg_match('/^[a-zA-Z0-9_]+@[a-z]+\.[a-zA-Z0-9]+$/' , $tempEmail))
            { 
                $query = "SELECT * FROM member WHERE email = '$tempEmail'";
                $result = $this->conn->query($query);

                if ($tempEmail === $this->email)
                {
                    $GLOBALS['errEmail'] = "This is your current email address. If you wish to update your account choose a different email.";
                }
                elseif ($result->num_rows)
                {
                    $GLOBALS['errExists'] = "E-mail currently exists, please use a different e-mail or login.";   
                }
                else
                {
                $updateEmailAccount = "UPDATE account SET email = '$tempEmail' WHERE email = '$this->email'";
                $this->conn->query($updateEmailAccount);

                $updateEmailMember = "UPDATE member SET email = '$tempEmail' WHERE email = '$this->email'";
                $this->conn->query($updateEmailMember);

                $this->email = $tempEmail;
                $didEmail = 1;
                }
            }
            else
            {
            $GLOBALS['errEmail'] = "Please enter a valid email address. (xxxxxx@xxxx.xxx)";
            }
        }
        else
        {
            $GLOBALS['errDebug'] = "NOT LOGGED IN WHAT HELP GOD ITS BROKEN";
        }
    }

    // FINISHED
    public function updateCC($cc)
    {
        if ($this->isLoggedIn)
        {
            $tempCC = $this->sanitizeString($cc);
            if (!empty($tempCC) && preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/' , $tempCC))
            { 
                $salt1 = "allyourbase";
                $salt2 = "arebelongtous";

                $dbCC = hash('ripemd128', "$salt1$tempCC$salt2");

                $insertQuery = "UPDATE account SET creditCard = '$dbCC' WHERE email = '$this->email'";
                $this->conn->query($insertQuery);
            }
            else
            {
                $GLOBALS['errCC'] = "Please enter a valid credit card. (16 digit no spaces).";
            }
        }

        else
        {
            $GLOBALS['errDebug'] = "NOT LOGGED IN WHAT HELP GOD ITS BROKEN";
        }
    }

    public function addToWishlist()
    {
        // Ensure isLoggedIn
        // Ensure isSet_POST
        // Fetch SKU From Page
        // Write DB Query
        // Update DB
    }

    public function removeFromWishList()
    {
        // Ensure isLoggedIn
        // Ensure isSet_POST

        // RESOLVE ISSUE OF IDENTIFYING WHICH SKU IS ASSOCIATED WITH WHAT BUTTON

        // Write DB Query
        // Update DB
    }

    public function sanitizeString($var)
    {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = trim($var);
        //$var = rtrim($var);
        //$var = htmlspecialchars($var);
        //$var =str_replace('<br>','', $var);

        return $var;
    } 

    public function getIsLoggedIn()
    {
        return $this->isLoggedIn;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

}

class Admin extends Member
{
    public function __construct($email)
    {
            Member::__construct($email);
    }

    public function resetMemberPassword()
    {
        // Ensure isLoggedIn && isAdmin
        // Ensure isSet_POST -> email
        // Write SQL Query
        // Flag passwordReset to TRUE


    }

    // FINISHED
    public function adjustQuantity($SKU, $quantAmnt, $quantOp)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $tempAmnt = $this->sanitizeString($quantAmnt);
            if (!empty($tempAmnt) && preg_match('/^[0-9]+$/' , $tempAmnt)) 
            {
                if ($quantOp == '+')
                {
                    $adminQuery = "SELECT * FROM items WHERE SKU = '$SKU'";
                    $result = $this->conn->query($adminQuery);
                    $row = $result->fetch_array();

                    $currAmt = $row['stockQuantity'] + $quantAmnt;
                    $updateQuantity = "UPDATE items SET stockQuantity = '$currAmt' WHERE SKU = '$SKU'";
                    $this->conn->query($updateQuantity);
                }

                else if ($quantOp == '-')
                {
                    $adminQuery = "SELECT * FROM items WHERE SKU = '$SKU'";
                    $result = $this->conn->query($adminQuery);
                    $row = $result->fetch_array();

                    $currAmt = $row['stockQuantity'] - $quantAmnt;
                    $updateQuantity = "UPDATE items SET stockQuantity = '$currAmt' WHERE SKU = '$SKU'";
                    $this->conn->query($updateQuantity);
                }    
                else
                {
                    echo "hello from only sadness";
                }
            }

            else
            {
                echo "Please enter an amount to change the quantity by."; 
            }   
        }
        else
        {
            echo "GOD SAVE US AND THE QUEEN!";
        }
    }

    // FINISHED
    public function addItem($sku, $itemcat, $itemname, $msrp)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $didSku = 0;
            $didICat = 0;
            $didIName = 0;
            $didMSRP = 0;

            $tempSKU = $this->sanitizeString($sku);
            if (!empty($tempSKU) && preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/' , $tempSKU))
            {
                $didSku = 1;
            }

            $tempICat = $this->sanitizeString($itemcat);
            if(!empty($tempICat) && preg_match('/^[A-Z][a-zA-Z]+$/' , $tempICat))
            {
                $didICat = 1;
            }

            $tempIName = $this->sanitizeString($itemname);
            if(!empty($tempIName) && preg_match('/^[0-9a-zA-Z #$()-.\/_": ]+[0-9a-zA-Z #$()-._":\/ ]*$/' , $tempIName))
            {
                $didIName = 1;
            }

            $tempMSRP = $this->sanitizeString($msrp);
            if(!empty($tempMSRP) && preg_match('/^[0-9]+[.][0-9]*$/' , $tempMSRP))
            {
                $didMSRP = 1;
            }

            if ($didSku && $didICat && $didIName && $didMSRP)
            {
                $insertQuery = "INSERT INTO items (SKU, itemCategory, itemName, itemPrice) VALUES ('$tempSKU', '$tempICat', '$tempIName', '$tempMSRP')";
                $this->conn->query($insertQuery);
            }
        }
    }

    // FINISHED
    public function removeItem($sku)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $tempSKU = $this->sanitizeString($sku);
            if (!empty($tempSKU) && preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/' , $tempSKU))
            {
                $updateQuantity = "UPDATE items SET stockQuantity = '0' WHERE SKU = '$sku'";
                $this->conn->query($updateQuantity);
            }
        }
    }

    // FINISHED
    public function adjustItemPrice($sku, $price)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $tempAmnt = $this->sanitizeString($price);
            if (!empty($tempAmnt) && preg_match('/^[0-9]+[.][0-9]*$/' , $tempAmnt)) 
            {
                $updatePrice = "UPDATE items SET salePrice = '$tempAmnt' WHERE SKU = '$sku'";
                $this->conn->query($updatePrice); 
            }
        }
    }

    public function generateSalesReport()
    {
        // Ensure isLoggedIn && isAdmin
        // isset_POST -> generateSalesSubmit
        // Write DB Query -> Sold Table -- DATE RANGE IMPLEMENTATION TBD
        // Output to SALES_REPORT.txt
    }
    
}?>