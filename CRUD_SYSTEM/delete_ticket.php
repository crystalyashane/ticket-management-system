<?php

$conn = new mysqli('localhost', 'root', '', 'TicketSystem');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];

    
    $stmt = $conn->prepare("DELETE FROM Tickets WHERE TicketID = ?");
    $stmt->bind_param("i", $ticket_id); 

    if ($stmt->execute()) {
        echo "Ticket deleted successfully.";
    } else {
        echo "Error deleting ticket: " . $conn->error;
    }

    $stmt->close();
}


header("Location: view_tickets.php"); 
exit();
?>