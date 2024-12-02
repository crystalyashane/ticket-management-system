<?php

$conn = new mysqli('localhost', 'root', '', 'TicketSystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['delete'])) {
    $ticketID = $_GET['delete'];
    $conn->query("DELETE FROM Tickets WHERE TicketID = $ticketID");
    header("Location: manage_tickets.php"); 
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_ticket'])) {
    $ticketType = $_POST['ticketType'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $conn->query("INSERT INTO Tickets (TicketType, Price, Description, Category) 
                  VALUES ('$ticketType', $price, '$description', '$category')");
    header("Location: manage_tickets.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Manage Tickets</title>
</head>
<body>
    <?php include('header.php'); ?>

    <h1>Manage Tickets</h1>

  
    <form method="POST" class="ticket-form">
        <h2>Add New Ticket</h2>
        <input type="text" name="ticketType" placeholder="Ticket Type" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" rows="4" style="width: 100%; font-size: 16px; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">Description</textarea>

        <select name="category" required>
            <option value="Adult">Adult</option>
            <option value="Child">Child</option>
            <option value="Senior">Senior</option>
        </select>
        <button type="submit" name="add_ticket">Add Ticket</button>
    </form>

    
    <h2>Existing Tickets</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket Type</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            
            $result = $conn->query("SELECT * FROM Tickets");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['TicketID']}</td>
                        <td>{$row['TicketType']}</td>
                        <td>\${$row['Price']}</td>
                        <td>{$row['Category']}</td>
                        <td>{$row['Description']}</td>
                        
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
