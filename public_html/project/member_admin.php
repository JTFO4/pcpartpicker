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
$GLOBALS['errSKU'] = "";
$GLOBALS['errOldPass'] = "";
$GLOBALS['errNewPass'] = "";
$GLOBALS['didPassReset'] = "";
$GLOBALS['passResetMsg'] = "";

class Member {
    private $firstName;
    private $lastName;
    private $email;
    private $addr1;
    private $addr2;
    private $city;
    private $state;
    private $zip;
    private $isLoggedIn;
    private $isAdmin;
    private $conn;

    public function __construct($email)
    {
        require_once('loginInfo.php');
        $this->conn = new mysqli($hn, $un, $pw, $db);
        if ($this->conn->connect_error)
            die($this->conn->connect_error);

        $query = "SELECT * FROM account WHERE email = '$email'";
        $result = $this->conn->query($query);

        $row = $result->fetch_array();
        
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

        session_start();
        $_SESSION['firstName'] = $this->firstName;
        $_SESSION['lastName'] = $this->lastName;
        $_SESSION['addr1'] = $this->addr1;
        $_SESSION['addr2'] = $this->addr2;
        $_SESSION['city'] = $this->city;
        $_SESSION['state'] = $this->state;
        $_SESSION['zip'] = $this->zip;
        $_SESSION['isLoggedIn'] = $this->isLoggedIn;
        $_SESSION['isAdmin'] = $this->isAdmin;
        $_SESSION['conn'] = $this->conn;
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

            if (empty($tempfName))
            {
                $GLOBALS['errFirstName'] = "";
            }
            else if (!empty($tempfName) && preg_match('/^[A-Z][a-z]+$/' , $tempfName))
            { 
                $this->firstName = $tempfName;
                $updateFName = "UPDATE account SET firstName = '$this->firstName' WHERE email = '$this->email'";
                $this->conn->query($updateFName);
                $didFirstName = 1;
                $_SESSION['firstName'] = $this->firstName;
            }
            else
            {
                $GLOBALS['errFirstName'] = "Please enter a valid first name. (Xxxxx)";
            }

            $templName = $this->sanitizeString($lname);

            if (empty($templName))
            {
                $GLOBALS['errLastName'] = "";
            }
            else if (!empty($templName) && preg_match('/^[A-Z][a-z]+$/' , $templName))
            { 
                $this->lastName = $templName;
                $updateLName = "UPDATE account SET lastName = '$this->lastName' WHERE email = '$this->email'";
                $this->conn->query($updateLName);
                $didLastName = 1;
                $_SESSION['lastName'] = $this->lastName;
            }
            else
            {
                $GLOBALS['errLastName'] = "Please enter a valid last name. (Xxxxx)";
            }
            
            $tempAddr1 = $this->sanitizeString($addr1);
            if (empty($tempaddr1))
            {
                //$GLOBALS['errAddr1'] = "";
                $this->addr1 = $tempAddr1;
                $updateAddr1 = "UPDATE account SET address1 = '$this->addr1' WHERE email = '$this->email'";
                $this->conn->query($updateAddr1);
                $didAddr1 = 1;
                $_SESSION['addr1'] = $this->addr1;
            }
            else if (!empty($tempAddr1) && preg_match('/^[0-9]+[a-zA-Z0-9\.\#\- ]+$/' , $tempAddr1))
            { 
                $this->addr1 = $tempAddr1;
                $updateAddr1 = "UPDATE account SET address1 = '$this->addr1' WHERE email = '$this->email'";
                $this->conn->query($updateAddr1);
                $didAddr1 = 1;
                $_SESSION['addr1'] = $this->addr1;
            }
            else
            {
                $GLOBALS['errAddr1'] = "Please enter a valid address.";
            }

            $tempAddr2 = $this->sanitizeString($addr2);
            if (empty($tempAddr2))
            {
                $this->addr2 = $tempAddr2;
                $updateAddr2 = "UPDATE account SET address2 = NULL WHERE email = '$this->email'";
                $this->conn->query($updateAddr2);
                $didAddr2 = 1;
                $_SESSION['addr2'] = $this->addr2;
            }
            else if (!empty($tempAddr2) && preg_match('/^[A-Z][a-zA-Z0-9\.\#\- ]*$/' , $tempAddr2))
            { 
                $this->addr2 = $tempAddr2;
                $updateAddr2 = "UPDATE account SET address2 = '$this->addr2' WHERE email = '$this->email'";
                $this->conn->query($updateAddr2);
                $didAddr2 = 1;
                $_SESSION['addr2'] = $this->addr2;
            }
            else
            {
                $GLOBALS['errAddr2'] = "Please enter a valid address.";
            }
            
            $tempCity = $this->sanitizeString($city);

            if (empty($tempCity))
            {
                $GLOBALS['errCity'] = "";
            }
            else if (!empty($tempCity) && preg_match('/^[A-Z][a-zA-Z ]+$/' , $tempCity))
            { 
                $this->city = $tempCity;
                $updateCity = "UPDATE account SET city = '$this->city' WHERE email = '$this->email'";
                $this->conn->query($updateCity);
                $didCity = 1;
                $_SESSION['city'] = $this->city;
            }
            else
            {
                $GLOBALS['errCity'] = "Please enter a valid city.";
            }

           $tempState = $this->sanitizeString($state);
           if (empty($tempState))
           {
            $GLOBALS['errState'] = "";
           }
           else if (!empty($tempState) && preg_match('/^[A-Z][A-Z]$/' , $tempState))
            { 
               $this->state = $tempState;
               $updateState = "UPDATE account SET state = '$this->state' WHERE email = '$this->email'";
               $this->conn->query($updateState);
               $didState = 1;
               $_SESSION['state'] = $this->state;
           }
           else
           {
                $GLOBALS['errState'] = "Please enter a valid state format (XX).";
           }

           $tempZip = $this->sanitizeString($zip);
           if (empty($tempZip))
           {
            $GLOBALS['errZip'] = "";
           }
            else if (!empty($tempZip) && preg_match('/^[0-9][0-9][0-9][0-9][0-9]$/' , $tempZip))
            { 
                $this->zip = $tempZip;
                $updateZip = "UPDATE account SET zip = '$this->zip' WHERE email = '$this->email'";
                $this->conn->query($updateZip);
                $didZip = 1;
                $_SESSION['zip'] = $this->zip;
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

    // FINISHED - NOT ACTUALLY L0L
    public function updateCC($cc, $month, $year, $cvc)
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

    // FINISHED
    public function updatePassword($oldpass, $newpass1, $newpass2)
    {
        if ($this->isLoggedIn)
        {
            $GLOBALS['didPassReset'] = 0;
            $query = "SELECT * FROM member WHERE email = '$this->email'";
            $result = $this->conn->query($query);

            $salt1 = "allthoseflavors";
            $salt2 = "andyouchosetobesalty";

            $row = $result->fetch_array();

            if ($row['password'] == hash('ripemd128', "$salt1$oldpass$salt2"))
            {
                if ($newpass1 != $newpass2)
                {
                    $GLOBALS['errNewPass'] = "New passwords must match.";   
                }
                else
                {
                    $salt1 = "allthoseflavors";
                    $salt2 = "andyouchosetobesalty";

                    $dbPass = hash('ripemd128', "$salt1$newpass1$salt2");

                    $insertQuery = "UPDATE member SET password = '$dbPass' WHERE email = '$this->email'";
                    $this->conn->query($insertQuery);

                    $GLOBALS['didPassReset'] = 1;
                    $GLOBALS['passResetMsg'] = "You've successfully changed your password.";
                }
            }
            else
            {
                $GLOBALS['errOldPass'] = "Entered password does not match current password."; 
            }
        }
    }

    // FINISHED
    public function addToWishlist($sku)
    {
        if ($this->isLoggedIn)
        {
            $tempSKU = $this->sanitizeString($sku);
            $query = "SELECT * FROM items WHERE SKU = '$tempSKU'";
            $result = $this->conn->query($query);

            if ($result->num_rows)
            {
                $insertQuery = "INSERT INTO wishlist (email, sku) VALUES ('$this->email', '$tempSKU')";
                $conn->query($insertQuery);  
            }

            else
            {
                $GLOBALS['errSKU'] = "Item does not exist.";
            }
        }
    }

    // FINISHED
    public function removeFromWishList($sku)
    {
        if ($this->isLoggedIn)
        {
            $tempSKU = $this->sanitizeString($sku);
            $query = "SELECT * FROM items WHERE SKU = '$tempSKU'";
            $result = $this->conn->query($query);

            if ($result->num_rows)
            {
                $insertQuery = "DELETE FROM wishlist WHERE SKU = '$tempSKU' AND email = '$this->email'";
                $conn->query($insertQuery);  
            }

            else
            {
                $GLOBALS['errSKU'] = "Item does not exist.";
            }
        }
    }

    // FINSHED
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

    public function getfirstName()
    {
        return $this->firstName;
    }
    public function getlastName()
    {
        return $this->lastName;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function getaddr1()
    {
        return $this->addr1;
    }
    public function getaddr2()
    {
        return $this->addr2;
    }
    public function getcity()
    {
        return $this->city;
    }
    public function getstate()
    {
        return $this->state;
    }
    public function getzip()
    {
        return $this->zip;
    }
    public function getisLoggedIn()
    {
        return $this->isLoggedIn;
    }
    public function getisAdmin()
    {
        return $this->isAdmin;
    }
    public function getconn()
    {
        return $this->conn;
    }

    // FINISHED
    public function resetMemberPassword($email)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $tempEmail = $this->sanitizeString($email);
            if(preg_match('/^[a-zA-Z0-9_]+@[a-z]+\.[a-zA-Z0-9]+$/' , $tempEmail))
            {
                $query = "SELECT * FROM account WHERE email = '$tempEmail'";
                $result = $this->conn->query($query);
    
                if ($result->num_rows)
                {
                    $passResetQuery = "UPDATE account SET passwordReset = '1' WHERE email = '$tempEmail'";
                    $this->conn->query($passResetQuery);
                }
                else
                {
                    $GLOBALS['errExists'] = "E-mail does not currently exist.";
                }
            }

            else
            {
                $GLOBALS['errEmail'] = "That is not a valid email address.";
            }
        }
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
    public function addItem($sku, $itemcat, $itemname, $msrp, $url)
    {
        if ($this->isLoggedIn && $this->isAdmin)
        {
            $didSku = 0;
            $didICat = 0;
            $didIName = 0;
            $didMSRP = 0;
            $didURL = 0;

            $tempSKU = $this->sanitizeString($sku);
            if (!empty($tempSKU) && preg_match('/^[A-Z][A-Z][A-Z][-][A-Z][A-Z][A-Z][-][0-9a-zA-Z][0-9a-zA-Z][0-9a-zA-Z][0-9a-zA-Z]$/' , $tempSKU))
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

            $tempURL = $url;

            if ($didSku && $didICat && $didIName && $didMSRP)
            {
                $insertQuery = "INSERT INTO items (SKU, itemCategory, itemName, itemPrice, itemPicture) VALUES ('$tempSKU', '$tempICat', '$tempIName', '$tempMSRP', '$tempURL')";
                $this->conn->query($insertQuery);
            }
        }
    }

    // FINISHED
    public function removeItem($sku)
    {
        //if ($this->isLoggedIn && $this->isAdmin)
        //{
                $updatePrice = "UPDATE items SET salePrice = '-0.01' WHERE SKU = '$sku'";
                $this->conn->query($updatePrice);
                $updateQuantity = "UPDATE items SET stockQuantity = '0' WHERE SKU = '$sku'";
                $this->conn->query($updateQuantity);
        //}
    }

    // FINISHED
    public function adjustItemPrice($sku, $price)
    {
        //if ($this->isLoggedIn && $this->isAdmin)
        //{
           // $tempAmnt = $this->sanitizeString($price);
            //if (!empty($tempAmnt) && preg_match('/^[0-9]+[.][0-9]*$/' , $tempAmnt)) 
            //{               
                echo $sku;
                echo $price;

               $updatePrice = "UPDATE items SET salePrice = '$price' WHERE SKU = '$sku'";
               $this->conn->query($updatePrice); 

            //}
        //}
    }

    public function generateSalesReport()
    {
        // Ensure isLoggedIn && isAdmin
        // isset_POST -> generateSalesSubmit
        // Write DB Query -> Sold Table -- DATE RANGE IMPLEMENTATION TBD
        // Output to SALES_REPORT.txt
    }
}

?>
