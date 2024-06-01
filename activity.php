<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
    require_once "database.php"; // Make sure this file contains the database connection code

    if (isset($_GET['projectId'])) {
        $projectId = $_GET['projectId'];

        if (isset($_POST["save"])) {
            $activityName = $_POST["activityName"];
            $activityStartDate = $_POST["activityStartDate"];
            $activityEndDate = $_POST["activityEndDate"];
            $responsibility = $_POST["responsibility"];
            $notes = $_POST["notes"];

            $errors = array();

            if (empty($activityName) || empty($activityStartDate) || empty($activityEndDate) || empty($responsibility)) {
                array_push($errors, "All fields are required");
            } else {
                $sql = "INSERT INTO activity (activityName, activityStartDate, activityEndDate, responsibility, notes, projectId) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sssssi", $activityName, $activityStartDate, $activityEndDate, $responsibility, $notes, $projectId);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Activity Saved successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
    } else {
        die("projectId is required");
    }
    ?>    

        <form action="activity.php?projectId=<?php echo $projectId; ?>" method="post">
            <label for="activityName">Activity Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="activityName" placeholder="Enter Your Activity Name:">
            </div>
            <label for="activityStartDate">Activity Start Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="activityStartDate" placeholder="Enter Activity Start Date:">
            </div>
            <label for="activityEndDate">Activity End Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="activityEndDate" placeholder="Enter Activity End Date:">
            </div>
            <label for="responsibility">Responsible Person Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="responsibility" placeholder="Enter Responsible Person Name:">
            </div>
            <label for="notes">Notes: </label>
            <div class="form-group">
                <textarea type="text" class="form-control" name="notes" placeholder="Enter Your Notes:"></textarea>
            </div>
            <div style="display:flex; flex-direction: row; align-items: center; justify-content: space-between;">
                <div class="form-btn">
                    <input style="width: 150px;" type="submit" class="btn btn-primary" value="Save" name="save">
                </div>
                <div class="form-btn">
                    <a style="width: 150px;" class="btn btn-primary" href="displayactivity.php">Details</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
