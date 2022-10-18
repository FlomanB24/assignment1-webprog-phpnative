<?php 
    require 'control.php';

    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $database= "medicalrecords";

    $conf = mysqli_connect($server, $db_username, $db_password, $database);
    if (mysqli_connect_errno()){
        throw new Exception("MySQL connection error: ".mysqli_connect_error());
    }

    $patientID = $_GET["patientID"];

    $medrecord = query ("SELECT * FROM records WHERE patientID = $patientID")[0];

    if(isset($_POST["submit"]))
    {
        if (update($_POST) > 0){
            echo "
                <script>
                    alert('data updated successfully!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('data failed to update!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <title>Update Medical Record</title>
</head>
<body>
<section class="jumbotron text-center">
        <h1 class="display-4">Patient Medical Record</h1>
        <div class="container">
            <div class="row text-center">
                <div class="col mb-4">
                </div>
            </div>
            <div class="row justify-content-center  fs-5">
                <div class="col-md-5">
                    <form action="" method="post">
                        <input type="hidden" name="patientID" value="<?= $medrecord["patientID"]; ?>">
                        <div class="mb-3" >
                            <label for="patient" class="form-label"  id="margin" >Patient's name :</label>
                            <input type="text" name="patient" id="patient" autocomplete="off" required value="<?= $medrecord["patient"]  ?>">
                        </div>
                        <div class="input-group mb-3 gen">
                            <label for="gender"  id="mg-gen">Gender:</label>
                            <select class="form-control custom-select" id="gender" name="gender" value="<?= $medrecord["gender"]  ?>">
                                <option selected>Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label" id="margin1">Age :</label>
                            <input type="text" name="age" id="age" autocomplete="off" value="<?= $medrecord["age"]  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="entry" class="form-label"  id="margin2">Date of Entry:</label>
                            <input type="date" class="datebox" name="entry" id="entry" autocomplete="off" value="<?= $medrecord["entry"]  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label"  id="margin3">Diagnosis :</label>
                            <input type="text" name="diagnosis" id="diagnosis" autocomplete="off" required value="<?= $medrecord["diagnosis"]  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="treatment" class="form-label"  id="margin4">Medical Treatment :</label>
                            <input type="text" name="treatment" id="treatment" autocomplete="off" required value="<?= $medrecord["treatment"]  ?>">
                        </div>
                        <div class="mb-4">
                            <button type="submit" name="submit"  class="btn btn-success">Update Medical Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>