<?php 

include "includes/connect.php";
if(isset($_POST['id']) && isset($_POST['operation']))
{
    $id = $_POST['id'];
    $op = $_POST['operation'];
    
    if($op==1)
    {
        $query= "UPDATE sample_request SET is_confirmed = 1 WHERE id = ?";
    }
    else if($op==0)
    {
        $query= "DELETE FROM sample_request WHERE id = ?";

    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if($stmt->affected_rows)
    {
        echo ($op==1)?"confirmed":($op==0?'deleted':'');
    }
    
}


?>