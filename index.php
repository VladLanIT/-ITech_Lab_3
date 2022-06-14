<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab1</title>
    <script>
        var ajax = new XMLHttpRequest();

function _1() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                console.dir(ajax.responseText);
                document.getElementById("res").innerHTML = ajax.response;
            }
        }
    }
    var date = document.getElementById("dateValue").value;
    ajax.open("get", "1.php?dateValue=" + date);
    ajax.send();
}

function _2() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {

                console.dir(ajax);
                let rows = ajax.responseXML.firstChild.children;
                let result = "Автомобили указанного производителя: <ol>";
                for (var i = 0; i < rows.length; i++) {
                    result += "<li>Автомобиль: " + rows[i].children[0].firstChild.nodeValue + "</li>"; 
                }
                result += "</ol>"
                document.getElementById("res").innerHTML = result;
            }
        }
    }
    var vendors = document.getElementById("vendors").value;
    ajax.open("get", "2.php?vendors=" + vendors);
    ajax.send();
}

function _3() {
    ajax.onreadystatechange = function () {
    let rows = JSON.parse(ajax.responseText);
    console.dir(rows);
    if (ajax.readyState === 4) {
        if (ajax.status === 200) {
            console.dir(ajax);
            
            let result = "Свободные автомобили на дату <ol>";
            for (var i = 0; i < rows.length; i++) {
               result += "<li>Автомобиль: " + rows[i].Name + "</li>"; 
            }
            result += "</ol>"
            document.getElementById("res").innerHTML = result;
        }
    }
}
    var dateFree = document.getElementById("dateFree").value;
    ajax.open("get", "3.php?dateFree=" + dateFree);
    ajax.send();
}
    </script>
</head>

<body>
    <p><strong> Полученный доход с проката по состоянию на выбранную дату: </strong>
        <select name="dateValue" id="dateValue" >
            <?php
            $sql = "SELECT distinct date_end from $db.rent";
            $sql = $dbh->query($sql);
            foreach ($sql as $cell) {
                echo "<option> $cell[0] </option>";
            }
            ?>
        </select>
        <button onclick="_1()">ОК</button>
    </p>
    <p><strong>Автомобили выбранного производителя: </strong>
        <select name="vendors" id="vendors">
            <?php
            $sql = "SELECT DISTINCT name from $db.vendors";
            $sql = $dbh->query($sql);
            foreach ($sql as $cell) {
                echo "<option> $cell[0] </option>";
            }
            ?>
        </select>
        <button onclick="_2()">ОК</button>
    </p>
    <p><strong> Свободные автомобили </strong>
        <select  name="dateFree" id="dateFree">
            <?php
            $sql = "SELECT distinct date_start from $db.rent";
            $sql = $dbh->query($sql);
            foreach ($sql as $cell) {
                echo "<option> $cell[0] </option>";
            }
            ?>
        </select>
        <button onclick="_3()">ОК</button>
    </p>
<div id="res"></div>
</body>

</html>