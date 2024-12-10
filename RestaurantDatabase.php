<?php
class RestaurantDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        echo "Successfully connected to the database";
    }

    public function addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests) {
        // Check if the customer exists
        $stmt = $this->connection->prepare("SELECT customerId FROM customers WHERE customerId = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        // If customer does not exist, create one with placeholder data
        if ($result->num_rows === 0) {
            $stmt = $this->connection->prepare(
                "INSERT INTO customers (customerId, customerName, contactInfo) VALUES (?, 'Placeholder Name', 'Placeholder Contact')"
            );
            $stmt->bind_param("i", $customerId);
            $stmt->execute();
            $stmt->close();
        }
    
        // Now add the reservation
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $customerId, $reservationTime, $numberOfGuests, $specialRequests);
        $stmt->execute();
        $stmt->close();
        echo "Reservation added successfully";
    }
    
    

    public function getAllReservations() {
        $result = $this->connection->query("SELECT * FROM reservations");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCustomer($customerName, $contactInfo) {
            $stmt = $this->connection->prepare(
                "INSERT INTO customers (customerName, contactInfo) VALUES (?, ?)"
            );
            $stmt->bind_param("ss", $customerName, $contactInfo);
            $stmt->execute();
            $stmt->close();
            echo "Customer added successfully";
    }

    public function getCustomerPreferences($customerId) {
            $stmt = $this->connection->prepare(
                "SELECT * FROM diningpreferences WHERE customerId = ?"
            );
            $stmt->bind_param("i", $customerId);
            $stmt->execute();
            $result = $stmt->get_result();
            $preferences = $result->fetch_assoc();
            $stmt->close();
            return $preferences; 
    }
    // Method to find all reservations for a specific customer
    // Method to find all reservations for a specific customer
    public function findReservations($customerId) {
    $stmt = $this->connection->prepare("SELECT * FROM reservations WHERE customerId = ?");
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC); // Fetch all reservations for the customer
}

 // Method to update special requests for a reservation
 public function addSpecialRequest($reservationId, $specialRequests) {
    $stmt = $this->connection->prepare(
        "UPDATE reservations SET specialRequests = ? WHERE reservationId = ?"
    );
    $stmt->bind_param("si", $specialRequests, $reservationId);
    $stmt->execute();
    $stmt->close();
    echo "Special requests updated successfully";
    }

}
?>
