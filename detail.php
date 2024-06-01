<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Details of Project</title>
</head>
<body>
    <div class="container">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Project ID</th>
      <th scope="col">Project Name</th>
      <th scope="col">Team Leader</th>
      <th scope="col">Team Member</th>
      <th scope="col">Description</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col" colspan="3">Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "database.php";
    $sql="Select * from projects";
    $result=mysqli_query($conn,$sql);
    if($result){
       while($row=mysqli_fetch_assoc($result)){
        $projectId=$row['projectId'];
        $projectName=$row['projectName'];
        $teamLeader=$row['teamLeader'];
        $teamMember=$row['teamMember'];
        $description=$row['description'];
        $startDate=$row['startDate'];
        $endDate=$row['endDate'];
        
        echo '<tr>
        <th scope="row">'.$projectId.'</th>
        <td>'.$projectName.'</td>
        <td>'.$teamLeader.'</td>
        <td>'.$teamMember.'</td>
        <td>'.$description.'</td>
        <td>'.$startDate.'</td>
        <td>'.$endDate.'</td>
        <td><button class="btn btn-primary"><a href="update.php?updateid='.$projectId.'" style="text-decoration:none;" class="text-light">Update</a></button></td>
        <td><button class="btn btn-danger"><a href="delete.php?deleteid='.$projectId.'" style="text-decoration:none;" class="text-light">Delete</a></button></td>
        <td><button class="btn btn-success"><a href="activity.php?projectId='.$projectId.'" style="text-decoration:none;" class="text-light">Add Activity</a></button></td>
        </tr>';
       }
    }
    ?>
   
  </tbody>
</table>
       
    </div>
</body>
</html>