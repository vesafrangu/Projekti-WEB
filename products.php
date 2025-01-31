<<?php
require_once 'DbConnect.php';


$dbConnect = new DbConnect();
$conn = $dbConnect->connect();


if (!$conn) {
    die("Database connection failed.");
}

e
$sql = "SELECT cars.*, registration.username 
        FROM cars 
        JOIN registration ON cars.username = registration.username"; // Corrected JOIN condition

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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        .car-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }
        .car-box {
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .car-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ccc;
        }
        .car-box h3 {
            font-size: 1.2rem;
            margin: 10px 0;
        }
        .car-box p {
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

<h1 style="text-align: center;">Car Listings</h1>

<div class="car-container">
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            $car_name = htmlspecialchars($row['car_name']);
            $car_year = htmlspecialchars($row['car_year']);
            $car_image = htmlspecialchars($row['car_image']);
            $username = htmlspecialchars($row['username']); 

     
            $image_path = 'uploads/' . $car_image;
            if (!file_exists($image_path)) {
                $image_path = 'uploads/default.jpg'; 
            }

            echo "
                <div class='car-box'>
                    <img src='$image_path' alt='Car Image'>
                    <h3>$car_name</h3>
                    <h3>Owner: $username</h3>
                    <p>Year: $car_year</p>
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
