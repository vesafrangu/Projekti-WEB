<?php
class CarRentalSystem {
    private $cars = [];

    public function addCar(Car $car) {
        $this->cars[] = $car;
    }

    public function getCars() {
        return $this->cars;
    }
}
?>
