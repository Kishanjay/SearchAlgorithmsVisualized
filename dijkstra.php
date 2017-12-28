<?php
require_once('controllers/dijkstraController.php');
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
        <?php $active="dijkstra"; require_once("_sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dijkstra's algorithm</h1>
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div id="cy"> </div>

              </div>
              <div class="col-sm-12 col-lg-6">
              <button type="button" class="btn btn-primary" id="previousstep">Previous step</button>
              <button type="button" class="btn btn-primary" id="nextstep">Next step</button>
                <table class="table table-bordered" id="table_dijkstra">
                  <tr>
                    <th></th>
                    <?php foreach ($nodes as $node){ ?>
                      <th><?php echo getNodeId($node); ?></th>
                    <?php } ?>
                  </tr>
                  <tr id="tr<?php echo getNodeId(getInitialNode($nodes)); ?>">
                    <th><?php echo getNodeId(getInitialNode($nodes)); ?></th>
                    <?php foreach ($nodes as $node){ ?>
                      <td id="tr<?php echo getNodeId(getInitialNode($nodes)); ?>td<?php echo getNodeId($node); ?>"></td>
                    <?php } ?>
                  </tr>
                </table>
              </div>
            </div>
          <h3 class="sub-header">Explanation</h2>
          <p class="text">
            Dijkstra's algorithm is an algorithm for finding the shortest paths between nodes in a graph, which may represent, for example, road networks. It was conceived by computer scientist Edsger W. Dijkstra in 1956 and published three years later.[1][2]
The algorithm exists in many variants; Dijkstra's original variant found the shortest path between two nodes,[2] but a more common variant fixes a single node as the "source" node and finds shortest paths from the source to all other nodes in the graph, producing a shortest-path tree.
For a given source node in the graph, the algorithm finds the shortest path between that node and every other.[3]:196–206 It can also be used for finding the shortest paths from a single node to a single destination node by stopping the algorithm once the shortest path to the destination node has been determined. For example, if the nodes of the graph represent cities and edge path costs represent driving distances between pairs of cities connected by a direct road, Dijkstra's algorithm can be used to find the shortest route between one city and all other cities. As a result, the shortest path algorithm is widely used in network routing protocols, most notably IS-IS and Open Shortest Path First (OSPF). It is also employed as a subroutine in other algorithms such as Johnson's.
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

      $("#nextstep").click(performStepDijkstra);
      $("#previousstep").click(previousStepDijkstra);

      <?php require_once("functions/javascriptgraph.js"); ?>
    </script>
  </body>
</html>
