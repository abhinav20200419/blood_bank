<?php  
    // session_start();
    include "includes/connect.php";
    
    include 'includes/header.php';
    include 'includes/top-navbar.php';
    // $_SESSION['hospital_id'] = 2;
    if(!isset($_SESSION['hospital_id']))
    {
        header('location:login3.php');
    }

    if(isset($_POST['blood']))
    {
        $hospital_id = $_SESSION['hospital_id'];
        $b_group = $_POST['blood_group'];
        $b_type = $_POST['blood_type'];
        $units = $_POST['units'];

        $check = "SELECT * FROM blood_units WHERE hospital_id = :h_id AND b_group = :bg AND b_type = :bt";
        $stmt_check = $conn_PDO->prepare($check);
        $stmt_check->bindParam(':h_id', $hospital_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':bg', $b_group);
        $stmt_check->bindParam(':bt', $b_type);
        $stmt_check->execute();
        $coun_check = $stmt_check->rowCount();
        if(!$coun_check)
        {

            $query = "INSERT INTO blood_units (hospital_id, b_group, b_type, units) VALUES(:h_id, :b_group, :b_type, :units)";
            $stmt = $conn_PDO->prepare($query);
            $stmt->bindParam(':h_id', $hospital_id, PDO::PARAM_INT);
            $stmt->bindParam(':b_group', $b_group);
            $stmt->bindParam(':b_type', $b_type);
            $stmt->bindParam(':units', $units, PDO::PARAM_INT);
    
            $stmt->execute();
        }
        else
        {
            $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
            $new_units = $row['units'] + $units;
            
            $update = "UPDATE blood_units SET units = :units WHERE hospital_id = :h_id AND b_group = :bg AND b_type = :bt";
            $stmt_update = $conn_PDO->prepare($update);
            $stmt_update->bindParam(':units', $new_units, PDO::PARAM_INT);
            $stmt_update->bindParam(':h_id', $hospital_id, PDO::PARAM_INT);
            $stmt_update->bindParam('bg', $b_group);
            $stmt_update->bindParam('bt', $b_type);
            $stmt_update->execute();
        }

    }

   
    
?>


    <div class="container py-5 ">


        <!-- add blood form  -->
        <form action="" method="POST" enctype="multipart/form-data" >
            <div class="row">
                <div class="form-group col-3">
                    <label for="blood_group">Blood Group</label>
                    <select name="blood_group" id="blood_group" class="form-control ">
                        <option value="">Select blood group</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="O">O</option>
                        <option value="AB">AB</option>
                    </select>
                    
                </div>
                <div class="form-group col-3">  
                    <label for="blood_group">Blood Group Type</label>
                    <select name="blood_type" id="blood_type" class="form-control ">
                        <option value="">Select blood group type</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                    
                </div>
                <div class="form-group col-3">
                    <label for="units">No. of units</label>
                    <input type="text" class="form-control" id="units" name="units" aria-describedby="emailHelp" placeholder="Enter units of blood">
                    
                </div>

                
            </div>
            
            
            <button type="submit" class="btn btn-primary" name="blood" id="h_btn">Add blood </button>
        </form>

        
    </div>
<?php 
    include 'includes/footer.php';
?>
<script src="registration.js"></script>


</html