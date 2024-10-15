<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if a search query is provided
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Display the search results
?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once 'header.php'; ?>

    <main class="container" id="main-mt">
        <div class="shadow-lg rounded p-4 w-100">
            <div class="text-center">
                <h1>Search Results</h1>
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary mb-3">Back to Index</a>
            </div>
            <?php
            if ($query) {
                // Read herbarium.txt file
                $contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES);
                $results = [];
                // Loop through contributions to find matches
                foreach ($contributions as $line) {
                    $data = explode(',', $line);
                    $scientific_name = strtolower($data[1]);
                    $common_name = strtolower($data[2]);
                    $family = strtolower($data[3]);
                    $genus = strtolower($data[4]);
                    // Check if the query matches scientific name, family, common name, or genus
                    if (
                        strpos($scientific_name, strtolower($query)) !== false ||
                        strpos($common_name, strtolower($query)) !== false ||
                        strpos($family, strtolower($query)) !== false ||
                        strpos($genus, strtolower($query)) !== false
                    ) {
                        $results[] = $data;
                    }
                }
                // Display search results
                if (count($results) > 0) {
                    echo '<div class="row">';
                    foreach ($results as $data) {
                        echo '
                        <div class="col-md-4">
                            <div class="card rounded shadow-lg mb-4">
                                <img src="img/plants/' . htmlspecialchars($data[6]) . '" class="card-img-top" alt="Plant Image" id="search-img">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($data[1]) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($data[2]) . '</p>
                                    <a href="plant_detail.php?id=' . htmlspecialchars($data[0]) . '" class="btn btn-primary">View Description</a>
                                </div>
                            </div>
                        </div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No results found for "' . htmlspecialchars($query) . '".</p>';
                }
            } else {
                echo '<p>Please enter a search query.</p>';
            }
            ?>
        </div>

    </main>

    <?php include_once 'footer.php'; ?>
</body>

</html>