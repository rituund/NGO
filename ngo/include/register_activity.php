<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the user_id from the session
    $user_id = $_SESSION["user_id"];

    // Assuming the activity_id is passed from the slider.html page
    $activity_id = $_POST["activity_id"];

    // Perform database insertion
    try {
        require_once 'dbh.inc.php'; // Include your database connection file

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO donor_history (donor_id, activity_id) VALUES (:user_id, :activity_id)");

        // Bind parameters
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":activity_id", $activity_id);

        // Execute the statement
        $stmt->execute();

        // Redirect to a success page
        header("Location: ../slider.php");
        exit();
    } catch (PDOException $e) {
        die("Query Failed : " . $e->getMessage());
    }
} else {
    // Redirect to the login page if the request method is not POST
    header("Location: ../login.php");
    exit();
}
?>
