<?php
require_once('controllers/quicksortController.php');
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
        <?php $active="quicksort"; require_once("_sidebar.php"); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Quick sort</h1>
          <table class="table table-bordered">
            <tr id="numbers">
              <?php for ($i = 0 ; $i < count($numbers); $i++){ ?>
                <td id="n<?php echo $i; ?>" class="<?php if ($i == (count($numbers) / 2)) { echo 'selected'; } ?>"><?php echo $numbers[$i]; ?></td>
              <?php } ?>
            </tr>
            <tr id="controllers">
              <td id="c0" class="selected"> i </td>
              <?php for ($i = 1 ; $i < count($numbers)-1; $i++){ ?>
              <td id="c<?php echo $i; ?>"></td>
              <?php } ?>
              <td id="c<?php echo count($numbers)-1; ?>"class="selected">j</td>
            </tr>
          </table>

          <button class="btn btn-primary" id="nextstep"> Next step </button>


          <h3 class="sub-header">Explanation</h2>
          <p class="text">
 Quicksort (sometimes called partition-exchange sort) is an efficient sorting algorithm, serving as a systematic method for placing the elements of an array in order. Developed by Tony Hoare in 1959,[1] with his work published in 1961,[2] it is still a commonly used algorithm for sorting. When implemented well, it can be about two or three times faster than its main competitors, merge sort and heapsort.[3]
Quicksort is a comparison sort, meaning that it can sort items of any type for which a "less-than" relation (formally, a total order) is defined. In efficient implementations it is not a stable sort, meaning that the relative order of equal sort items is not preserved. Quicksort can operate in-place on an array, requiring small additional amounts of memory to perform the sorting.
Mathematical analysis of quicksort shows that, on average, the algorithm takes O(n log n) comparisons to sort n items. In the worst case, it makes O(n2) comparisons, though this behavior is rare.
 </p>
          <h4 class="sub-header">Algorithm</h4>
          <p> The steps of Quicksort's algorithm are simple: </p>
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

      $("#nextstep").click(performStepQuicksort);
      //$("#previousstep").click(previousStepPrim);

      <?php require_once("functions/javascripttable.js"); ?>
    </script>
  </body>
</html>
