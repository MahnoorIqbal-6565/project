<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Activity and Sub-Activity</title>
</head>
<body>
    <div class="container">
    <?php
// Database connection parameters
require_once "database.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT 
activity.activityId, 
activity.activityName, 
activity.activityStartDate, 
activity.activityEndDate, 
activity.responsibility, 
activity.notes, 
subactivity.subactivityId, 
subactivity.sactivityName, 
subactivity.sactivityStartDate, 
subactivity.sactivityEndDate, 
subactivity.sresponsibility, 
subactivity.snotes 
FROM activity LEFT JOIN 
subactivity ON activity.activityId = subactivity.activityId;
";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Activity ID</th>
                    <th scope="col">Activity Name</th>
                    <th scope="col">Activity Start Date</th>
                    <th scope="col">Activity End Date</th>
                    <th scope="col">Responsibility</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $activityId = htmlspecialchars($row['activityId']);
        $activityName = htmlspecialchars($row['activityName']);
        $activityStartDate = htmlspecialchars($row['activityStartDate']);
        $activityEndDate = htmlspecialchars($row['activityEndDate']);
        $responsibility = htmlspecialchars($row['responsibility']);
        $notes = htmlspecialchars($row['notes']);
        $subactivityId = htmlspecialchars($row['subactivityId']);
        $sactivityName = htmlspecialchars($row['sactivityName']);
        $sactivityStartDate = htmlspecialchars($row['sactivityStartDate']);
        $sactivityEndDate = htmlspecialchars($row['sactivityEndDate']);
        $sresponsibility = htmlspecialchars($row['sresponsibility']);
        $snotes = htmlspecialchars($row['snotes']);
        
        echo '<tr>
                <th scope="row">' . $activityId . '</th>
                <td>' . $activityName . '</td>
                <td>' . $activityStartDate . '</td>
                <td>' . $activityEndDate . '</td>
                <td>' . $responsibility . '</td>
                <td>' . $notes . '</td>
                <td>
                    <button class="btn btn-primary">
                        <a href="update.php?updateid=' . $activityId . '" style="text-decoration:none;" class="text-light">Update</a>
                    </button>
                    <button class="btn btn-danger">
                        <a href="delete.php?deleteid=' . $activityId . '" style="text-decoration:none;" class="text-light">Delete</a>
                    </button>
                    <button class="btn btn-success">
                        <a href="subactvityform.php?activityId=' . $activityId . '" style="text-decoration:none;" class="text-light">Add SubActivity</a>
                    </button>
                </td>
            </tr>
            <tr><td>' . $subactivityId . '</td>
            <td>' . $sactivityName . '</td>
            <td>' . $sactivityStartDate . '</td>
            <td>' . $sactivityEndDate . '</td>
            <td>' . $sresponsibility . '</td>
            <td>' . $snotes . '</td>
            <td>
            <button class="btn btn-primary">
                        <a href="update.php?updateid=' . $activityId . '" style="text-decoration:none;" class="text-light">Update</a>
                    </button>
                    <button class="btn btn-danger">
                        <a href="delete.php?deleteid=' . $activityId . '" style="text-decoration:none;" class="text-light">Delete</a>
                    </button></td>
            </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "No results found.";
}

// Close connection
$conn->close();
?>

    </div>
</body>
</html>