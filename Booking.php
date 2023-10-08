<?php
class Booking {
    private $id;
    private $customerId;
    private $hotelId;
    private $startDate;
    private $endDate;

    public function __construct($id, $customerId, $hotelId, $startDate, $endDate) {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->hotelId = $hotelId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    // Add getters and setters as needed
}
