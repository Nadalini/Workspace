<?php
    define('HOST', 'localhost');
    define('USER', 'u559840823_user');
    define('PASS', 'if123456');
    define('DBNAME', 'u559840823_mood');

    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

    $movieName = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);

    $result_msg_cont = "SELECT * FROM movie WHERE movieName LIKE '%".$movieName."%' OR movieOrigName LIKE '%".$movieName."%' ORDER BY movieName ASC LIMIT 10";

    //Seleciona os registros
    $resultado_msg_cont = $conn->prepare($result_msg_cont);
    $resultado_msg_cont->execute();

    while($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row_msg_cont['movieName'];
    }

    echo json_encode($data);
?>