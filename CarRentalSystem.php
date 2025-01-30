<?php
class Car {
    public $make;
    public $model;
    public $year;
    public $price;
    public $mileage;
    public $type; 
    public $image;

    public function __construct($make, $model, $year, $price, $mileage, $type, $image) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        $this->mileage = $mileage;
        $this->type = $type;
        $this->image = $image;
    }

    public function getDetails() {
        return [
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'type' => $this->type,
            'image' => $this->image
        ];
    }
}
?>
