<?php
header('Content-Type: text/xml');
header('Cache-Control: no-cache, must-revalidate');
include "connect.php";
if (isset($_REQUEST["vendors"])) {
    try{
    $vendor = $_REQUEST["vendors"];
    $statement = $dbh->prepare(
        "SELECT * from $db.cars
        JOIN $db.vendors 
        on $db.cars.FID_VENDORS = $db.vendors.ID_VENDORS
        where $db.vendors.name = :vendor"
    );
    $statement->execute(array('vendor'=>$vendor));
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo "<root>";
    while($cell=$statement->fetch(PDO::FETCH_BOTH)){
        echo "<row><cell>$cell[1]</cell></row>";
    }
    echo "</root>";
    }catch(PDOException $e){
        echo "Ошибка " . $e->getMessage();

    }
}  
?>