<?php
require_once('controllers/mergesortController.php');
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
        <?php $active="mergesort"; require_once("_sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Merge sort</h1>

          <div id="tables">
            <table id="table1" class="table table-bordered">
              <tr id="numbers1">
                <?php for ($i = 0 ; $i < count($numbers); $i++){ ?>
                  <td id="1_n<?php echo $i; ?>" class=""><?php echo $numbers[$i]; ?></td>
                <?php } ?>
              </tr>
            </table>

          </div>
          <div style="clear: both;"></div>

          <button class="btn btn-primary" id="nextstep"> Next step </button>


          <h3 class="sub-header">Explanation</h2>
          <p class="text"></p>
          <h4 class="sub-header">Algorithm</h4>
          <p></p>
          <ol>
            <li> Hi </li>
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

      $("#nextstep").click(performStepMergesort);
      //$("#previousstep").click(previousStepPrim);

      <?php require_once("functions/javascripttable.js"); ?>
    </script>
  </body>
</html>
