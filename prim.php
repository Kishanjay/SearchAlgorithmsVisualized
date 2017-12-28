<?php
require_once('controllers/primController.php'); // Graph functions in PHP
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Sorting algorithms explained with graphs">
    <meta name="author" content="Kishan Nirghin">

    <title>Computational thinking learner</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!-- [if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php require_once("_navbar.php"); ?>

    <div class="container-fluid">
      <div class="row">
        <?php $active="prim"; require_once("_sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Prim's algorithm</h1>

          <div id="cy"> </div>

          <button type="button" class="btn btn-primary" id="previousstep">Previous step</button>
          <button type="button" class="btn btn-primary" id="nextstep">Next step</button>

          <h3 class="sub-header">Explanation</h2>
          <p class="text">
 In computer science, Prim's algorithm is a greedy algorithm that finds a minimum spanning tree for a weighted undirected graph. This means it finds a subset of the edges that forms a tree that includes every vertex, where the total weight of all the edges in the tree is minimized. The algorithm operates by building this tree one vertex at a time, from an arbitrary starting vertex, at each step adding the cheapest possible connection from the tree to another vertex.
 </p>
          <h4 class="sub-header">Algorithm</h4>
          <p> The steps of dijkstra's algorithm are simple: </p>
          <ol>
            <li>Take the starting node</li>
            <li>Compute the distances to every other connected node (just follow the edges from the starting node)</li>
            <li>Take the smallest edge, and follow it to a new node</li>
            <li>Use the edges from the new node to update the table, and possibly create new/smaller paths to other nodes</li>
            <li>Take the new smallest edge to a node that was not visited yet</li>
            <li>Repeat from step 4</li>

          </ol>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!---<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!-- <script src="../../assets/js/vendor/holder.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/2.6.12/cytoscape.min.js"></script>
    <script>
      <?php require_once("_cytoscape_init.js"); ?>

      $("#nextstep").click(performStepPrim);
      //$("#previousstep").click(previousStepPrim);

      <?php require_once("functions/javascriptgraph.js"); ?>
    </script>
  </body>
</html>
