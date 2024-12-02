<?php
$conn = new mysqli('localhost', 'root', '', 'TicketSystem');
<?php include('header.php'); ?>
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $ticketID = $_GET['id'];
    $result = $conn->query("SELECT * FROM Tickets WHERE TicketID = $ticketID");
    $ticket = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticketID = $_POST['id'];
    $ticketType = $_POST['ticketType'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $conn->query("UPDATE Tickets SET TicketType = '$ticketType', Price = $price, Description = '$description' WHERE TicketID = $ticketID");
    echo "Ticket Updated Successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Ticket</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $ticket['TicketID'] ?>">
        <input type="text" name="ticketType" value="<?= $ticket['TicketType'] ?>" required>
        <input type="number" step="0.01" name="price" value="<?= $ticket['Price'] ?>" required>
        <textarea name="description" required><?= $ticket['Description'] ?></textarea>
        <button type="submit">Update Ticket</button>
    </form>
</body>
</html>
