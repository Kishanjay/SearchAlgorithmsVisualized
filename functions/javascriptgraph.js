// GRAPH THEORY
var allNodes = <?php echo json_encode($nodes); ?>;
var allEdges = <?php echo json_encode($edges); ?>;
var currentNode = getStartingNode();

var nodeHistory = [getStartingNode()]; // the order of checked nodes
var weightHistory = []; // all weights in each step

// ========================== DIJKSTRA SPECIFIC ===========================
// perform a step of dijkstra's algorithm
function performStepDijkstra(){

  if (isFinished()){ return; }
  // Update the weights backend for the new found edges
  var newEdges = getAvailableEdges([currentNode]);

  for (var j = 0; j < newEdges.length; j++){
    updateWeights(currentNode, newEdges[j]); //backend updates
  }


  // Select the new closest node 
  var nextNode = getNextNode(allNodes);
  selectNode(nextNode); //graph updates

  // Update table
  updateTable(currentNode, nextNode); //table updates
  updateWeightHistory();

  // History
  currentNode = nextNode;
  nodeHistory.push(nextNode);
}

function previousStepDijkstra(){
  // If there is no currentNode
  if (currentNode == null){
    return;
  }
  // If there is only 1 selected node
  if (getSelectedNodes(allNodes).length <= 1){
    return;
  }

  // Remove row from table
  var table = document.getElementById("table_dijkstra");
  var rowCount = table.rows.length;
  if (!isFinished()){
    table.deleteRow(rowCount -1);
    rowCount --;
  }

  // Wipe last row
  var columns = table.rows[rowCount-1].cells;
  for (var i = 1; i < columns.length; i++){
    columns[i].innerHTML = "";
    columns[i].className = "";
  }

  // Restore currentNode and remove node + edge
  var node = nodeHistory.pop();
  var edge = getEdgeByNodes(node, getNodeById(node.pathToInitial[1]), allEdges);
  cy.$("#" + node.id).removeClass("selected");
  cy.$("#" + edge.id).removeClass("selected");
  node.selected = false;
  edge.selected = false;
  currentNode = nodeHistory[nodeHistory.length-1];

  // Restore the weight values
  var currentWeightValues = weightHistory.pop();
  for (var i = 0; i < allNodes.length; i++){
    allNodes[i].pathToInitial = currentWeightValues[i];
  }
}

// Updates the dijkstra table
function updateTable(startingNode, newNode){
  // Fill the current nodes entries
  for (var i = 0; i < allNodes.length; i ++){
    var column_id = "#tr" + startingNode.id + "td" + allNodes[i].id
    var column = $(column_id);
    var newValues = allNodes[i].pathToInitial[0] + "," + allNodes[i].pathToInitial[1];

    // if it is irrelevent
    if (allNodes[i].id != newNode.id && allNodes[i].selected){
      newValues = "-"; 
    }
    // if it is infinite
    if (allNodes[i].pathToInitial[0] == -1){
      newValues = "infinite";
    }
    // if its the current selection
    if (allNodes[i].id == newNode.id){
      column.addClass("selected");
    }
    column.html(newValues);
  }
  // Add new row for the new node
  var row = $("#tr" + startingNode.id);
  var newcolumns = "<th>"+newNode.id+"</th>";
  for (var i = 0; i < allNodes.length; i ++){
    newcolumns += "<td id=";
    newcolumns += "tr"+ newNode.id;
    newcolumns += "td"+ allNodes[i].id;
    newcolumns += "></td>";
  }
  if (!isFinished()){
    var newrow = "<tr id=tr"+ newNode.id+">"+newcolumns+"</tr>"
    $(newrow).insertAfter(row);
  }
}

function updateWeightHistory(){
  // Backup weight row
  var currentWeightValues = [];
  for (var i = 0; i < allNodes.length; i++){
    currentWeightValues.push(allNodes[i].pathToInitial);
  }
  weightHistory.push(currentWeightValues);
}
// ========================== PRIMS ALGORITHM =======================
primsOpenEdges = null;
function performStepPrim(){
  if (isFinished()){
    return;
  }
  
  var currentNodes = getSelectedNodes(allNodes);

  if (primsOpenEdges == null){
    primsOpenEdges = getAvailableEdges(currentNodes);
    
    for (var i = 0; i < primsOpenEdges.length; i++){
      cy.$('#'+primsOpenEdges[i].id).addClass("considered");
    }  
  }

  else {
    primsOpenEdges = getAvailableEdges(currentNodes);

    var newEdge = getSmallestEdge(primsOpenEdges);
    var newNode = getNewNodeFromEdge(newEdge);

    newEdge.selected = true;
    newNode.selected = true;

     cy.$('#'+newNode.id).addClass("selected");
     cy.$('#'+newEdge.id).addClass("selected");
     cy.$('#'+newEdge.id).removeClass("considered");

     showConsideredEdges();
  }
}

function showConsideredEdges(){
  for (var i = 0; i < primsOpenEdges.length; i++){
    cy.$('#'+primsOpenEdges[i].id).removeClass("considered");
  }

  var currentNodes = getSelectedNodes(allNodes);
  primsOpenEdges = getAvailableEdges(currentNodes);
  
  for (var i = 0; i < primsOpenEdges.length; i++){
    cy.$('#'+primsOpenEdges[i].id).addClass("considered");
  }  
}

// ========================== GLOBAL DEPENDENT ======================

// returns a list of edges that are connected to the given set of nodes and a not-selected node
function getAvailableEdges(nodes){
  var availableEdges = []
  for (var j = 0; j < allEdges.length; j++){
    if (allEdges[j].selected == 1) { continue; }
    for (var i = 0; i < nodes.length; i++){
      if (isConnected(allEdges[j], nodes[i]) && isRelevant(allEdges[j], nodes[i], nodes)){
        availableEdges.push(allEdges[j]);
        break;
      }
    }
  }
  return availableEdges;
}

// Returns the edge between node1 and node2 from the given list of edges
function getEdgeByNodes(node1, node2, edges){
  for (var i = 0; i < edges.length; i++){
    if (isConnected(edges[i], node1) && isConnected(edges[i], node2)){
      return edges[i];
    }
  }
  display_error("FATAL ERROR, getEdgeByNodes no edge found between: " + node1.id + " and " + node2.id);
}

// returns the initial node
function getStartingNode(){
  for (var i = 0; i < allNodes.length; i++){
    if (allNodes[i].initial){
      return allNodes[i];
    }
  }
}

// gets the node by id
function getNodeById(id, nodes){
  for (var i = 0; i < allNodes.length; i++){
    if (allNodes[i].id == id){
      return allNodes[i];
    }
  }
  display_error("FATAL ERROR: getNodeById:" + id);
}





// ========================== FRAMEWORK =============================

// FRONT END
// Selects an node backend and in the graph with the corresponding edge
function selectNode(newNode){
  newNode.selected = true;
  newEdge = getEdgeByNodes(getNodeById(newNode.pathToInitial[1]), newNode, allEdges);
  newEdge.selected = true;

  cy.$('#'+newNode.id).addClass("selected");
  cy.$('#'+newEdge.id).addClass("selected");
}

// BACK END
// Updates the weights backend to the destination nodes
function updateWeights(startingNode, traversingEdge){
  var updatedNode = getOtherNode(startingNode, traversingEdge);
  var newWeight = startingNode.pathToInitial[0] + traversingEdge.weight

  if (updatedNode.pathToInitial[0] == -1 || newWeight < updatedNode.pathToInitial[0]){
    updatedNode.pathToInitial = [newWeight, startingNode.id];
  }
}

// HELP FUNCTIONS
// Get the smallest edges that is not taken yet from a given set of nodes
function getNextNode(nodes){
  var nextNode = null;
  for (var i = 0; i < allNodes.length; i++){
    if (allNodes[i].selected){ continue; }
    if (allNodes[i].pathToInitial[0] == -1){ continue; }
    if (nextNode == null || allNodes[i].pathToInitial[0] < nextNode.pathToInitial[0]){
      nextNode = allNodes[i];

    }
  }
  if (nextNode == null){
    display_error("FATAL ERROR, getNextNode");
  }
  return nextNode;
}

// Gets the other node that is connected to an edge
function getOtherNode(node, edge){
  var nodes = getNodesFromEdge(edge);
  if (nodes[0] == node){
    return nodes[1];
  }
  if (nodes[1] == node){
    return nodes[0];
  }
  display_error("FATAL ERROR getOtherNode");
}

// Gets the nodes that are connected to an edge as an array
function getNodesFromEdge(edge){
  var node1 = getNodeById(edge.node1.id);
  var node2 = getNodeById(edge.node2.id);
  return [node1, node2]
}

// returns a list of the nodes that are currently selected
function getSelectedNodes(nodes){
  var selectedNodes = [];
  for (var i = 0; i < nodes.length; i ++){
    if (nodes[i].selected){
      selectedNodes.push (nodes[i]);
    }
  }
  return selectedNodes;
}

function getNewNodeFromEdge(edge){
  var node1 = getNodeById(edge.node1.id);
  var node2 = getNodeById(edge.node2.id);

  if (node1.selected && node2.selected){
    display_error("FATAL ERROR getNewNodeFromEdge");
  }
  if (!node1.selected && !node2.selected){
    display_error("FATAL ERROR getNewNodeFromEdge2");
  }

  if (node1.selected){
    return node2;
  }
  return node1;
}

function getSmallestEdge(edges){
  var smallest = null;
  for (var i = 0; i < edges.length; i++){
    if (smallest == null || edges[i].weight < smallest.weight){
      smallest = edges[i];
    }
  }
  if (smallest == null){ display_error("FATAL ERROR getSmallestEdge"); }
  return smallest;
}

// if a node is connected to an edge
function isConnected(edge, node){
  if (edge.node1.id == node.id){
    return true;
  }
  if (edge.node2.id == node.id){
    return true;
  }
  return false;
}

// Checks if edge is connected to a non-selected node
function isRelevant(edge, node, nodes){
  var nodes = getNodesFromEdge(edge);
  
  if (nodes[0].selected && nodes[1].selected){
    return false;
  }
  return true;
}

function isFinished(){
  var availableEdges = getAvailableEdges(allNodes);
  if (availableEdges.length == 0){
    return true;
  }
  return false;
}

function display_error(msg){
  console.log(msg);
}

function log(msg){
  console.log(msg);
}