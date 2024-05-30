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

if (isset($_POST["save"])) {
    $sactivityName = $_POST["sactivityName"];
    $sactivityStartDate = $_POST["sactivityStartDate"];
    $sactivityEndDate = $_POST["sactivityEndDate"];
    $sresponsibility = $_POST["sresponsibility"];
    $snotes = $_POST["snotes"];

    $errors = array();

    if (empty($sactivityName) || empty($sactivityStartDate) || empty($sactivityEndDate) || empty($sresponsibility)) {
        array_push($errors, "All fields are required");
    } else {
        $sql = "INSERT INTO subactivity (sactivityName, sactivityStartDate, sactivityEndDate, sresponsibility,snotes) VALUES (?, ?, ?, ?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $sactivityName, $sactivityStartDate, $sactivityEndDate, $sresponsibility,$snotes);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Sub Activity Saved successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>

        <form action="subactivity.php" method="post">
            <label for="sactivityName">Sub-Activity Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="sactivityName" placeholder="Enter Your Sub-Activity Name:">
            </div>
            <label for="sactivityStartDate">Sub-Activity Start Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="sactivityStartDate" placeholder="Enter Sub-Activity Start Date:">
            </div>
            <label for="sactivityEndDate">Sub-Activity End Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="sactivityEndDate" placeholder="Enter Sub-Activity End Date:">
            </div>
            <label for="sresponsibility">Responsible Person Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="sresponsibility" placeholder="Enter Responsible Person Name:">
            </div>
            <label for="snotes">Notes: </label>
            <div class="form-group">
                <textarea type="text" class="form-control" name="snotes" placeholder="Enter Your Sub-Activity Notes:"></textarea>
            </div>
            <div  style="display:flex; flex-direction: row;align-items: center;justify-content: space-between;">
            <div class="form-btn">
                <input style="width: 150px;" type="submit" class="btn btn-primary" value="Save" name="save">
            </div>
            <div class="form-btn">
            <a style="width: 150px;" class="btn btn-primary" href="displayactivity.php">Details</a>

            </div>
            </div>
        </form>
        <div>
       
      </div>
    </div>
</body>
</html>