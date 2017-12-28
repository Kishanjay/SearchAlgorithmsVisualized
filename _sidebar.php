<div class="col-sm-3 col-md-2 sidebar" id="sidebar">
  <ul class="nav nav-sidebar">
    <li class="title">Graph algorithms</li>
    <li class="<?php if ($active === "dijkstra") echo "active"; ?>"><a href="dijkstra.php">Dijkstra's algorithm</a></li>
    <li class="<?php if ($active === "prim") echo "active"; ?>"><a href="prim.php">Prim's algorithm</a></li>
  </ul>
  <ul class="nav nav-sidebar">
    <li class="title">Sorting algorithms</li>
    <li class="<?php if ($active === "quicksort") echo "active"; ?>"><a href="quicksort.php">Quick sort</a></li>
    <li class="<?php if ($active === "mergesort") echo "active"; ?>"><a href="mergesort.php">Merge sort</a></li>
  </ul>
  <!--
  <ul class="nav nav-sidebar">
    <li class="title">Other</li>
    <li class=""><a href="">LaTeX</a></li>
    <li class=""><a href="">Whatever more</a></li>
  </ul>
  -->
</div>