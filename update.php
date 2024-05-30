<?php
include "database.php";

// Check if updateid is set in the URL
if(isset($_GET['updateid'])){
    $projectName = $_GET['updateid'];
    
    // Fetch the record based on updateid
    $sql="SELECT * FROM projects WHERE projectName = '$projectName'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    
    // Assign fetched values to variables
 
    $teamLeader = $row['teamLeader'];
    $teamMember = $row['teamMember'];
    $description = $row['description'];
    $startDate = $row['startDate'];
    $endDate = $row['endDate'];
}

// Check if the form is submitted
if(isset($_POST['update'])){
    $projectName = $_POST['projectName'];
    $teamLeader = $_POST['teamLeader'];
    $teamMember = $_POST['teamMember'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    
    // Update the record
    $sql = "UPDATE projects SET projectName='$projectName', teamLeader='$teamLeader', teamMember='$teamMember', description='$description', startDate='$startDate', endDate='$endDate' WHERE projectName='$projectName'";
    $result=mysqli_query($conn,$sql);
    
    // Check if update was successful
    if($result){
        echo "<div class='alert alert-success'>Update the record successfully!</div>";
    } else {
        die(mysqli_error($conn));
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
    <title>Update Record</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <label for="projectname">Project Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="projectName" placeholder="Enter Your Project Name:" value="<?php echo $projectName?>">
            </div>
            <label for="teamleader">Team Leader Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="teamLeader" placeholder="Enter Your TeamLeader Name:" value="<?php echo $teamLeader?>">
            </div>
            <label for="teammember">Team Member Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="teamMember" placeholder="Enter Your Team member:" value="<?php echo $teamMember?>">
            </div>
            <label for="description">Project Description: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="description" placeholder="Enter Project Description:" value="<?php echo $description?>">
            </div>
            <label for="startdate">Start Date:</label>
            <div class="form-group">
                <input type="date" class="form-control" name="startDate" placeholder="Enter The Project Start Date:" value="<?php echo $startDate?>">
            </div>
            <label for="enddate">End Date:</label>
            <div class="form-group">
                <input type="date" class="form-control" name="endDate" placeholder="Enter The Project End Date:" value="<?php echo $endDate?>">
            </div>
            <div  style="display:flex; flex-direction: row;align-items: center;justify-content: space-between;">
                <div class="form-btn">
                    <input style="width: 150px;" type="submit" class="btn btn-primary" value="Update" name="update">
                </div>
                <div class="form-btn">
                    <a style="width: 150px;" class="btn btn-primary" href="detail.php">Details</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
