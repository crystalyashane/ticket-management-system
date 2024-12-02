<?php
$conn = new mysqli('localhost', 'root', '', 'TicketSystem');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $ticketID = $_POST['ticket'];
    $quantity = $_POST['quantity'];

    // Fetch ticket price
    $ticketQuery = $conn->query("SELECT Price FROM Tickets WHERE TicketID = $ticketID");
    $ticket = $ticketQuery->fetch_assoc();
    $price = $ticket['Price'];
    $totalPrice = $price * $quantity;

    // Insert into Customers
    $conn->query("INSERT INTO Customers (Name, Age, Email) VALUES ('$customerName', $age, '$email')");
    $customerID = $conn->insert_id;

    // Insert into Bookings
    $conn->query("INSERT INTO Bookings (CustomerID, TicketID, Quantity, TotalPrice) VALUES ($customerID, $ticketID, $quantity, $totalPrice)");

    echo "Booking Successful! Total Price: $$totalPrice";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book a Ticket</title>
</head>
<?php include('header.php'); ?>
<body>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="ticket">
    <?php
    $result = $conn->query("SELECT * FROM Tickets");
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['TicketID']}'>{$row['TicketType']} ({$row['Category']}) - \${$row['Price']}</option>";
    }
    ?>
</select>

        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit">Book</button>
    </form>
</body>
</html>
