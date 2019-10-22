<!DOCTYPE html>
<html>
<head>
<title>Inventory</title>
<style>
    td {
        border: 1px solid black;
        padding: 1em 1em 1em 1em;
    }
 </style>
</head>
<body>
            <form method="post" action="inventoryTest.php">
            <label>Adjust Item Quantity: </label>
            <select name = "catSel">
            <option value="0">Case</option>
            <option value="1">PSU</option>
            <option value="2">Motherboard</option>
            <option value="3">CPU</option>
            <option value="4">RAM</option>
            <option value="5">CPU Cooler</option>
            <option value="6">GPU</option>
            <option value="8">HDD</option>
            <option value="7">Accessories</option>
            </select>
            <label>Select Me Daddy: </label>
            <input type="submit" name = "clickit" value="EXECUTE IT DADDY">
            <label>Search Me Daddy: </label>
            <input type="text" name="string" value="">
            <input type="submit" name = "findit" value="FIND IT FOR ME DADDY">
            </form>
<?php

if(isset($_POST['findit']))
{
    require_once('inventory.php');
    $myObj = new Inventory($_POST['string']);
    $result = $myObj->getDBResult();
}

if(isset($_POST['clickit']))
{
    $myvar = intval($_POST['catSel']);
    require_once('inventory.php');
    $myObj = new Inventory($myvar);
    $result = $myObj->getDBResult();
}




echo '<table>';
echo '<tr>';
echo '<th colspan = 6>Inventory</th>';
echo '</tr>';
echo '<tr>';
echo '<td>SKU</td>';
echo '<td>Item Category</td>';
echo '<td>Item Name</td>';
echo '<td>Sale Price</td>';
echo '<td>Price</td>';
echo '<td>Quantity</td>';
echo '</tr>';

if(isset($_POST['clickit']) || isset($_POST['findit']))
{
    if ($result->num_rows == 0)
    {
        echo "BETTER LUCK NEXT TIME BIATCH";
    }
}
    while ($row = $result->fetch_array())
    {

        echo '<tr>';
        echo '<td>'; echo $row['SKU']; echo'</td>';
        echo '<td>'; echo $row['itemCategory'];  echo'</td>';
        echo '<td>'; echo $row['itemName'];  echo'</td>';
        echo '<td>'; echo $row['salePrice']; echo'</td>';
        echo '<td>'; echo $row['itemPrice'];  echo'</td>';
        echo '<td>'; echo $row['stockQuantity'];  echo'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>
</body>
</html>