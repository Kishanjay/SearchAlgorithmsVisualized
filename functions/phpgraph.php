<?php
// BASIC GETTERS
function getInitialNode($nodes){
  foreach ($nodes as $node){
    if ($node['initial']){
      return $node;
    }
  }
}

function getNodeClass($node){
  if ($node['initial']){
    return "initial selected";
  }
  return "";
}

function getNodeId($node){
  return $node['id'];
}

function getEdgeId($edge){
  return $edge['id'];
}

function getSourceId($edge){
  return getNodeId($edge['node1']);
}

function getDestId($edge){
  return getNodeId($edge['node2']);
}

function getEdgeWeight($edge){
  return $edge['weight'];
}
?>