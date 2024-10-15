<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = '';
$showModal = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to validate inputs
    function validateInput($data)
    {
        return htmlspecialchars(trim($data));
    }

    // Initialize an array to store errors
    $errors = [];

    // Validate required fields
    $common_name = validateInput($_POST['common_name']);
    $family = validateInput($_POST['family']);
    $genus = validateInput($_POST['genus']);
    $species = validateInput($_POST['species']);

    // Check for empty required fields
    if (empty($family)) {
        $errors[] = "Family is required.";
    }
    if (empty($genus)) {
        $errors[] = "Genus is required.";
    }
    if (empty($species)) {
        $errors[] = "Species is required.";
    }

    // Validate input patterns
    if (preg_match('/\s/', $family)) {
        $errors[] = "Family cannot have spaces.";
    }
    if (preg_match('/\s/', $genus)) {
        $errors[] = "Genus cannot have spaces.";
    }
    if (!preg_match('/^[A-Z][a-z]+(?:\s[a-z]+)?$/', $species)) {
        $errors[] = "Species must begin with a capital letter and can have only one space.";
    }

    // Handle file upload if no errors
    if (empty($errors)) {
        // Handle both herbarium and habitat photo uploads
        $target_dir = "img/plants/";

        // Handle herbarium photo
        $herbarium_leaf = basename($_FILES["herbarium_leaf"]["name"]);
        $herbarium_target_file = $target_dir . $herbarium_leaf;

        // Handle habitat photo
        $herbarium_speciemen = basename($_FILES["herbarium_speciemen"]["name"]);
        $habitat_target_file = $target_dir . $herbarium_speciemen;

        if (
            move_uploaded_file($_FILES["herbarium_leaf"]["tmp_name"], $herbarium_target_file) &&
            move_uploaded_file($_FILES["herbarium_speciemen"]["tmp_name"], $habitat_target_file)
        ) {

            // Generate a unique ID
            $contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES);
            $id = count($contributions) + 1;

            if (empty($common_name)) {
                $common_name = 'N/A';
            }

            // Format contribution data, including both images
            $contributionData = implode(',', [
                $id,
                $species,
                $common_name,
                $family,
                $genus,
                $species,
                $herbarium_leaf,  // Herbarium photo filename
                $herbarium_speciemen    // Habitat photo filename
            ]) . ',' . PHP_EOL;

            // Save the contribution data to the text file
            file_put_contents('data/herbarium.txt', $contributionData, FILE_APPEND | LOCK_EX);
        } else {
            $errors[] = "There was an error uploading the photos.";
        }
    }

    // Handle errors
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        $showModal = true;
    }
}

// Check for errors in the session
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);  // Clear the error after retrieving it
    $showModal = true;
}
?>

<?php include_once 'head.php'; ?>

<body>
    <input type="hidden" id="showModalFlag" value="<?php echo $showModal ? 'true' : 'false'; ?>">
    <?php include_once 'header.php'; ?>
    <main id="main-mt" class="d-flex flex-column align-items-center">
        <div class="rounded ps-4 w-100" id="contribute-container">
            <h1 class="mb-4 text-center">Contributions</h1>
            <div class="text-center">
                <button class="btn btn-primary rounded h-100" data-bs-toggle="modal" data-bs-target="#contributeModal">CONTRIBUTE</button>
            </div>
            <div class="p-3">
                <?php
                $contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES);
                if ($contributions && count($contributions) > 0) {
                    echo '<div class="row">';
                    foreach ($contributions as $line) {
                        $data = explode(',', $line);
                        $common_name_data = !empty($data[2]) ? htmlspecialchars($data[2]) : 'Unknown Common Name';
                        echo '
            <div class="col-md-4 col-12 col-sm-6">
                <div class="card rounded shadow-lg mb-4">
                    <img src="img/plants/' . htmlspecialchars($data[6]) . '" class="card-img-top" alt="Plant Image">
                    <div class="card-body text-center">
                        <h5 class="card-title">' . htmlspecialchars($data[1]) . '</h5>
                        <p class="card-text">' . $common_name_data . '</p>
                        <a href="plant_detail.php?id=' . htmlspecialchars($data[0]) . '" class="btn btn-primary">View Description</a>
                    </div>
                </div>
            </div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No contributions yet.</p>';
                }
                ?>
            </div>

        </div>

        <!-- Contribution Modal -->
        <div class="modal fade" id="contributeModal" tabindex="-1" aria-labelledby="contributeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contributeModalLabel">Contribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Updated Contribution Modal Form -->
                    <div class="modal-body">
                        <form action="contribute.php" method="post" enctype="multipart/form-data">
                            <?php
                            if (!empty($error)) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>
                            <div class="mb-3">
                                <label for="species" class="form-label">Scientific Name (Species)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="species" name="species" value="<?php echo htmlspecialchars($species ?? ''); ?>" placeholder="e.g. Dipterocarpus bourdillonii" pattern="^[A-Z][a-z]+(?:\s[a-z]+)?$" title="Species must begin with a capital letter and can have only one space." required>
                            </div>
                            <div class="mb-3">
                                <label for="common_name" class="form-label">Common Name</label>
                                <input type="text" class="form-control" id="common_name" name="common_name" value="<?php echo htmlspecialchars($common_name ?? ''); ?>" placeholder="e.g. Chiratta anjili">
                            </div>
                            <div class="mb-3">
                                <label for="family" class="form-label">Family<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="family" name="family" value="<?php echo htmlspecialchars($family ?? ''); ?>" placeholder="e.g. Dipterocarpaceae" pattern="^[^\s]+$" title="Family cannot have spaces." required>
                            </div>
                            <div class="mb-3">
                                <label for="genus" class="form-label">Genus<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="genus" name="genus" value="<?php echo htmlspecialchars($genus ?? ''); ?>" placeholder="e.g. Dipterocarpus" pattern="^[^\s]+$" title="Genus cannot have spaces." required>
                            </div>

                            <div class="mb-3">
                                <label for="herbarium_leaf" class="form-label">Herbarium Leaf<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="herbarium_leaf" name="herbarium_leaf" required>
                            </div>

                            <div class="mb-3">
                                <label for="herbarium_speciemen" class="form-label">Herbarium Speciemen<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="herbarium_speciemen" name="herbarium_speciemen" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <?php include_once 'back-to-top.php'; ?>
    <?php include_once 'footer.php'; ?>
</body>

</html>