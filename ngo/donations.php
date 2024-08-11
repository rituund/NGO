<?php
session_start();

require_once "classes/dbh.classes.php"; // Include the file containing the Dbh class

if (!isset($_SESSION['username'])) {
    // Handle the case where $_SESSION['username'] is not set
    echo "Session username is not set.";
    exit();
}

// Get the session username
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $amount = $_POST['amount'];
    $ngo_id = $_POST['ngo_id'];
    $branch_id = $_POST['branchId'];

    // Connect to the database
    $dbh = new Dbh();
    $pdo = $dbh->connect();

    try {
        // Prepare and execute the SQL query
        $stmt = $pdo->prepare('INSERT INTO charity (branch_id, ngo_id, amount, username) VALUES (?, ?, ?, ?)');
        $stmt->execute([$branch_id, $ngo_id, $amount, $username]);

        // Check if insertion was successful
        if ($stmt->rowCount() > 0) {
            echo "Donation recorded successfully!";
        } else {
            echo "Failed to record donation.";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
