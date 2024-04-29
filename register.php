<?php
session_start();
require 'includes/database-connection.php'; 

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $join_date = date('Y-m-d'); // Get the current date in the specified format

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

       
        $id_stmt = $pdo->query("SELECT MAX(custID) as max_id FROM cust_info_table");
        $id_result = $id_stmt->fetch(PDO::FETCH_ASSOC);
        $next_id = $id_result ? $id_result['max_id'] + 1 : 1; 

        
        $stmt = $pdo->prepare("INSERT INTO cust_info_table (custID, fname, lname, email, password, join_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$next_id, $fname, $lname, $email, $password, $join_date]);

        if ($stmt->rowCount()) {
            echo "User registered successfully!";
        } else {
            echo "No rows were inserted - please check your data.";
        }
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();  
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<title>NILE: Login</title>
  		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <style>
        :root {
            --backgroundColor: #CCDAD1; /* Assuming this is a dark background */
            --pallete1: #6F6866; /* Gray */
            --pallete2: #788585; /* Lighter Gray */
            --pallete3: #9CAEA9; /* Green */
            --pallete4: #CCDAD1; /* Light Green */
            --pallete5: #F8F8F8; /* Off White */
            --pallete6: #000000; /* Black */
        }
        body {
            padding-top: 20px;
            background-color: var(--backgroundColor);
            color: var(--pallete1); /* Primary text color now green */
        }
        label {
            color: var(--pallete6);
        }
        h1 {
          color: var(--pallete5)
        }
        h5 {
            color: var(--pallete6);
        }
        p {
            color: var(--pallete6);
        }
        .container {
            max-width: 600px;
            background-color: var(--pallete5); 
            color: var(--pallete2); /* Secondary text color */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding: 20px; 
            padding-bottom: 40px; 
}

        .card {
           background-color: var(--pallete3); /* Card background */
           width: 80%; 
           max-height: 800px; 
           max-width: 480px; 
           margin: 20px auto; 
           padding: 20px; 
           box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
           border-radius: 8px; 
}
        .btn-primary {
            background-color: var(--pallete1); /* Main green color for primary buttons */
            border-color: var(--pallete4);
        }
        .btn-danger {
            background-color: var(--pallete1);
            border-color: var(--pallete4);
        }
        .logout-btn {
            margin-top: 15px;
        }
        .btn {
            color: var(--backgroundColor); /* Ensuring readable text on buttons */
        }
    </style>
  </head>
  <body>
    <div class="container">
    <div class="text-center mb-4">
            <a href="newmain.php"><img src="nile.png" alt="Nile Home Icon" class="mb-4" style="width: 120px;"></a>
        </div>
        <div class="card">
            <h1>Create Account</h1>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Register</button>
            </form>
        </div>
    </div>
</body>
</html>