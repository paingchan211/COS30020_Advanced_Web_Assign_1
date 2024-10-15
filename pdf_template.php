<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Plant Details</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Plant Details</h1>

        <div class="row mt-4">
            <!-- Plant Description -->
            <div class="col-md-6">
                <h2 class="text-center">{{ scientific_name }}</h2>
                <p><strong>Common Name:</strong> {{ common_name }}</p>
                <p><strong>Family:</strong> {{ family }}</p>
                <p><strong>Genus:</strong> {{ genus }}</p>
                <p><strong>Species:</strong> {{ species }}</p>
            </div>

            <!-- Plant Image -->
            <div class="col-md-6 text-center">
                <img src="{{ herbarium_photo }}" alt="Herbarium Photo" id="pdf-leaf-img">
            </div>
            <br>
            <div class="col-md-6 text-center">
                <img src="{{ herbarium_speciemen }}" alt="Herbarium Photo" id="pdf-speciemen-img">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>