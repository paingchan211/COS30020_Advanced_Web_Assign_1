<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();
if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include_once 'head.php';

// Get the plant ID from the URL
$plant_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Load the contributions data
$contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$selected_plant = null;

// Find the selected plant based on the ID
foreach ($contributions as $line) {
    $data = explode(',', $line);
    if ($data[0] == $plant_id) {
        $selected_plant = [
            'id' => $data[0],
            'scientific_name' => $data[1],
            'common_name' => $data[2],
            'family' => $data[3],
            'genus' => $data[4],
            'species' => $data[5],
            'herbarium_photo' => $data[6],
            'herbarium_speciemen' => $data[7]
        ];
        break;
    }
}

// If no plant is found, redirect to contribution page
if (!$selected_plant) {
    header("Location: contribute.php");
    exit();
}
?>

<body>
    <?php include_once "header.php"; ?>
    <main id="main-mt" class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="shadow-lg rounded p-4 w-100" id="plant-detail-container">
            <h1 class="h4 mb-4 fw-bold text-center">Plant Details</h1>

            <h2 class="h5 fw-bold">Scientific Name: <?= htmlspecialchars($selected_plant['scientific_name']) ?></h2>
            <p>Common Name: <?= htmlspecialchars($selected_plant['common_name']) ?></p>
            <p>Family: <?= htmlspecialchars($selected_plant['family']) ?></p>
            <p>Genus: <?= htmlspecialchars($selected_plant['genus']) ?></p>
            <p>Species: <?= htmlspecialchars($selected_plant['species']) ?></p>

            <div class="text-center">

                <h3 class="h6 fw-bold mb-3">Photos</h3>
                <img src="img/plants/<?= htmlspecialchars($selected_plant['herbarium_photo']) ?>" class="img-fluid mb-3" alt="Herbarium Leaf" id="plant-detail-leaf-img">
                <img src="img/plants/<?= htmlspecialchars($selected_plant['herbarium_speciemen']) ?>" class="img-fluid mb-3" alt="Herbarium Speciemen" id="plant-detail-speciemen-img">
            </div>


            <form action="pdf_generate.php" method="post">
                <input type="hidden" name="scientific_name" value="<?= htmlspecialchars($selected_plant['scientific_name']) ?>">
                <input type="hidden" name="common_name" value="<?= htmlspecialchars($selected_plant['common_name']) ?>">
                <input type="hidden" name="family" value="<?= htmlspecialchars($selected_plant['family']) ?>">
                <input type="hidden" name="genus" value="<?= htmlspecialchars($selected_plant['genus']) ?>">
                <input type="hidden" name="species" value="<?= htmlspecialchars($selected_plant['species']) ?>">
                <input type="hidden" name="herbarium_photo" value="<?= htmlspecialchars($selected_plant['herbarium_photo']) ?>">
                <input type="hidden" name="herbarium_speciemen" value="<?= htmlspecialchars($selected_plant['herbarium_speciemen']) ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Download PDF</button>
                    <a href="contribute.php" class="btn btn-dark">Back to Contributions</a>
                </div>
            </form>

        </div>
    </main>

    <?php include_once "footer.php"; ?>
</body>

</html>


</html>