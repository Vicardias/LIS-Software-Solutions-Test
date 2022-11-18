<?php

    $password = "********";
    $username = "********";
    $database = "********";
    $server = "255.255.255.255";

    try {
        $conn = new PDO("sqlsrv:server=$server;database=$database", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( Exception $e ) {
        echo json_encode( [ "Response" => "Error", "Error" => $e->getMessage() ] );
    }

?>