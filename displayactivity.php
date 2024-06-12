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
    <th scope="col">Activity Id</th>
      <th scope="col">Activity Name</th>
      <th scope="col">Activity Start Date</th>
      <th scope="col">Activity End Date</th>
      <th scope="col">Responsible Person Name</th>
      <th scope="col">Notes</th>
      <th scope="col" colspan="3">Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "database.php";
    $sql="Select * from activity";
    $result=mysqli_query($conn,$sql);
    if($result){
       while($row=mysqli_fetch_assoc($result)){
        $activityId=$row['activityId'];
        $activityName=$row['activityName'];
        $activityStartDate=$row['activityStartDate'];
        $activityEndDate=$row['activityEndDate'];
        $responsibility=$row['responsibility'];
        $notes=$row['notes'];
        $projectId=$row['projectId'];
        
        echo '<tr>
        <th scope="row">'.$activityId.'</th>
        <td>'.$activityName.'</td>
        <td>'.$activityStartDate.'</td>
        <td>'.$activityEndDate.'</td>
        <td>'.$responsibility.'</td>
        <td>'.$notes.'</td>
        <td><button class="btn btn-primary"><a href="update_activity.php?updateid='.$activityId.', projectId='.$projectId.'" style="text-decoration:none;" class="text-light">Update</a></button></td>
        <td><button class="btn btn-danger"><a href="delete_activity.php?deleteid='.$activityId.'" style="text-decoration:none;" class="text-light">Delete</a></button></td>
        <td><button class="btn btn-success"><a href="subactvityform.php?activityId='.$activityId.'" style="text-decoration:none;" class="text-light">Add SubActivity</a></button></td>
        </tr>';
       }
    }
    ?>
   
  </tbody>
</table>
       
    </div>
</body>
</html>