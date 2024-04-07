<?php  
    // include 'includes/check_login.php';
    include "includes/connect.php";
    include 'includes/header.php';
    

   
    

?>



  <?php 
    include 'includes/top-navbar.php';
    $is_h_login = 0;
    $is_u_login = 0;

    if(isset($_SESSION['hospital_id']))
    {
        $is_h_login = 1;
    }

    if(isset($_SESSION['user_id']))
    {
        $is_u_login = 1;
    }
  ?>
    <div class="container py-5 ">

    <?php 
        $query = "SELECT h.*, b.*, h.id as hospital_id FROM blood_units b INNER JOIN hospitals h ON h.id = b.hospital_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $i=0;
        
        // var_dump($rows);

    ?>

<table class="table table-striped" id="index_table">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Hospital Name</th>
      <th scope="col">Hospital Image</th>
      <th scope="col">Blood Group & type</th>
      <th scope="col">No. Of Units</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        foreach($rows as $row)
        {
          $i++;
          $query_request_check = "SELECT * FROM sample_request WHERE hospital_id = :h_id AND user_id = :u_id";
          // echo "hospital_iddd".$row['hospital_id'];
          // echo "user_iddd".$_SESSION['user_id']."<br>";
          $stmt_request_check = $conn_PDO->prepare($query_request_check);
          $stmt_request_check->bindParam(':h_id', $row['hospital_id'], PDO::PARAM_INT);
          $stmt_request_check->bindParam(':u_id', $_SESSION['user_id'], PDO::PARAM_INT);
          $stmt_request_check->execute();
          $count_request_check = $stmt_request_check->rowCount();

          $blood_group_matches = 0;
          if(isset($_SESSION['user_blood_group']))
          {

            $user_blood_group = $_SESSION['user_blood_group'];
            if($row['b_group'] == substr($user_blood_group, 0, -1) && $row['b_type'] == substr($user_blood_group, -1))
            {
              $blood_group_matches = 1;
            }
          }

          $hospital_user_same = 0; 
          if(isset($_SESSION['user_id']) && isset($_SESSION['hospital_id']))
          {
            if($_SESSION['user_id'] == $_SESSION['hospital_id'])
            {
              $hospital_user_same = 1;
            }
            else
            {
              $hospital_check = "";
            }
          }
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        
    ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $row['name'] ?></td>
      <td> <img src="uploads/<?= $row['image'] ?>" alt="hospital image" class="w-50 h-50 rounded-circle" > </td>
      <td><?= $row['b_group'].$row['b_type'] ?></td>
      <td><?= $row['units'] ?></td>
      <td>

        <?php 
          if($blood_group_matches && !$hospital_user_same)
          {
        ?>
        <button class="btn btn-success" id="sent<?= $row['id'] ?>" 
        <?= ($count_request_check==0)?'style="display:none;"':''  ?>>Request Sent</button>

        <button class="btn btn-primary" id="to_sent<?= $row['id'] ?>" 
        onclick="request(<?= $_SESSION['user_id'] ?>, <?= $row['hospital_id'] ?>, '<?= $row['b_group'] ?>', '<?= $row['b_type'] ?>', <?= $row['units'] ?>, <?=$row['id']?>)" 
        <?= $is_u_login?'':'disabled' ?>
        <?= ($count_request_check >=1)?'style="display:none;"':''  ?>
        >Request Sample</button><br>
        <span><small><?= $is_u_login?'':'login to enable this button' ?></small></span>

        <?php 
          }
          else if($hospital_user_same)
          {
        ?>
          Hospitals not allowed to request
        <?php
          }

          else
          {
            ?>

          <small>
            your blood group doesn't matched
          </small>
          <?php 
          }
        ?>
      </td>
    </tr>

    <?php 
        }
    ?>
  </tbody>
</table>
    
    <!-- jquery data table  -->

        
    </div>

    <?php 
      include 'includes/footer.php';
    ?>
<script src="registration.js"></script>


<script>

$("#index_table").DataTable();

  function request(u_id, h_id, b_group, b_type, units,id)
  {
    $.ajax({
      url : 'request_sample.php',
      method : 'POST',
      data : {
        id: u_id,
        bg: b_group,
        bt: b_type,
        // units : units,   
        h_id : h_id
      },
      success: function(data){
        console.log(data);  
        if(data)
        {
          $("#to_sent"+id).hide();
          $("#sent"+id).show();

        }
      }
    });
  }
</script>

</html