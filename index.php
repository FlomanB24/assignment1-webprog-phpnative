<?php 
    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "medicalrecords";
    
    $conf = mysqli_connect($server, $db_username, $db_password, $database);
    if (mysqli_connect_errno())
    {
        throw new Exception("MySQL connection error: ".mysqli_connect_error());
    }

    $temp = mysqli_query($conf, "SELECT * FROM records");
        
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
    <title>Records</title>
</head>
<body>
    <section class="jumbotron text-center">
        <h1 class="display-4">Medical Record</h1>
        <a href="add.php" class="btn btn-primary mg-btn" role="button">Add Data</a>
        <div class="container">
        <div class="row text-center">
              <div class="col mb-3">
              </div>
            </div>
            <div class="row justify-content-center fs-5">
              <div class="col-md-10">
                <table class="table table-bordered table-light">
                    <tr>
                        <th>No.</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Date of Entry</th>
                        <th>Diagnosis</th>
                        <th>Medical Treatments</th>
                        <th>Action</th>
                    </tr>

                    <?php $i = 1 ; ?>
                    <?php while($tupel = mysqli_fetch_assoc($temp)) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $tupel["patient"]; ?></td>
                        <td><?= $tupel["gender"]; ?></td>
                        <td><?= $tupel["age"]; ?></td>
                        <td><?= $tupel["entry"]; ?></td>
                        <td><?= $tupel["diagnosis"]; ?></td>
                        <td><?= $tupel["treatment"]; ?></td>
                        <td>
                            <a href="update.php?patientID=<?= $tupel["patientID"]; ?>" class="btn btn-outline-primary">Update</a>
                            <a href="delete.php?patientID=<?= $tupel["patientID"]; ?>" onclick="return confirm('Do you really want to delete this data?');" class="btn btn-outline-primary">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endwhile ; ?>
                </table>
            </div>
          </div>
        </div>
    </section>
    
</body>
</html>