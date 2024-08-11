<?php
session_start();
include('classes/dbh.classes.php');

if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header("Location: trial.php");
    exit;
}

$dbhObj = new Dbh();
$pdo = $dbhObj->getDbh();

$username = $_SESSION['username'];

// Query user_id from the database
$stmt = $pdo->prepare("SELECT user_id FROM donor WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $user_id = $user['user_id'];

    // Query total credits from donor_history
    $stmt = $pdo->prepare("SELECT SUM(credits) AS total_credits FROM donor_history WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $credits_result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_credits = $credits_result['total_credits'];

    // Query activities participated in
    $stmt = $pdo->prepare("SELECT DISTINCT a.Activity_Name, a.credits, a.hrs, n.ngo_name 
                           FROM activities a 
                           JOIN donor_history dh ON a.activity_id = dh.activity_id 
                           JOIN ngo n ON a.ngo_id = n.ngo_id 
                           WHERE dh.user_id = ?");
    $stmt->execute([$user_id]);
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "User not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="Logo">
                <h4 class="logotext">ImpactLink</h4>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="logged.html">Home</a>
                    </li>
                    <li>
                        <a href="logged.html">About Us</a>
                    </li>
                    <li>
                        <a href="donation.html">Donation</a>
                    </li>
                    <li>
                        <a href="slider.php">Activities</a>
                    </li>
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="title">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <h3>Your User ID is: <?php echo $user_id; ?></h3>
        <h3>Total Credits: <?php echo $total_credits; ?></h3>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Activity name</th>
                    <th>Credits</th>
                    <th>Hours</th>
                    <th>NGO Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity) {
                    echo "<tr>
                            <td>" . $activity['Activity_Name'] . "</td>
                            <td>" . $activity['credits'] . "</td>
                            <td>" . $activity['hrs'] . "</td>
                            <td>" . $activity['ngo_name'] . "</td>
                          </tr>";
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
