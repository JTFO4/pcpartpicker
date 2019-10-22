<?php 
$GLOBALS['errSKU'] = "";

class Cart
{
    public function __construct()
    {
        session_start();
    }

    public function addToCart($sku, $quant)
    {
        if (in_array($sku, $_SESSION['arraySKU']))
        {
           $_SESSION['arrayQuant'][$sku] += $quant;
        }

       else
        {
        $_SESSION['arraySKU'][] = $sku;
        $_SESSION['arrayQuant'][$sku] = $quant;
        }
    }

    public function changeQuantity($sku, $quant)
    {
        $_SESSION['arrayQuant'][$sku] = $quant;
    }

    public function removeFromCart($sku)
    {
        // echo $sku . "<br>";
        if (($key = array_search($sku, $_SESSION['arraySKU'])) !== false) {
            // echo $key;
            unset($_SESSION['arraySKU'][$key]);
            unset($_SESSION['arrayQuant'][$sku]);
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
}
?>