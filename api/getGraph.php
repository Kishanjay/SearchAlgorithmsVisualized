<?php
error_reporting(E_ALL);
/*
* Function creates a connected graph
* Arguments:
*   - nodes -> number of nodes | Default = random
*   - edges -> number of edges (*note1) | Default = random
*
* note1: number of edges might increase when the edges did not result in a connected graph
*/
//require_once(str_replace('\\', '/', dirname(__FILE__)).'/../classes/node.php');
//require_once(str_replace('\\', '/', dirname(__FILE__)).'/../classes/edge.php');
require_once('classes/node.php');
require_once('classes/edge.php');
//require_once(str_replace('\\', '/', dirname(__FILE__)).'/functions/phpgraph.php');


// initialize values
$nodes = array(new Node(0, true));
$edges = array();

$numberOfNodes = rand(Node::$NODES_MIN,Node::$NODES_MAX);
$maxNumberOfEdges = $numberOfNodes * ($numberOfNodes-1)/2;
$numberOfEdges = rand($numberOfNodes, $maxNumberOfEdges);


// DEAL WITH ARGUMENTS
if ($_GET){
  if (isset($_GET['nodes'])){
    $numberOfNodes = $_GET['nodes'];
  }

  if (isset($_GET['edges'])){
    $edges = $_GET['edges'];
    if ($edges < $maxNumberOfEdges){
      $numberOfEdges = $numberOfEdges;
    }
  }

  if (isset($_GET['connective'])){
    $connective = $_GET['connective'];
    $numberOfEdges += $connective; 
    if ($numberOfEdges > $maxNumberOfEdges) { $numberOfEdges = $maxNumberOfEdges; }
  }
}


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
  $edges[] = new Edge(new Node($node1_id), new Node($node2_id), rand(Edge::$WEIGHT_MIN, Edge::$WEIGHT_MAX));
}

// Check if it is a valid graph
while (!isFullyConnected($nodes, $edges)){
  $edges[] = generateMissingConnection($nodes, $edges);
}

$graph = array(
  'nodes' => $nodes,
  'edges' => $edges
);

print_r(json_encode($graph));

// GRAPH THEORY
function generateMissingConnection($nodes, $edges){
  foreach ($nodes as $node1){
    foreach ($nodes as $node2){
      // can we reach $node2 from $node1 or visa versa
      if (!isReachable($node1, $node2, [], $edges)){
        return new Edge($node1, $node2, rand(Edge::$WEIGHT_MIN, Edge::$WEIGHT_MAX));
      }
    }
  }
  return true;
}

function isFullyConnected($nodes, $edges){
  foreach ($nodes as $node1){
    foreach ($nodes as $node2){
      // can we reach $node2 from $node1 or visa versa
      if (!isReachable($node1, $node2, [], $edges)){
        return false;
      }
    }
  }
  return true;
}


// Checks if $node1 is reachable from $node2
function isReachable($node1, $node2, $passedNodes, $edges){
  // end condition
  if ($node1->getId() == $node2->getId()){ return true; }
  // cycle detection
  if (in_array($node1, $passedNodes)){ return false; }

  $conEdges = getConnectingEdges($node1, $edges);
  foreach ($conEdges as $edge){
    $resultNode = $edge->takeEdgeFrom($node1);
    $passedNodes[] = $node1;
    if (isReachable($resultNode, $node2, $passedNodes, $edges)){
      return true;
    }
  }
  return false;
}

function getConnectingEdges($node1, $edges){
  $conEdges = array();
  foreach ($edges as $edge){
    if ($edge->contains($node1)){
      $conEdges[] = $edge;
    }
  }
  return $conEdges;
}

function isNewEdge($node1_id, $node2_id, $edges){
  if ($node1_id == $node2_id){ return false; }
  foreach ($edges as $edge){
    if ($edge->isEqualValue($node1_id, $node2_id)){
      return false;
    }
  }
  return true;
}

function implodeJSONSet($set){
  $result = NULL;
  foreach ($set as $item)
  { 
   if ($result == NULL){
    $result = $item->getJSObject();
   }
   else {
    $result = sprintf("%s, %s", $result, $item->getJSObject());
   }
  }
  return $result;
}
?>