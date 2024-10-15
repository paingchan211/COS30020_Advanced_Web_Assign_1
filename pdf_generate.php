<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

// Get plant details from POST request
$scientific_name = $_POST['scientific_name'];
$common_name = $_POST['common_name'];
$family = $_POST['family'];
$genus = $_POST['genus'];
$species = $_POST['species'];
$herbarium_photo = $_POST['herbarium_photo'];
$herbarium_speciemen = $_POST['herbarium_speciemen'];

/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("A4", "portrait");

/**
 * Load the HTML and replace placeholders with values from the plant details
 */
$html = file_get_contents("pdf_template.php");
$html = str_replace(
    ["{{ scientific_name }}", "{{ common_name }}", "{{ family }}", "{{ genus }}", "{{ species }}", "{{ herbarium_photo }}", "{{ herbarium_speciemen }}"],
    [$scientific_name, $common_name, $family, $genus, $species, "img/plants/" . $herbarium_photo, "img/plants/" . $herbarium_speciemen],
    $html
);

$dompdf->loadHtml($html);

/**
 * Create the PDF and set attributes
 */
$dompdf->render();

$dompdf->addInfo("Title", "Plant Details PDF");

/**
 * Send the PDF to the browser for download
 */
$dompdf->stream("plant_details.pdf");
