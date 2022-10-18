<?php 

    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $database= "medicalrecords";

    $conf = mysqli_connect($server, $db_username, $db_password, $database);

    if (mysqli_connect_errno())
    {
        throw new Exception("MySQL connection error: ".mysqli_connect_error());
    }

    function query ($query)
    {
        global $conf;
        $temp = mysqli_query($conf, $query);
        $record = [];
        while ($tupel = mysqli_fetch_assoc($temp))
        {
            $record[] = $tupel;
        }
        return $record;
    }

    function add($postData)
    {
        global $conf;

        $patient = htmlspecialchars($postData["patient"]);
        $gender = htmlspecialchars($postData["gender"]);
        $age = htmlspecialchars($postData["age"]);
        $entry = htmlspecialchars($postData["entry"]);
        $diagnosis = htmlspecialchars($postData["diagnosis"]);
        $treatment = htmlspecialchars($postData["treatment"]);

        $query = "INSERT INTO records
                VALUES 
                ('', '$patient', '$gender', '$age', '$entry', '$diagnosis', '$treatment')
                ";

        mysqli_query($conf, $query);

        return mysqli_affected_rows($conf);
    }

    function update($postData) {
        global $conf;

        $patientID = $postData["patientID"];
        $patient = ($postData["patient"]);
        $gender = ($postData["gender"]);
        $age = ($postData["age"]);
        $entry = ($postData["entry"]);
        $diagnosis = htmlspecialchars($postData["diagnosis"]);
        $treatment = htmlspecialchars($postData["treatment"]);

        $query = "UPDATE records SET 
        
                    patient = '$patient', 
                    gender = '$gender', 
                    age = '$age', 
                    entry = '$entry',
                    diagnosis = '$diagnosis',
                    treatment = '$treatment' 

                    WHERE patientID = $patientID;
                ";

        mysqli_query($conf, $query);

        return mysqli_affected_rows($conf);
    }
    
    function delete($patientID) 
    {
        global $conf;
        mysqli_query($conf,"DELETE FROM records WHERE patientID = $patientID");
        return mysqli_affected_rows($conf);
    }

?>