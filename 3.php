<?php
include "connect.php";
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');
if (isset($_REQUEST["dateFree"])) {
    try{
    $date = $_REQUEST["dateFree"];
    $statement = $dbh->prepare(
        "SELECT * from $db.rent
        join $db.cars
        on $db.rent.fid_car = $db.cars.id_cars
        where :date NOT BETWEEN $db.rent.date_start AND $db.rent.date_end"
    );
    $statement->execute(array('date'=>$date));
    $cell=$statement->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($cell);
    }catch(PDOException $e){
        echo "Ошибка " . $e->getMessage();

    }
}  
?>