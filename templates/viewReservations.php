<html>
<head><title>View Reservations</title></head>
<body>
    <h1>Customer Reservations</h1>
    <?php if (!empty($reservations)): ?>
    <table border="1">
        <tr>
            <th>Reservation ID</th>
            <th>Customer ID</th>
            <th>Reservation Time</th>
            <th>Number of Guests</th>
            <th>Special Requests</th>
            <th>Update Special Requests</th>
        </tr>
        <?php foreach ($reservations as $reservation): ?>
        <tr>
            <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
            <td><?= htmlspecialchars($reservation['customerId']) ?></td>
            <td><?= htmlspecialchars($reservation['reservationTime']) ?></td>
            <td><?= htmlspecialchars($reservation['numberOfGuests']) ?></td>
            <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
            <td>
            <form method="POST" action="index.php?action=updateSpecialRequest">
    <input type="hidden" name="reservation_id" value="<?= $reservation['reservationId'] ?>">
    <textarea name="special_requests"><?= htmlspecialchars($reservation['specialRequests']) ?></textarea><br>
    <button type="submit">Update Special Request</button>
</form>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>No reservations found for this customer.</p>
    <?php endif; ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
