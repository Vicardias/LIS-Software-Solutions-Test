<?php

    include_once 'connection.php';

    function Insert( $conn, $Travel_Start, $Travel_Destination, $Start_Date, $Expiration_Date, $Passenger_Name ) {

        $query = $conn -> query("Select Top 1 ID From Travels Order By Datetime Desc");
        $Table_ID = $query -> fetchObject();

        if ( $Table_ID == false ) {
            $Folio = date("Ymd").'-0000';
        } else {
            $ID = $Table_ID -> ID;
            if( $ID == '' ){
                $Folio = date("Ymd").'-0000';
            }else if( $ID < 10 ){
                $Folio = date("Ymd").'-000'.$ID;
            }else if( $ID < 100 ){
                $Folio = date("Ymd").'-00'.$ID;
            }else if( $ID < 1000 ){
                $Folio = date("Ymd").'-0'.$ID;
            }else if( $ID < 10000 ){
                $Folio = date("Ymd").'-'.$ID;
            }
        }

        try {

            $query = $conn -> prepare("
                Insert into
                    Travels
                        ( Folio, Travel_Start, Travel_Destination, Start_Date, Expiration_Date, Passenger_Name )
                Values
                    ( ?, ?, ?, ?, ? );
            ");
            $result = $query -> execute([ $Folio, $Travel_Start, $Travel_Destination, $Start_Date, $Expiration_Date, $Passenger_Name ]);

            if ( $result ) {
                echo json_encode( [ "Message" => true ] );
            } else {
                echo json_encode( [ "Message" => false ] );
            }

        } catch ( Exception $e ) {
            echo json_encode( [ "Error" => $e ] );
        }
        
    }

    function Update( $conn, $Travel_Start, $Travel_Destination, $Start_Date, $Expiration_Date, $Passenger_Name, $Folio ) {

        try {

            $query = $conn -> prepare("
                Update
                    Travels
                Set
                    Travel_Start = ?,
                    Travel_Destination = ?,
                    Start_Date = ?,
                    Expiration_Date = ?,
                    Passenger_Name = ?
                Where
                    Folio = ?
            ");
            $result = $query -> execute([ $Travel_Start, $Travel_Destination, $Start_Date, $Expiration_Date, $Passenger_Name, $Folio ]);

            if ( $result ) {
                echo json_encode( [ "Message" => true ] );
            } else {
                echo json_encode( [ "Message" => false ] );
            }

        } catch ( Exception $e ) {
            echo json_encode( [ "Error" => $e ] );
        }

    }

    if ( isset( $_POST["Insert"] ) && !empty( $_POST["Insert"] ) ) {
        if (
            !empty( $_POST["Travel_Start"] ) &&
            !empty( $_POST["Travel_Destination"] ) &&
            !empty( $_POST["Start_Date"] ) &&
            !empty( $_POST["Expiration_Date"] ) &&
            !empty( $_POST["Passenger_Name"] )
        ) {
            Insert( $conn, $_POST["Travel_Start"], $_POST["Travel_Destination"], $_POST["Start_Date"], $_POST["Expiration_Date"], $_POST["Passenger_Name"] );
        } else {
            echo json_encode( $arrJSON = [ "Message" => "Empty Fields" ] );
        }
    } else if ( isset( $_POST["Update"] ) && !empty( $_POST["Update"] ) ) {
        if (
            !empty( $_POST["Travel_Start"] ) &&
            !empty( $_POST["Travel_Destination"] ) &&
            !empty( $_POST["Start_Date"] ) &&
            !empty( $_POST["Expiration_Date"] ) &&
            !empty( $_POST["Passenger_Name"] ) &&
            !empty( $_POST["Folio"] )
        ) {
            Update( $conn, $_POST["Travel_Start"], $_POST["Travel_Destination"], $_POST["Start_Date"], $_POST["Expiration_Date"], $_POST["Passenger_Name"], $_POST["Folio"] );
        } else {
            echo json_encode( $arrJSON = [ "Message" => "Empty Fields" ] );
        }
    } else {
        echo json_encode( $arrJSON = [ "Message" => "Empty Query" ] );
    }

?>