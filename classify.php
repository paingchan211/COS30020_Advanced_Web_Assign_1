<?php session_name('paing_chan'); // name the session to prevent conflicts with other applications
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true && !isset($_SESSION['email'])) {
	header("Location: login.php");
	exit();
}
?>

<?php include_once 'head.php'; ?>

<body>
	<?php include_once "header.php"; ?>

	<div class="container my-5 pt-5">
		<h1 class="mb-4 text-center">Plant Classification</h1>

		<div class="row mb-5">
			<div class="col-md-12">
				<h2>Understanding Plant Classification</h2>
				<p class="lead">Plant classification is a hierarchical system used to organize and categorize plants based on their shared characteristics. The three main levels we'll focus on are Family, Genus, and Species.</p>
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-md-6 text-center mb-3">
				<img src="img/classify-2.webp" alt="Plants Classification 2" class="img-fluid mb-2 understanding-plant-classification">
			</div>
			<div class="col-md-6 text-center">
				<img src="img/classify-1.jpg" alt="Plants Classification 1" class="img-fluid mb-2 understanding-plant-classification">
			</div>
		</div>

		<div class="row mb-5">
			<div class="col-md-4">
				<div class="card h-100">
					<div class="card-body">
						<h3 class="card-title">Family</h3>
						<p class="card-text">The highest classification group commonly referred to. Plants in a family share many botanical features. Family names end in "aceae".</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card h-100">
					<div class="card-body">
						<h3 class="card-title">Genus</h3>
						<p class="card-text">The genus name is always capitalized. The genus is a group of species that are closely related. In this case, the genus is <strong>Vatica</strong>.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card h-100">
					<div class="card-body">
						<h3 class="card-title">Species</h3>
						<p class="card-text">The species name follows the genus and is never capitalized. Here, the species is <strong>Vatica rassak</strong>, defining the individual plant with specific characteristics.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row mb-12">
				<div class="col-md-12">
					<h3>Example: Dipterocarpaceae</h3>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="row align-items-center">
								<div class="col-md-6 text-center">

									<img src="img/plants/family-image1.webp" alt="Family Image 1" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/family-image2.jpg" alt="Family Image 2" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/family-image3.jpg" alt="Family Image 3" class="img-fluid mb-2 classify-example-images">
								</div>
								<div class="col-md-6">
									<strong>Family:</strong> Dipterocarpaceae
									<ul>
										<li>16 genera and 695 species</li>
										<li>Mostly found in Borneo</li>
										<li>Commonly used in timber trade</li>
									</ul>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row align-items-center">
								<div class="col-md-6 text-center">

									<img src="img/plants/genus-image1.jpeg" alt="Genus Image 1" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/genus-image2.jpg" alt="Genus Image 2" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/genus-image3.jpg" alt="Genus Image 3" class="img-fluid mb-2 classify-example-images">

								</div>
								<div class="col-md-6">
									<strong>Genus:</strong> Vatica
									<ul>
										<li>Known for its valuable timber</li>
										<li>Used in traditional medicine</li>
										<li>Found in tropical rainforests of Southeast Asia</li>
									</ul>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row align-items-center">
								<div class="col-md-6 text-center">

									<img src="img/plants/species-image1.jpeg" alt="Species Image 1" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/species-image2.jpeg" alt="Species Image 2" class="img-fluid mb-2 classify-example-images">
									<img src="img/plants/species-image3.webp" alt="Species Image 3" class="img-fluid mb-2 classify-example-images">
								</div>
								<div class="col-md-6">
									<strong>Species:</strong> Vatica rassak
									<ul>
										<li>Known as Keruing in local languages</li>
										<li>Can grow up to 50 meters tall</li>
										<li>Wood used for high-quality furniture and flooring</li>
										<li>Common in Malaysian forests and economically significant</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>

	<?php include_once "back-to-top.php"; ?>
	<?php include_once "footer.php"; ?>
</body>

</html>