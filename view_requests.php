<?php  
    // include 'includes/check_login.php';
    include "includes/connect.php";
    include 'includes/header.php';
    include 'includes/top-navbar.php';
    
    if(!isset($_SESSION['hospital_id']))
    {
        header('location:login3.php');
    }

   
    

?>


  <?php 
  ?>
    <div class="container py-5 ">

    <?php 
        // $query = "SELECT h.*, b.* FROM blood_units b INNER JOIN hospitals h ON h.id = b.hospital_id";
        $query = "SELECT s.*, u.*, s.id s_id FROM sample_request s INNER JOIN users u ON  u.id = s.user_id WHERE s.hospital_id = ?";
        $stmt = $conn->prepare($query);
        $_SESSION['hospital_id'];
        $stmt->bind_param('i', $_SESSION['hospital_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $i=1;
        
        // var_dump($rows);

    ?>

<table class="table table-striped" id="request_table">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>
      <th scope="col">Blood Group & type</th>
      <!-- <th scope="col">No. Of Units</th> -->
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        foreach($rows as $row)
        {
          
    ?>
    <tr>
      <th scope="row"><?= $i ?></th>
      <td><?= $row['name'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= $row['b_group'].$row['b_type'] ?></td>
      <td>
        <?php 
          if($row['is_confirmed']==0)
          {

          
        ?>
        <button class="btn btn-primary" id="confirm<?= $row['id']?>" onclick="authorize_request(<?= $row['s_id']?>, 1, 0)">Confirm</button>
        <button class="btn btn-danger" id="delete<?= $row['id']?>" onclick="authorize_request(<?= $row['s_id']?>, 0, <?=$i?>)">Delete</button>

        <?php 
          
          }
          else if($row['is_confirmed'] ==1)
          {

            ?>
            <button class="btn btn-success" id="confirmed<?= $row['id'] ?>">Confirmed</button>

        <?php 
        
        }
        ?>
      </td>
      
      <td>

      </td>
    </tr>

    <?php 
    $i++;
        }
    ?>
  </tbody>
</table>
    
    <!-- jquery data table  -->

        
    </div>

    <?php 
      include 'includes/footer.php';
    ?>
<!-- <script src="registration.js"></script> -->


<script>

$("#request_table").DataTable();

  function authorize_request(id, op, rowId)
  {
    console.log('authorize request came with ', id, op);
    var confirm_delete = false;
    if(op==0)
    {
      
      if(confirm('Are you sure you want to delete this request ?') == true)
      {
        confirm_delete = true;
      }
    }
    if(op==1 || confirm_delete==true)
    {
      $.ajax({
      url:'authorize_request.php',
      method:'POST',
      data :{
        id:id,
        operation:op
      },
      success:function(data)
      {
        alert(data);
        console.log(data);
        if(data.includes('confirmed'))
        {
          $("#confirm"+id).hide();
          $("#delete"+id).hide();
          $("#confirmed"+id).show();
        }
        if(data.includes('deleted'))
        {
          document.getElementById('request_table').deleteRow(rowId);
        }
      }
    });
    }
    
  }
  
  
</script>

</html