<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();
if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$uploadSuccess = false;
$scientificName = '';
$commonName = '';
$herbariumPhotos = [];
$pdfLink = '';

// Handle file upload and identification (Mocked for demo purposes)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['plantPhoto'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['plantPhoto']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate file type (only allow jpg, png, jpeg for plant photos)
    if (in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
        if (move_uploaded_file($_FILES['plantPhoto']['tmp_name'], $targetFile)) {
            // Here you would run the plant identification logic or call an API

            // Mocked identification result
            $scientificName = "Ficus benjamina"; // Mock data
            $commonName = "Weeping Fig"; // Mock data
            $herbariumPhotos = [
                "images/herbarium1.jpg",
                "images/herbarium2.jpg"
            ]; // Mock data
            $pdfLink = "descriptions/ficus_benjamina_description.pdf"; // Mock data
            $uploadSuccess = true;
        }
    } else {
        $message = "Only JPG, JPEG, and PNG files are allowed.";
    }
}

?>

<?php include "head.php"; ?>

<body class="bg-light">
    <?php include_once "header.php"; ?>

    <main id="main-mt">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Identify</h1>

            <!-- Upload Form -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <h2 class="text-center">Upload a Plant Photo</h2>

                        <?php if ($uploadSuccess): ?>
                            <!-- Show Identification Results -->
                            <div class="alert alert-success">
                                <p><strong>Scientific Name:</strong> <?= $scientificName ?></p>
                                <p><strong>Common Name:</strong> <?= $commonName ?></p>

                                <!-- Display herbarium photos -->
                                <h5>Herbarium Specimen Photos:</h5>
                                <div class="row">
                                    <?php foreach ($herbariumPhotos as $photo): ?>
                                        <div class="col-6 mb-3">
                                            <img src="<?= $photo ?>" class="img-fluid img-thumbnail" alt="Herbarium Specimen">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Download PDF -->
                                <a href="<?= $pdfLink ?>" class="btn btn-primary mt-3">Download Description PDF</a>
                            </div>
                        <?php else: ?>
                            <!-- Show File Upload Form -->
                            <form action="identify.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="plantPhoto" class="form-label">Choose a plant photo (JPG, JPEG, PNG)</label>
                                    <input type="file" id="plantPhoto" name="plantPhoto" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Identify Plant</button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>

</body>

</html>