<?php
require __DIR__ . '/../vendor/autoload.php';

use App\PlanningBiblio\GraphClient;

session_start();

$graph_client = new GraphClient();
$response = $graph_client->getEvent();
echo "<pre>";
var_dump($response);
echo "</pre>";
?>

