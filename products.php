<?php
include 'Car.php';  
include 'CarRentalSystem.php';  

$carSystem = new CarRentalSystem();

$carSystem->addCar(new Car('Toyota', 'C-HR 2021', 2021, 25000, 15000, 'For Sale', 'toyota2021.jpg'));
$carSystem->addCar(new Car('BMW', '750i xDrive', 2016, 23000, 60000, 'For Sale', 'bmw.jpg'));
$carSystem->addCar(new Car('Audi', 'A4 TFSI S Line', 2018, 400, 15000, 'For Rent', 'audi.jpg'));
$carSystem->addCar(new Car('Mercedes', 'AMG GT-C Roadster', 2016, 80000, 30000, 'For Sale', 'mercedes.jpg'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars for Sale and Rent</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }

        .logo {
            color: yellow;
            font-size: 2.5em;
            font-weight: bold; 
            padding: 20px 30px;
            text-decoration: none;
            position: absolute;
            top: 15px;
            left: 30px;
        }

        .cars-section {
            padding: 50px 0;
            background-color: #333;
        }

        .cars-section h2 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
            color: yellow;
        }

        .car-cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .car-card {
            background-color: #444;
            color: white;
            padding: 30px;
            flex-basis: calc(33.33% - 40px);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .car-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .car-card h3 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: yellow;
        }

        .car-card p {
            font-size: 1.1em;
            margin-bottom: 20px;
            color: white;
        }

        .car-card a {
            text-decoration: none;
            color: yellow;
            font-weight: bold;
            font-size: 1.1em;
        }

        .car-card a:hover {
            color: #0a0a71;
        }

        @media (max-width: 768px) {
            .car-card {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="cars-section">
        <h2>Discover Your Dream Ride: The Finest Cars for Sale and Rent</h2>
        <p style="font-style: italic; text-align: center;">
            Explore our wide selection of high-quality cars available for sale or rent.<br>
            Whether you're looking for a luxury vehicle,<br>
            a reliable daily driver,<br>
            or a stylish sports car, we have the perfect ride for you.
        </p>

        <div class="car-cards">
            <?php
            // Shfaq makinat nga sistemi
            $cars = $carSystem->getCars();
            foreach ($cars as $car) {
                $details = $car->getDetails();
                echo '
                    <div class="car-card">
                        <img src="' . $details['image'] . '" alt="' . $details['make'] . ' ' . $details['model'] . '">
                        <h3>' . $details['type'] . ': ' . $details['make'] . ' ' . $details['model'] . '</h3>
                        <p>Price: $' . $details['price'] . '<br>Year: ' . $details['year'] . '<br>Mileage: ' . $details['mileage'] . ' miles</p>
                        <a href="#">More Information</a>
                    </div>
                ';
            }
            ?>
        </div>
    </section>
</body>
</html>
