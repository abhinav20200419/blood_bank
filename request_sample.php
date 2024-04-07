<?php 

include "includes/connect.php";

if(isset($_POST['id']))
{
    $user_id = $_POST['id'];
    $b_group = $_POST['bg'];
    $b_type = $_POST['bt'];
    // $units = $_POST['units'];
    $hospital_id = $_POST['h_id'];

    $query = "INSERT INTO sample_request  (hospital_id, user_id,  b_group, b_type) VALUES(:h_id, :u_id, :b_group, :b_type)";
        

    $stmt = $conn_PDO->prepare($query);
    // exit();
    $stmt->bindParam(':h_id', $hospital_id);
    $stmt->bindParam(':u_id', $user_id);
    // $stmt->bindParam(':units', $units);
    $stmt->bindParam(':b_group', $b_group);
    $stmt->bindParam(':b_type', $b_type);
    echo $stmt->execute();
}

?>