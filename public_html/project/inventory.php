<?php

class Inventory
{
    private $hasDBResult;
    public function __construct($toBeSearched)
    {
        require_once 'loginInfo.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);

        if (preg_match('/^[0-9]$/' , $toBeSearched)) // represents category
        {
            //CASE 0
            if ($toBeSearched === 0)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'Case'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //PSU 1 
            else if ($toBeSearched === 1)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'PSU'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //MOBO 2
            else if ($toBeSearched === 2)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'Motherboard'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //CPU 3 
            else if ($toBeSearched === 3)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'CPU'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //RAM 4
            else if ($toBeSearched === 4)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'RAM'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //CPUC 5
            else if ($toBeSearched === 5)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'CPUC'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //GPU 6
            else if ($toBeSearched === 6)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'GPU'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //ACC 7
            else if ($toBeSearched === 7)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'Accessories'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }
            //HDD 8
            else if ($toBeSearched === 8)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'HDD'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }

            else if ($toBeSearched === 9)
            {
                $query = "SELECT * FROM items WHERE itemCategory = 'Monitor'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }

            else
            {
                $query = "SELECT * FROM items WHERE itemName LIKE '%{$toBeSearched}%'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
            }

        }

        else // represents string query
        {
                $query = "SELECT * FROM items WHERE itemName LIKE '%{$toBeSearched}%'";
                $result = $conn->query($query);
                $this->hasDBResult = $result;
        }
    }

    public function getDBResult()
    {
        return $this->hasDBResult;
    }

} ?>
