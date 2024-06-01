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

    // SQL query to fetch activities and their associated subactivities
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
            FROM 
                activity 
            LEFT JOIN 
                subactivity ON activity.activityId = subactivity.activityId 
            ORDER BY 
                activity.activityId, 
                subactivity.subactivityId;";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Initialize variables to track the current activity
        $currentActivityId = null;
        $currentActivityData = null;

        while ($row = mysqli_fetch_assoc($result)) {
            $activityId = $row['activityId'];

            // If it's a new activity, display the activity row and reset current activity data
            if ($activityId != $currentActivityId) {
                if ($currentActivityId !== null) {
                    echo '</tbody></table>';
                }

                $currentActivityId = $activityId;
                $currentActivityData = $row;

                // Display activity row
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

                echo '<tr>
                        <th scope="row">' . $currentActivityData['activityId'] . '</th>
                        <td>' . $currentActivityData['activityName'] . '</td>
                        <td>' . $currentActivityData['activityStartDate'] . '</td>
                        <td>' . $currentActivityData['activityEndDate'] . '</td>
                        <td>' . $currentActivityData['responsibility'] . '</td>
                        <td>' . $currentActivityData['notes'] . '</td>
                        <td>
                            <button class="btn btn-primary">
                                <a href="update.php?updateid=' . $currentActivityData['activityId'] . '" style="text-decoration:none;" class="text-light">Update</a>
                            </button>
                            <button class="btn btn-danger">
                                <a href="delete.php?deleteid=' . $currentActivityData['activityId'] . '" style="text-decoration:none;" class="text-light">Delete</a>
                            </button>
                        </td>
                    </tr>';
            }

            // Display subactivity if exists
            if (!empty($row['subactivityId'])) {
                echo '<tr>
                        <td>' . $row['subactivityId'] . '</td>
                        <td>' . $row['sactivityName'] . '</td>
                        <td>' . $row['sactivityStartDate'] . '</td>
                        <td>' . $row['sactivityEndDate'] . '</td>
                        <td>' . $row['sresponsibility'] . '</td>
                        <td>' . $row['snotes'] . '</td>
                        <td>
                            <button class="btn btn-primary">
                                <a href="update_subactivity.php?updateid=' . $row['subactivityId'] . '" style="text-decoration:none;" class="text-light">Update</a>
                            </button>
                            <button class="btn btn-danger">
                                <a href="delete_subactivity.php?deleteid=' . $row['subactivityId'] . '" style="text-decoration:none;" class="text-light">Delete</a>
                            </button>
                        </td>
                    </tr>';
            }
        }

        // Close the last activity table
        if ($currentActivityId !== null) {
            echo '</tbody></table>';
        }
    } else {
        echo "No results found.";
    }

    $conn->close();
    ?>
    </div>
</body>
</html>
