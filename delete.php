<?php 

    require 'control.php';

    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $database= "medicalrecords";
    
    $conf = mysqli_connect($server, $db_username, $db_password, $database);
    if (mysqli_connect_errno())
    {
        throw new Exception("MySQL connection error: ".mysqli_connect_error());
    }

    $patientID = $_GET["patientID"];

    if(delete($patientID) > 0){
        echo "
                <script>
                    alert('data deleted successfully!');
                    document.location.href = 'index.php';
                </script>
            ";
    }else{
        echo "
                <script>
                    alert('data failed to delete');
                    document.location.href = 'index.php';
                </script>
            ";
    }
?>