<?php 
// UNUSED
require_once(str_replace('\\', '/', dirname(__FILE__)).'/../classes/node.php');
require_once(str_replace('\\', '/', dirname(__FILE__)).'/../classes/edge.php');
require_once(str_replace('\\', '/', dirname(__FILE__)).'/../functions/phpgraph.php');

$nodes = array(new Node(0, true));
$edges = array();

$numberOfNodes = rand(Node::$NODES_MIN,Node::$NODES_MAX);
$maxNumberOfEdges = $numberOfNodes * ($numberOfNodes-1)/2;
$numberOfEdges = rand($numberOfNodes, $maxNumberOfEdges-$connective)+$connective;

// Generate nodes
for ($i = 1; $i < $numberOfNodes + 1; $i++){
  $newnode = new Node($i);
  $nodes[] = $newnode;
}

// Generate edges
for ($i = 0; $i < $numberOfEdges; $i++){
  $node1_id = NULL;
  $node2_id = NULL;
  do {
    $node1_id = rand(0, $numberOfNodes);
    $node2_id = rand(0, $numberOfNodes);
  } while ( !isNewEdge($node1_id, $node2_id, $edges) );
  $edges[] = new Edge(new Node($node1_id), new Node($node2_id), rand(Edge::$WEIGHT_MIN, Edge::$WEIGHT_MAX)); // potential scoping error
}

// Check if it is a valid graph
while (!isFullyConnected($nodes, $edges)){
  $edges[] = generateMissingConnection($nodes, $edges);
}


?>