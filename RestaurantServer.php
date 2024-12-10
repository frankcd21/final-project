<?php
require_once 'restaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            case 'findReservations':
                 $this->findReservations();
                break;
            case 'updateSpecialRequest':
                $this->updateSpecialRequest();  // This should be triggered for special request updates
            break;    
            default:
                $this->home();
        }
    }

    private function home() {
        include 'templates/home.php';
    }


    private function updateSpecialRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId = $_POST['reservation_id'];
            $specialRequests = $_POST['special_requests'];
    
            // Call the database method to update the special requests
            $this->db->addSpecialRequest($reservationId, $specialRequests);
    
            // Redirect to view reservations to see the updated data
            header("Location: index.php?action=viewReservations&message=Special Request Updated");
        }
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customer_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            header("Location: index.php?action=viewReservations&message=Reservation Added");
        } else {
            include 'templates/addReservation.php';
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        include 'templates/viewReservations.php';
    }
    // Find reservations for a specific customer by customer_id
    private function findReservations() {
    if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
        $customerId = $_GET['customer_id']; // Get customer ID from the GET parameter
        $reservations = $this->db->findReservations($customerId); // Call the method to fetch reservations
        
        // Include the view template to display the found reservations
        include 'templates/viewReservations.php';
    } else {
        echo "Customer ID is required.";
    }
}

}

$portal = new RestaurantPortal();
$portal->handleRequest();
