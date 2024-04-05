<?php  
    include 'includes/check_login.php';
    include "includes/connect.php";

    

   
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5 ">

    <?php 
        $query = "SELECT h.*, b.* FROM blood_units b INNER JOIN hospitals h ON h.id = b.hospital_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        
        // var_dump($rows);

    ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Hospital Name</th>
      <th scope="col">Blood Group & type</th>
      <th scope="col">No. Of Units</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        foreach($rows as $row)
        {
            
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        
    ?>
    <tr>
      <th scope="row"><?= $row['id'] ?></th>
      <td><?= $row['name'] ?></td>
      <td><?= $row['b_group'].$row['b_type'] ?></td>
      <td><?= $row['units'] ?></td>
      <td>
        <button class="btn btn-primary" <?= $is_u_login?'':'disabled' ?>>Request Sample</button><br>
        <span><small><?= $is_u_login?'':'login to enable this button' ?></small></span>
    </td>
    </tr>

    <?php 
        }
    ?>
  </tbody>
</table>
    
    <!-- jquery data table  -->

        
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="registration.js"></script>


</html