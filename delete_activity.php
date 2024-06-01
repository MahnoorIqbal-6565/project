<?php 
include "database.php";
if(isset($_GET['deleteid'])){
    $activityId = $_GET['deleteid'];
    
    $sql = "DELETE FROM activity WHERE activityId = ?";
 
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt, $sql)){
        
        mysqli_stmt_bind_param($stmt, "s", $activityId);
        if(mysqli_stmt_execute($stmt)){
            
            header('Location: displayactivity.php');
            exit(); 
        } else {
            die("Error executing statement: " . mysqli_error($conn));
        }
    } else {
        die("Error preparing statement: " . mysqli_error($conn));
    }
}
?>