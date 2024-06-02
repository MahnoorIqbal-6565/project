<?php
include "database.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables
$subactivityId = "";
$sactivityName = "";
$sactivityStartDate = "";
$sactivityEndDate = "";
$sresponsibility = "";
$snotes = "";
$activityId = "";

// Check if updateid is set in the URL
if (isset($_GET['updateid'])) {
    $activityId = $_GET['updateid'];
    $activityId=$_GET['activityId'];
  
    
    
    // Fetch the record based on updateid
    $sql = "SELECT * FROM subactivity WHERE subactivityId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $subactivityId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Assign fetched values to variables
        $activityName = $row['sactivityName'];
        $activityStartDate = $row['sactivityStartDate'];
        $activityEndDate = $row['sactivityEndDate'];
        $responsibility = $row['sresponsibility'];
        $notes = $row['snotes'];
       // $activityId = $row['activityId'];
    } else {
        echo "<div class='alert alert-danger'>No record found for the given ID.</div>";
    }
}

// Check if the form is submitted
if (isset($_POST['update'])) {
    $sactivityName = $_POST['sactivityName'];
    $sactivityStartDate = $_POST['sactivityStartDate'];
    $sactivityEndDate = $_POST['sactivityEndDate'];
    $sresponsibility = $_POST['sresponsibility'];
    $snotes = $_POST['snotes'];
    $activityId = $_POST['activityId'];

    // Update the record
    $sql = "UPDATE subactivity SET sactivityName=?, sactivityStartDate=?, sactivityEndDate=?, sresponsibility=?, snotes=?, activityId=? WHERE subactivityId=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssii', $sactivityName, $sactivityStartDate, $sactivityEndDate, $sresponsibility, $snotes, $activityId, $subactivityId);
    $result = mysqli_stmt_execute($stmt);

    // Check if update was successful
    if ($result) {
        echo "<div class='alert alert-success'>Updated the record successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Update Activity Record</title>
</head>
<body>
    <div class="container">
        <form action="activity.php?updateid=<?php echo htmlspecialchars($subactivityId); ?>" method="post">
            <label for="sactivityName">Sub Activity Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="sactivityName" value="<?php echo htmlspecialchars($sactivityName); ?>" placeholder="Enter Your Activity Name:" required>
            </div>
            <label for="sactivityStartDate">Sub Activity Start Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="sactivityStartDate" value="<?php echo htmlspecialchars($sactivityStartDate); ?>" placeholder="Enter Activity Start Date:" required>
            </div>
            <label for="sactivityEndDate">Sub Activity End Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="sactivityEndDate" value="<?php echo htmlspecialchars($sactivityEndDate); ?>" placeholder="Enter Activity End Date:" required>
            </div>
            <label for="sresponsibility">Sub Activity Responsible Person Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="sresponsibility" value="<?php echo htmlspecialchars($sresponsibility); ?>" placeholder="Enter Responsible Person Name:" required>
            </div>
            <label for="notes">Sub Activity Notes: </label>
            <div class="form-group">
                <textarea class="form-control" name="snotes" placeholder="Enter Your Notes:" required><?php echo htmlspecialchars($snotes); ?></textarea>
            </div>
            <input type="hidden" name="activityId" value="<?php echo htmlspecialchars($activityId); ?>">
            <div style="display:flex; flex-direction: row; align-items: center; justify-content: space-between;">
                <div class="form-btn">
                    <input style="width: 150px;" type="submit" class="btn btn-primary" value="Update" name="update">
                </div>
                <div class="form-btn">
                    <a style="width: 150px;" class="btn btn-primary" href="displaysubactivity.php">Details</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
