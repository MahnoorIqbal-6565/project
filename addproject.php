
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
        require_once "database.php";
        if (isset($_POST["save"])) {
           $projectName = $_POST["projectName"];
           $teamLeader = $_POST["teamLeader"];
           $teamMember = $_POST["teamMember"];
           $description = $_POST["description"];
           $startDate= $_POST["startDate"];
           $endDate = $_POST["endDate"];
           
           $errors = array();
           
           if (empty($projectName) OR empty($teamLeader) OR empty($teamMember) OR empty($description) OR empty($startDate) OR empty($endDate)) {
            array_push($errors,"All fields are required");
           }
         else{
            
            $sql = "INSERT INTO projects (projectName, teamLeader, teamMember, description, startDate, endDate) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $projectName, $teamLeader, $teamMember, $description, $startDate, $endDate);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Saved successfully.</div>";
            } else
             {
                die("Something went wrong");
            }
            
        }

        }
        ?>
        <form action="addproject.php" method="post">
            <label for="projectname">Project Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="projectName" placeholder="Enter Your Project Name:">
            </div>
            <label for="teamleader">Team Leader Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="teamLeader" placeholder="Enter Your TeamLeader Name:">
            </div>
            <label for="teammember">Team Member Name: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="teamMember" placeholder="Enter Your Team member:">
            </div>
            <label for="description">Project Description: </label>
            <div class="form-group">
                <input type="text" class="form-control" name="description" placeholder="Enter Project Description:">
            </div>
            <label for="startdate">Start Date:</label>
            <div class="form-group">
                <input type="date" class="form-control" name="startDate" placeholder="Enter The Project Start Date:">
            </div>
            <label for="enddate">End Date:</label>
            <div class="form-group">
                <input type="date" class="form-control" name="endDate" placeholder="Enter The Project End Date:">
            </div>
            <div  style="display:flex; flex-direction: row;align-items: center;justify-content: space-between;">
            <div class="form-btn">
                <input style="width: 150px;" type="submit" class="btn btn-primary" value="Save" name="save">
            </div>
            <div class="form-btn">
            <a style="width: 150px;" class="btn btn-primary" href="detail.php">Details</a>

            </div>
            </div>
        </form>
        <div>
       
      </div>
    </div>
</body>
</html>