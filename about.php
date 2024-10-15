<?php
session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();
include_once 'head.php'; ?>

<body>
    <?php include_once 'header.php'; ?>

    <main id="main-mt">
        <div class="container mt-4">
            <h1 class="mb-4">About This Web Application</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Section</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP Version -->
                    <tr>
                        <td><strong>PHP Version</strong></td>
                        <td>
                            <?php
                            // Display the current PHP version
                            echo 'PHP Version: ' . phpversion();
                            ?>
                        </td>
                    </tr>

                    <!-- Tasks Completed -->
                    <tr>
                        <td><strong>Tasks Completed</strong></td>
                        <td>
                            <ul>
                                <li>Task 1: First Page</li>
                                <li>Task 2: Main Menu Page</li>
                                <li>Task 3: Plants Classification Page</li>
                                <li>Task 4: Tutorial Page</li>
                                <li>Task 5: Contribution Page</li>
                                <li>Task 6: View Plant Detail Page</li>
                                <li>Task 7: Profile Page</li>
                                <li>Task 8: Update Profile Page</li>
                                <li>Task 9: Account Registration Page</li>
                                <li>Task 10: Process Registration Page</li>
                                <li>Task 11: Login Page</li>
                                <li>Task 12: About Page</li>
                            </ul>
                        </td>
                    </tr>

                    <!-- Tasks Not Attempted or Not Completed -->
                    <tr>
                        <td><strong>Tasks Not Completed</strong></td>
                        <td>None. All tasks have been completed.</td>
                    </tr>

                    <!-- Frameworks/3rd Party Libraries Used -->
                    <tr>
                        <td><strong>Frameworks/3rd Party Libraries Used</strong></td>
                        <td>
                            <ul>
                                <li>Bootstrap version 5.3.0</li>
                                <li>DOMPdf version 3.0.0</li>
                                <li>Font Awesome version 4.7.0</li>
                            </ul>
                        </td>
                    </tr>

                    <!-- Video Presentation -->
                    <tr>
                        <td><strong>Video Presentation</strong></td>
                        <td>
                            <a href="https://youtu.be/Kp9HAfYJn_s" target="_blank" class="btn btn-primary">Link to Youtube</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Return to Home -->
            <div class="text-center">
                <a href="index.php" class="btn btn-success">Back to Home Page</a>
            </div>
        </div>
    </main>
    <?php include_once 'back-to-top.php' ?>
    <?php include_once 'footer.php' ?>
</body>

</html>