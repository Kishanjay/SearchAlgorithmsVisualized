<?php
class Node {
	public static $NODES_MIN = 2;
	public static $NODES_MAX = 5;

	var $id;
	var $initial;
	var $selected;
	var $weightHistory;	// history of the weights to other nodes
	var $pathToInitial; // array [totalweight, parent]

	function Node($id, $initial = false){
		$this->id = $id;
		$this->initial = $initial;
		$this->selected = $initial;
		$this->weightHistory = array(); // empty

		$this->pathToInitial = [-1, -1];
		if ($this->initial){
			$this -> pathToInitial = [0, $id];
		}
	}

	function getId(){
		return $this->id;
	}
}

?>