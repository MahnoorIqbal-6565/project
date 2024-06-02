<?php
include "database.php";

// Initialize variables
$activityId = "";
$activityName = "";
$activityStartDate = "";
$activityEndDate = "";
$responsibility = "";
$notes = "";
$projectId = "";

// Check if updateid and projectid are set in the URL
if (isset($_GET['updateid']) && isset($_GET['projectid'])) {
    $activityId = $_GET['updateid'];
    $projectId = $_GET['projectid'];

    // Fetch the record based on updateid and projectid
    $sql = "SELECT * FROM activities WHERE activityId = ? AND projectId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $activityId, $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign fetched values to variables
        $activityName = $row['activityName'];
        $activityStartDate = $row['activityStartDate'];
        $activityEndDate = $row['activityEndDate'];
        $responsibility = $row['responsibility'];
        $notes = $row['notes'];
    } else {
        echo "<div class='alert alert-danger'>No record found for the given ID.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>Activity ID and Project ID are required.</div>";
    exit();
}

// Check if the form is submitted
if (isset($_POST['update'])) {
    $activityName = $_POST['activityName'];
    $activityStartDate = $_POST['activityStartDate'];
    $activityEndDate = $_POST['activityEndDate'];
    $responsibility = $_POST['responsibility'];
    $notes = $_POST['notes'];

    // Update the record
    $sql = "UPDATE activities SET activityName=?, activityStartDate=?, activityEndDate=?, responsibility=?, notes=? WHERE activityId=? AND projectId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $activityName, $activityStartDate, $activityEndDate, $responsibility, $notes, $activityId, $projectId);
    $result = $stmt->execute();

    // Check if update was successful
    if ($result) {
        echo "<div class='alert alert-success'>Updated the record successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $stmt->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Update Activity Record</title>
</head>
<body>
    <div class="container">
        <form action="activity.php?updateid=<?php echo htmlspecialchars($activityId); ?>&projectid=<?php echo htmlspecialchars($projectId); ?>" method="post">
            <label for="activityName">Activity Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="activityName" value="<?php echo htmlspecialchars($activityName); ?>" placeholder="Enter Your Activity Name:" required>
            </div>
            <label for="activityStartDate">Activity Start Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="activityStartDate" value="<?php echo htmlspecialchars($activityStartDate); ?>" placeholder="Enter Activity Start Date:" required>
            </div>
            <label for="activityEndDate">Activity End Date: </label>
            <div class="form-group">
                <input type="date" class="form-control" name="activityEndDate" value="<?php echo htmlspecialchars($activityEndDate); ?>" placeholder="Enter Activity End Date:" required>
            </div>
            <label for="responsibility">Responsible Person Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="responsibility" value="<?php echo htmlspecialchars($responsibility); ?>" placeholder="Enter Responsible Person Name:" required>
            </div>
            <label for="notes">Notes: </label>
            <div class="form-group">
                <textarea class="form-control" name="notes" placeholder="Enter Your Notes:" required><?php echo htmlspecialchars($notes); ?></textarea>
            </div>
            <div style="display:flex; flex-direction: row; align-items: center; justify-content: space-between;">
                <div class="form-btn">
                    <input style="width: 150px;" type="submit" class="btn btn-primary" value="Update" name="update">
                </div>
                <div class="form-btn">
                    <a style="width: 150px;" class="btn btn-primary" href="displayactivity.php">Details</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
