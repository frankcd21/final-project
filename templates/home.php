<html>
<head><title>Restaurant Portal</title></head>
<body>
    <h1>Restaurant Portal</h1>
    <a href="index.php?action=addReservation">Add Reservation</a> |
    <a href="index.php?action=viewReservations">View Reservations</a>
    <h2>Find Reservations by Customer ID</h2>
    <form method="GET" action="index.php">
        <input type="text" name="customer_id" placeholder="Enter Customer ID" required>
        <button type="submit" name="action" value="findReservations">Find Reservations</button>
    </form>
</body>
</html>
