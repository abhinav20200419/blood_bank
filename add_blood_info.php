<?php  
    session_start();
    include "includes/connect.php";
    $_SESSION['hospital_id'] = 2;

    if(isset($_POST['blood']))
    {
        $hospital_id = $_SESSION['hospital_id'];
        $b_group = $_POST['blood_group'];
        $b_type = $_POST['blood_type'];
        $units = $_POST['units'];

        $query = "INSERT INTO blood_units (hospital_id, b_group, b_type, units) VALUES(:h_id, :b_group, :b_type, :units)";
        $stmt = $conn_PDO->prepare($query);
        $stmt->bindParam(':h_id', $hospital_id, PDO::PARAM_INT);
        $stmt->bindParam(':b_group', $b_group);
        $stmt->bindParam(':b_type', $b_type);
        $stmt->bindParam(':units', $units, PDO::PARAM_INT);

        $stmt->execute();
    }

   
    

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
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="registration.js"></script>


</html