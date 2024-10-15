<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();
if (empty($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

?>

<?php include "head.php"; ?>

<body class="bg-light">
    <?php include_once "header.php"; ?>

    <main id="main-mt">
        <div class="mt-5" id="main-menu-container">
            <h1 class="text-center mb-3">Main Menu</h1>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Plant Classification</h5>
                            <p class="card-text text-center">This page is to educate the user on what is Plants Classification.</p>
                            <div class="d-flex justify-content-center">
                                <a href="classify.php" class="btn btn-success">CLASSIFY</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Tutorial</h5>
                            <p class="card-text text-center">Tutorial on how to transfer a fresh leaf into herbarium specimens.</p>
                            <div class="d-flex justify-content-center">
                                <a href="tutorial.php" class="btn btn-success">TUTORIAL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Identify</h5>
                            <p class="card-text text-center">This page is to be able to identify the plant type based on the photo uploaded. The output will display the scientific plant name, common name and the photos of herbarium specimens. Users can download those info in pdf format.</p>
                            <div class="d-flex justify-content-center">
                                <a href="identify.php" class="btn btn-success">IDENTIFY</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">Contribution</h5>
                            <p class="card-text text-center">A page where users can contribute for new plant species. They can upload the photos of fresh leaf and herbarium specimens of the plant with the successrmation provided in the form. Data will be stored in the database and used for identify</p>
                            <div class="d-flex justify-content-center">
                                <a href="contribute.php" class="btn btn-success">CONTRIBUTE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?>

</body>

</html>