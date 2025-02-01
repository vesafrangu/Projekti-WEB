<?php
require_once 'DbConnect.php';

$dbConnect = new DbConnect();
$conn = $dbConnect->connect();

if (!$conn) {
    die("Database connection failed.");
}

$sql = "SELECT DISTINCT cars.*, registration.username 
        FROM cars 
        JOIN registration ON cars.username = registration.username";


try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listings</title>
    <style>
    body{
        background:linear-gradient(to right,black,red);
    }
    header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: transparent;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .logo {
            padding-left: 40px;
            font-size: 3em;
            color: yellow;
            text-decoration: none;
            user-select: none;
            margin-right: auto;
        }
        .navigation {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-left: auto;
        }
        .navigation a {
            font-size: 1.1em;
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        .button-container {
            display: flex;
            gap: 15px;
        }
        .login-button, .signup-button {
            padding: 8px 16px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: yellow;
            color: rgb(0, 0, 0);
            transition: background-color 0.2s ease;
            position: relative;
            right:50px;
        }

        .login-button{
            background-color: yellow;
        }
        .login-button:hover{
            background-color: #86a814;
        }
      
        .product-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); 
            gap: 20px; 
            padding: 20px;
            max-width: 1400px; 
            margin: 0 auto; 
        }

        .product-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-box:hover {
            transform: translateY(-5px); 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
        }

        .product-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-details {
            padding: 15px;
            text-align: center;
        }

        .product-title {
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
    white-space: nowrap; /* Ensure text doesn't wrap */
    overflow: visible; /* Ensure text is not hidden */
}

        .product-price {
            font-size: 16px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .product-price .discount {
            color: #ff0000; 
            font-size: 14px;
        }

        .product-rating {
            font-size: 14px;
            color: #ffc107; 
            margin-bottom: 10px;
        }

        .product-country {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .phoneNumber {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .no-data {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<header>
        <a href="index.html" class="logo">OnlineCar</a>
        <nav class="navigation">
       
            <button onclick="location.href='logout.php'" class="login-button">Logout</button>
        </nav>
    </header>

    <h1 style="text-align: center; margin-top: 100px; color:white;">Car Listings</h1>

<div class="product-container">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            $car_name = htmlspecialchars($row['car_name']);
            $car_year = htmlspecialchars($row['car_year']);
            $car_image = htmlspecialchars($row['car_image']);
            $username = htmlspecialchars($row['username']); 
            $phoneNumber = htmlspecialchars($row['phoneNumber']); 

            $image_path = 'uploads/' . $car_image;
            if (!file_exists($image_path)) {
                $image_path = 'uploads/default.jpg'; 
            }

            echo "
                <div class='product-box'>
                    <img src='$image_path' alt='Car Image'>
                    <div class='product-details'>
                        <div class='product-title'>$car_name</div>
                        <div class='product-price'>Year: $car_year</div>
                        <div class='product-rating'>Owner: $username</div>
                        <div class='phoneNumber'>Phone: $phoneNumber</div>
                    </div>
                </div>
            ";
        }
    } else {
        echo "<p class='no-data'>No cars found in the database.</p>";
    }
    ?>
</div>

</body>
</html>
