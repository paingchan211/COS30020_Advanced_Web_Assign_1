<?php session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start(); ?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once 'header.php'; ?>

    <main class="flex flex-col min-h-screen">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 carousel-img" src="img/img1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 carousel-img" src="img/img2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 carousel-img" src="img/img3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

        <section class="hero">
            <div class="pt-5 pb-5 container text-center">
                <h1 class="display-4 mb-4">Welcome to the Herbarium Project</h1>
                <p class="lead mb-6">Dedicated to the classification and preservation of plant species through herbarium specimens.</p>
                <!-- Login and Register buttons -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="login.php" class="btn btn-lg" id="login-btn">Login</a>
                    <a href="registration.php" class="btn btn-success btn-lg">Register</a>
                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="container">
                <h2 class="text-center mb-15">Random Herbarium Specimen</h2>
                <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) : ?>
                    <p class="text-center text-danger">You must be logged in to view plant details.</p>
                <?php endif; ?>
                <div class="row justify-content-center">
                    <?php
                    $images = glob("img/plants/*.{jpg,jpeg,png}", GLOB_BRACE);
                    $contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                    if (!empty($images) && !empty($contributions)) {
                        shuffle($contributions);
                        $random_plants = array_slice($contributions, 0, 6);

                        foreach ($random_plants as $line) {
                            $data = explode(',', $line);
                            $plant_id = $data[0];
                            $plant_image = $data[6];

                            echo "<div class='col-6 col-md-6 col-lg-4 p-3 d-flex justify-content-center'>";
                            echo "<a href='plant_detail.php?id={$plant_id}'>"; // Pass plant ID in URL
                            echo "<img src='img/plants/{$plant_image}' alt='Herbarium Specimen' class='img-fluid rounded shadow herbarium-img' />";
                            echo "</a>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p class='text-center'>No herbarium specimens available at the moment. Please check back later.</p>";
                    }
                    ?>
                </div>
                <div class="mt-3 text-center">
                    <a href="about.php" class="btn btn-success btn-lg">About</a>
                </div>
            </div>
        </section>

    </main>

    <?php include_once 'back-to-top.php'; ?>
    <?php include_once 'footer.php'; ?>
</body>

</html>