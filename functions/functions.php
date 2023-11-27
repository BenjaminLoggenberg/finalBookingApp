
<?php
// Function to calculate total cost
function calculateTotalCost($startDate, $endDate, $pricePerNight) {
    // Calculate the number of nights between start and end dates
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    $numNights = $interval->days;

    // Calculate the total cost
    return $numNights * $pricePerNight;
}

// Function to generate and save a booking receipt
function generateReceipt($customerId, $hotelId, $startDate, $endDate, $totalCost) {
    // Generate the receipt content
    $receiptContent = "Booking Details:\n";
    $receiptContent .= "Customer ID: $customerId\n";
    $receiptContent .= "Hotel ID: $hotelId\n";
    $receiptContent .= "Start Date: $startDate\n";
    $receiptContent .= "End Date: $endDate\n";
    $receiptContent .= "Total Cost: $totalCost\n";

    // Generate a unique filename (e.g., using timestamp)
    $filename = "receipt_" . time() . ".txt";

    // Save the receipt as a .txt file
    file_put_contents($filename, $receiptContent);
}
?>