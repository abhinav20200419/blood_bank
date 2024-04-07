<?php  
// session_start();
    include "includes/connect.php";
    include 'includes/header.php';
    include 'includes/top-navbar.php';

    $is_user_login = -1;
    $is_hospital_login = -1;

    if(isset($_POST['submit_user']))
    {
        $user_email = $_POST['u_email'];
        $user_password = $_POST['u_password'];

        // $query = "INSERT INTO users (email, name, password, b_group, b_type) VALUES(?, ?, ?, ?, ?)";
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $user_email, $user_password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_num = $result->num_rows;
        $row = $result->fetch_assoc();
        // exit();
        if($row_num)
        {
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
            // echo $row['id'];
            $is_user_login = 1;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_blood_group'] = $row['b_group'].$row['b_type'];

            header('location:index.php');
        }
        else{
            $is_user_login = 0;
        }

    }
    
    if(isset($_POST['submit_hospital']))
    {
        $h_email = $_POST['h_email'];
        $h_password = $_POST['h_password'];

        // $query = "INSERT INTO hospitals (name, address, state, email, password) VALUES(:name, :address, :state, :email, :password)";
        $query = "SELECT * FROM hospitals WHERE email = :email AND password = :password";
        

        $stmt = $conn_PDO->prepare($query);
        $stmt->bindParam(':email', $h_email);
        $stmt->bindParam(':password', $h_password);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count)
        {
            echo "<pre>";
            print_r($row);
            echo "</pre>";

            $is_hospital_login = 1;
            $_SESSION['hospital_id'] = $row['id'];
            header('location:index.php');
        }
        else{
            $is_hospital_login = 0;
            echo "<script>alert('no')</script>";
            // echo "<script>$('#hospital_form').show();</script>";
            // echo "<script>document.getElementById('hospital_form').style.display = 'block';</script>";
        }


    }
?>


    <div class="container py-5 ">

    

            <?php 
                if($is_hospital_login==0)
                {
                 
            ?>
            <div class="alert alert-danger col-6" role="alert">
                Ooops🥺,  Invalid Credentials !!!
                Try again...
            </div>  
            <?php 
                }
            ?>
    <div id="button" class="mb-5 px-5">
        <h4>Click on the below button to open the login form</h4>
        <button class="btn btn-secondary btn-lg mr-4" id="hospital_btn">
            Hospital login
        </button>
        <button class="btn btn-secondary btn-lg ml-4" id="user_btn">
            User login
        </button>
    </div>
        <!-- hospital form  -->
        
        <form action="" method="POST" enctype="multipart/form-data" id="hospital_form" style="display:none;">
            
            <div class="form-group col-6">
                <label for="email">Hospital Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter hospital email" name="h_email">
                
            </div>
            <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="h_password" name="h_password" aria-describedby="emailHelp" placeholder="Enter password">
                
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit_hospital" id="h_btn">Submit</button>
        </form>

        <!-- user form  -->
        <form action="" method="POST" enctype="multipart/form-data" id="user_form" style="display:none;">
            
            <div class="form-group col-6">
                <label for="u_email">User Email</label>
                <input type="email" class="form-control" id="u_email" aria-describedby="emailHelp" placeholder="Enter user email" name="u_email" required>
                
            </div>
            <div class="form-group col-6">
                <label for="u_password">Password</label>
                <input type="password" class="form-control" id="u_password2" name="u_password" aria-describedby="emailHelp" placeholder="Enter password" required>
                
            </div>

            <button type="submit" class="btn btn-primary submit-button " name="submit_user" id="u_btn"  data-toggle="popover" data-placement = "right" data-content = "Entered password and confirm password doesn't match">Submit</button>
        </form>
    </div>

<?php 

    include 'includes/footer.php';
?>
<script src="login.js"></script>
<script>
    $(document).ready(function(){
        $("#hospital_form").hide();
        $("#user_form").hide();
        
        $("#user_btn").on('click', function(){
            $("#hospital_form").hide();
            $("#user_form").show();
            
        });
        
        $("#hospital_btn").on('click', function(){
            $("#hospital_form").show();
            $("#user_form").hide();
            
        });
    });
</script>

</html>