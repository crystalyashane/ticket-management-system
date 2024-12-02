
<?php
$conn = new mysqli('localhost', 'root', '', 'TicketSystem');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticketType = $_POST['ticketType'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $conn->query("INSERT INTO Tickets (TicketType, Price, Description) VALUES ('$ticketType', $price, '$description')");
    echo "Ticket Type Added Successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Ticket Type</title>
</head>
<?php include('header.php'); ?>
<body>
    <form method="POST">
        <input type="text" name="ticketType" placeholder="Ticket Type" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit">Add Ticket</button>
    </form>
</body>
</html>
