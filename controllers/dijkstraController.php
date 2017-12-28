<?php
require_once('functions/phpgraph.php'); // Graph functions in PHP 

$graph = json_decode(file_get_contents('http://www.rukish.nl/api/getGraph.php'), true);
$nodes = $graph['nodes'];
$edges = $graph['edges'];

?>