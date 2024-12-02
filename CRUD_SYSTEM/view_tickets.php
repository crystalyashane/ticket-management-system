<?php

$conn = new mysqli('localhost', 'root', '', 'TicketSystem');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$category = isset($_GET['category']) ? $_GET['category'] : '';
$result = $conn->query("SELECT * FROM Tickets WHERE Category LIKE '%$category%'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Tickets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('header.php'); ?>

    <h1>Available Tickets</h1>

    
    <form method="GET">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category">
            <option value="">All Categories</option>
            <option value="Adult" <?= $category == 'Adult' ? 'selected' : '' ?>>Adult</option>
            <option value="Child" <?= $category == 'Child' ? 'selected' : '' ?>>Child</option>
            <option value="Senior" <?= $category == 'Senior' ? 'selected' : '' ?>>Senior</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket Type</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['TicketID'] ?></td>
                    <td><?= $row['TicketType'] ?></td>
                    <td><?= $row['Price'] ?></td>
                    <td><?= $row['Category'] ?></td>
                    <td><?= $row['Description'] ?></td>
                    <td>
                <form method="POST" action="delete_ticket.php" style="display:inline;">
                    <input type="hidden" name="ticket_id" value="<?= $row['TicketID'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this ticket?');">Delete</button>
                </form>
            </td>
                </tr>
                
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
