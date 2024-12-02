<?php

$conn = new mysqli('localhost', 'root', '', 'TicketSystem');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "
    SELECT 
        b.BookingID, 
        c.Name AS CustomerName, 
        c.Email, 
        t.TicketType, 
        b.Quantity, 
        b.TotalPrice, 
        b.BookingDate 
    FROM 
        Bookings b
    JOIN 
        Customers c ON b.CustomerID = c.CustomerID
    JOIN 
        Tickets t ON b.TicketID = t.TicketID
    WHERE 
        c.Name LIKE '%$search%'
    ORDER BY 
        b.BookingDate DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Booking History</title>
</head>
<body>
    <?php include('header.php'); ?>

    <h1>Booking History</h1>

   
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search by Customer Name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    
    <table border="1">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Ticket Type</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['BookingID']}</td>
                        <td>{$row['CustomerName']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['TicketType']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>\${$row['TotalPrice']}</td>
                        <td>{$row['BookingDate']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
