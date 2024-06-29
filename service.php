<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM tbl_services";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <div class="container mt-5" style="background-color: lightblue; min-height: 100vh;">
        <div class="welcome-section">
            <h1>Our Services</h1>
        </div>
        <div class="row">
            <?php foreach ($services as $service): ?>
                <div class="col-md-4 mb-4">
                    <div class="card service-card" onclick="showServiceDetails(<?php echo $service['service_id']; ?>)">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $service['service_name']; ?></h5>
                            <?php if ($service['service_image']): ?>
                                <div class="image-container">
                                    <img src="image/<?php echo $service['service_image']; ?>" class="card-img-top img-fluid" alt="<?php echo $service['service_name']; ?>">
                                </div>
                            <?php endif; ?>
                            <p class="card-text"><?php echo substr($service['service_description'], 0, 100); ?>...</p>
                            <button class="close-btn btn btn-danger d-none" onclick="hideCard(this)">Close</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mb-4">
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <div id="serviceModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalServiceName"></h5>
                </div>
                <div class="modal-body">
                    <p id="modalServiceDescription"></p>
                    <p id="modalServicePrice"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
