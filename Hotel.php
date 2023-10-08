<?php
class Hotel {
    private $id;
    private $name;
    private $description;
    private $image;
    private $pricePerNight;

    public function __construct($id, $name, $description, $image, $pricePerNight) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->pricePerNight = $pricePerNight;
    }

    // Add getters and setters as needed
}
