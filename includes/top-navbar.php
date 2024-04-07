<?php 
    // include 'includes/check_login.php';
    session_start();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">Blood Bank</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php 
        if(isset($_SESSION['hospital_id']))
        {

        
      ?>
      <li class="nav-item">
        <a class="nav-link" href="./add_blood_info.php">Add Blood</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./view_requests.php">View Blood Requests</a>
      </li>

      <?php 
        }   
      ?>
      
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <?php  

    if(isset($_SESSION['user_id']) || isset($_SESSION['hospital_id']))
    {
        // echo "user_id:".$_SESSION['user_id'];
        // echo "hospital_id:".$_SESSION['hospital_id'];
    
    ?>
    <button class="btn btn-outline-success my-2 my-sm-0" >
        <a href="./logout.php" class="text-info">Logout</a>
    </button>
    <?php  
    }

    else
    {

    
    ?>

    <button class="btn btn-outline-success my-2 mr-1 my-sm-0" type="submit">
        
       <a href="./login3.php" class="text-success">LogIn</a>
    </button>
    <button class="btn btn-outline-success my-2 ml-1 my-sm-0" type="submit">
        
        <a href="./registration.php" class="text-success">SignUp</a>
    </button>
    
    <?php 
    }
    ?>

    
  </div>
</nav>