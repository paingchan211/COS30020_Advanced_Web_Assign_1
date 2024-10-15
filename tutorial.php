<?php session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>

<?php include_once 'head.php'; ?>

<body>
    <?php include_once "header.php"; ?>

    <main class="container" id="main-mt">
        <h1 class="text-center mb-4">Tutorial</h1>
        <div class="row">
            <!-- Card 1: Transfer -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transfer Fresh Leaf</h5>
                        <p class="card-text">Learn how to transfer fresh leaves into herbarium specimens.</p>
                        <a href="#transfer-section" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Tools -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tools for Herbarium</h5>
                        <p class="card-text">Explore the tools you need to create herbarium specimens.</p>
                        <a href="#tools-section" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Preservation -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Preserve Herbarium</h5>
                        <p class="card-text">Information on how to preserve herbarium specimens properly.</p>
                        <a href="#preserve-section" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transfer Section -->
        <section id="transfer-section" class="mt-5">
            <div class="container rounded p-4 max-w-2xl w-100">
                <div class="row mb-5">
                    <div>
                        <img src="img/tutorial/tutorial-main.jpeg" class="img-fluid rounded" id="tutorial-main-img" alt="tutorial-main">
                    </div>
                </div>
                <h1 class="text-center mb-5">HOW TO TRANSFER A LEAF INTO A HERBARIUM SPECIMEN</h1>

                <!-- Step 1 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/collecting.jpeg" class="img-fluid rounded" alt="tutostep1">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 1: Collecting</h3>
                        <p>Look for plants in areas with less human interference, like pathways and borders. Collect healthy, pest-free plants in bloom with key parts like flowers and leaves for easy identification. Avoid private and protected areas.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="row mb-5">
                    <div class="col-md-4 order-md-2">
                        <img src="img/tutorial/preparation.jpeg" class="img-fluid rounded" alt="tuto_step2">
                    </div>
                    <div class="col-md-8 order-md-1 fs-4">
                        <h3 class="mb-3">Step 2: Preparation</h3>
                        <p>Place collected plants in sealable bags to retain moisture. Press plants immediately or refrigerate them for up to a day if pressing is delayed. Use parchment paper and thin plywood to press delicate plants.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/pressing.jpeg" class="img-fluid rounded" alt="tutopstep3">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 3: Pressing</h3>
                        <p>Place plants in a press with parchment paper in between. Apply pressure for 24 hours, check and adjust, then leave them for one to two weeks depending on the plant type.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="row mb-5">
                    <div class="col-md-4 order-md-2">
                        <img src="img/tutorial/mounting.jpeg" class="img-fluid rounded" alt="tutostep4">
                    </div>
                    <div class="col-md-8 order-md-1 fs-4">
                        <h3 class="mb-3">Step 4: Mounting</h3>
                        <p>Once dry, mount the plants on acid-free paper using a flexible acrylic adhesive. Handle plants carefully with tweezers to avoid damage, and ensure all parts are properly adhered.</p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/freezing.jpg" class="img-fluid rounded" alt="tutostep5">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 5: Freezing</h3>
                        <p>After mounting, freeze the specimens for 72 hours to kill any insects or fungi. The pressure from the belts keeps the plants flat and secure while the glue fully dries.</p>
                    </div>
                </div>

                <!-- Step 6 -->
                <div class="row mb-5">
                    <div class="col-md-4 order-md-2">
                        <img src="img/tutorial/identification.jpeg" class="img-fluid rounded" alt="tutostep5">
                    </div>
                    <div class="col-md-8 order-md-1 fs-4">
                        <h3 class="mb-3">Step 6: Identification</h3>
                        <p>Use a dichotomous key and lens to identify the plant, comparing it to reference materials for confirmation. Make sure to check features like color, scent, and hair structure.</p>
                    </div>
                </div>

                <!-- Step 7 -->
                <div class="row">
                    <div class="col-md-4">
                        <img src="img/tutorial/catalog.jpeg" class="img-fluid rounded" alt="tutostep5">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 7: Catalog and Storage</h3>
                        <p>Assign each plant a number linked to a digital database. Store the specimen in acid-free sleeves, protect them from light, and inspect for insect damage regularly.</p>
                    </div>
                </div>

            </div>
        </section>


        <!-- Tools Section -->
        <section id="tools-section" class="mt-5">
            <div class="container rounded p-4 max-w-2xl w-100">
                <h1 class="text-center mb-5">TOOLS YOU WILL NEED</h1>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/plant-press.jpg" class="img-fluid rounded tools-img" alt="plant-press">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Plant Press</h3>
                        <p>A plant press is essential for drying the plants while keeping them flat. You can either buy a press or make your own using cardboard and paper sheets.</p>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/parchment-paper.jpg" class="img-fluid rounded tools-img" alt="parchment-paper">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Parchment Paper</h3>
                        <p>Parchment paper or newspaper is used to place between plant samples to absorb moisture and avoid direct contact with the press.</p>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/tweezers.jpg" class="img-fluid rounded tools-img" alt="tweezers">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Tweezers</h3>
                        <p>Use tweezers to handle delicate parts of the plants without damaging them during the mounting process.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <img src="img/tutorial/acid-free-adhesive.jpg" class="img-fluid rounded tools-img" alt="mounting-adhesive">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Acid-free Adhesive</h3>
                        <p>Keeps the plant and paper from degrading over time, maintaining the specimen's integrity and preservation for long-term study and exhibition.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preserve Section -->
        <section id="preserve-section" class="mt-5">
            <div class="container rounded p-4 max-w-2xl w-100">
                <h1 class="text-center mb-5">HOW TO PRESERVE YOUR HERBARIUM SPECIMENS</h1>

                <!-- Step 1 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/preserve-step-1.jpg" class="img-fluid rounded preserve-img" alt="freezing">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 1: Collect and Press Specimens</h3>
                        <p>Gather plant specimens with all relevant parts (leaves, flowers, roots, etc.). Press them between sheets of newspaper or blotting paper and place them under a flat, heavy object for several days to dry. Replace the paper as needed to prevent moisture build-up.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/preserve-step-2.jpg" class="img-fluid rounded preserve-img" alt="acid-free-sleeves">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 2: Dry Thoroughly</h3>
                        <p>Ensure specimens are fully dried to prevent mold growth. Drying racks or air-drying in a well-ventilated, warm area can speed up the process.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/preserve-step-3.jpeg" class="img-fluid rounded preserve-img" alt="inspecting">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 3: Mount on Acid-Free Paper</h3>
                        <p>Once dried, mount specimens on acid-free herbarium sheets using adhesive or linen tape. Ensure the specimen is securely attached but not overly restricted to avoid damage.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/preserve-step-4.png" class="img-fluid rounded preserve-img" alt="inspecting">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 4: Label Properly</h3>
                        <p>Include detailed information on the collection label, such as the plant’s scientific name, collection date, location, habitat, and the name of the collector. Accurate labeling ensures the scientific value of the specimen.</p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="row mb-5">
                    <div class="col-md-4">
                        <img src="img/tutorial/preserve-step-5.png" class="img-fluid rounded preserve-img" alt="inspecting">
                    </div>
                    <div class="col-md-8 fs-4">
                        <h3 class="mb-3">Step 5: Store in Controlled Conditions</h3>
                        <p>Store the mounted specimens in herbarium cabinets with controlled humidity and temperature. Ideally, the environment should be cool (around 15-20°C) and have low humidity (below 60%) to prevent mold or insect infestations. Periodic fumigation or freezing can help control pests.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once 'back-to-top.php'; ?>
    <?php include_once "footer.php"; ?>
</body>

</html>