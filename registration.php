<?php  
    include "includes/connect.php";

    $user_exists = 0;
    $hospital_exists = 0;

    if(isset($_POST['submit_user']))
    {
        $user_email = $_POST['u_email'];
        $user_name = $_POST['u_name'];
        $user_password = $_POST['u_password'];
        $b_group = $_POST['blood_group'];
        $b_type = $_POST['blood_type'];

        $query_check = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param('s', $user_email);
        $stmt_check->execute();
        
        $result_check = $stmt_check->get_result();
        $row_num = $result_check->num_rows;
        if($row_num)
        {
            $user_exists = 1;
        }

        $query = "INSERT INTO users (email, name, password, b_group, b_type) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $user_email, $user_name, $user_password, $b_group, $b_type);
        $stmt->execute();

        if($stmt)
        {
            header('location:login3.php');
        }

    }
    
    if(isset($_POST['submit_hospital']))
    {
        $h_name = $_POST['h_name'];
        $h_address = $_POST['h_address'];
        $state = $_POST['state'];
        $h_email = $_POST['h_email'];
        $h_password = $_POST['h_password'];
        
        $h_image = $_FILES['h_image']['name'];
        $h_image_tmp = $_FILES['h_image']['tmp_name'];

        $query_check = "SELECT * FROM hospitals WHERE email = :email OR name = :name";
        

        $stmt_check = $conn_PDO->prepare($query_check);
        $stmt_check->bindParam(':email', $h_email);
        $stmt_check->bindParam(':name', $h_name);
        $stmt_check->execute();
        $count = $stmt_check->rowCount();

        if($count)
        {
            $hospital_exists  = 1;
        }


            $query = "INSERT INTO hospitals (name, address, state, email, password, image) VALUES(:name, :address, :state, :email, :password, :image)";
            // $query = "INSERT INTO hospitals (name, address, state, email, password) VALUES(?, ?, ?, ?, ?)";

            // $stmt = $conn->prepare($query);
            // $stmt->bind_param('sssss', $h_name, $h_address, $state, $h_email, $h_password);
            // $stmt->execute();
    /* The line ` = "INSERT INTO hospitals (name, address, state, email, password)
    VALUES(:name, :address, :state, :email, :password)";` is preparing an SQL query to insert
    data into the `hospitals` table. */

            $stmt = $conn_PDO->prepare($query);
            // exit();
            $stmt->bindParam(':name', $h_name);
            $stmt->bindParam(':address', $h_address);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':email', $h_email);
            $stmt->bindParam(':password', $h_password);
            $stmt->bindParam(':image', $h_image);
            $stmt->execute();

            
        if($stmt)
        {
            move_uploaded_file($h_image_tmp, 'uploads/'.$h_image);   
            header('location:login3.php');

        }

    }
?>


<?php 
    include 'includes/header.php';
    include 'includes/top-navbar.php';

?>
    <div class="container py-5 ">

            <?php 
                if($hospital_exists==1)
                {
                 
            ?>
            <div class="alert alert-danger col-6" role="alert">
                Ooops🥺,  Hospital already exists with this email or hospital name !!!<br>
                Try again with different email...
            </div>  
            <?php 
                }
            ?>

            <?php 
                if($user_exists==1)
                {
                 
            ?>
            <div class="alert alert-danger col-6" role="alert">
                Ooops🥺,  User already exists with this email !!!<br>
                Try again with different email...
            </div>  
            <?php 
                }
            ?>


    <div id="button" class="mb-5 px-5">
        <h4>Click on the below button to open the registration form</h4>
        <button class="btn btn-secondary btn-lg mr-4" id="hospital_btn">
            Hospital Registration
        </button>
        <button class="btn btn-secondary btn-lg ml-4" id="user_btn">
            User Registration
        </button>
    </div>
        <!-- hospital form  -->
        <form action="" method="POST" enctype="multipart/form-data" id="hospital_form" style="display:none;">
            <div class="form-group col-6">
                <label for="name">Hospital Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter hospital name" name="h_name" required>
                
            </div>
            <div class="form-group col-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="h_address" aria-describedby="emailHelp" placeholder="Enter hospital address" name="h_address" required>
                
            </div>
            <div class="form-group col-6">
                <label for="state">State</label>
                <select name="state" id="state" class="form-control " required>
                    <option value="">Select State</option>
                    <option value="haryana">haryana</option>
                    <option value="delhi">delhi</option>
                    <option value="rajasthan">rajasthan</option>
                </select>
                
            </div>
            <div class="form-group col-6">
                <label for="image">Hospital Image</label>
                <input type="file" class="form-control" id="email" aria-describedby="emailHelp"  name="h_image" oninput="check_size(this)" required>
                
            </div>
            <div class="form-group col-6">
                <label for="email">Hospital Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter hospital name" name="h_email" required>
                
            </div>
            <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="h_password" name="h_password" aria-describedby="emailHelp"
                 placeholder="Enter password" required>
                
            </div>
            <div class="form-group col-6">
                <label for="h_password2">Confirm Password</label>
                <input type="password" class="form-control" id="h_password2" placeholder="Enter your password again" oninput="match_password('h_password', 'h_password2')" required>
                <span class="text-danger mx-3 " id="h_password_span" style="display:none;">password doesn't match</span>
                <i class="fa-solid fa-check fa-2x text-success mx-3" style="display:none;" id="h_password_icon"></i>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit_hospital" id="h_btn">Submit</button>
        </form>

        <!-- user form  -->
        <form action="" method="POST" enctype="multipart/form-data" id="user_form" style="display:none;">
            <div class="form-group col-6">
                <label for="u_name">User Name</label>
                <input type="text" class="form-control" id="u_name" aria-describedby="emailHelp" placeholder="Enter user name" name="u_name" required>
                
            </div>
            <div class="form-group col-6">
                <label for="u_email">User Email</label>
                <input type="email" class="form-control" id="u_email" aria-describedby="emailHelp" placeholder="Enter user name" name="u_email" required>
                
            </div>
            <div class="form-group col-6">
                <label for="blood_group">Blood Group</label>
                <select name="blood_group" id="blood_group" class="form-control " required>
                    <option value="">Select blood group</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
                
            </div>
            <div class="form-group col-6">
                <label for="blood_type">Blood Group Type</label>
                <select name="blood_type" id="blood_type" class="form-control " required>
                    <option value="">Select blood group type</option>
                    <option value="+">+</option>
                    <option value="-">-</option>
                </select>
                
            </div>
            <div class="form-group col-6">
                <label for="u_password">Password</label>
                <input type="text" class="form-control" id="u_password" name="u_password" aria-describedby="emailHelp" placeholder="Enter password" required>
                
            </div>
            <div class="form-group col-6">
                <label for="u_password2">Confirm Password</label>
                <input type="password" class="form-control" id="u_password2" placeholder="Enter your password again"
                oninput="match_password('u_password', 'u_password2')" required>
                <span class="text-danger mx-3 " id="u_password_span" style="display:none;">password doesn't match</span>
                <i class="fa-solid fa-check fa-2x text-success mx-3" style="display:none;" id="u_password_icon"></i>
            </div>
            
            <button type="submit" class="btn btn-primary submit-button " name="submit_user" id="u_btn" disabled data-toggle="popover" data-placement = "right" data-content = "Entered password and confirm password doesn't match">Submit</button>
        </form>
    </div>

    
<?php 
    include 'includes/footer.php';

?>
<!-- </body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<script src="registration.js"></script>
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