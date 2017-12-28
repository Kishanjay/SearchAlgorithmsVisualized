<?php
class Edge {
	public static $WEIGHT_MIN = 1;
	public static $WEIGHT_MAX = 15;

	var $id;
	var $node1;
	var $node2;
	var $weight;
	var $selected;

	function Edge($node1, $node2, $weight){
		$this->id = $node1->getId() . "-" . $node2->getId();
		$this->node1 = $node1;
		$this->node2 = $node2;
		$this->weight = $weight;
		$this->selected = false;
	}

	// If this edge connects 2 nodes
	function isEqualValue($node1_id, $node2_id){
		if ($this->node1->getId() == $node1_id && $this->node2->getId() == $node2_id){
			return true;
		}
		if ($this->node1->getId() == $node2_id && $this->node2->getId() == $node1_id){
			return true;
		}
		return false;
	}

	// if this edge connects $node
	function contains($node){
		if ($this->node1->getId() == $node->getId()){
			return true;
		}
		if ($this->node2->getId() == $node->getId()){
			return true;
		}
		return false;
	}

	// Gets the other node that connects this edge
	function takeEdgeFrom($node){
		if ($this->node1->getId() == $node->getId()){
			return $this->node2;
		}
		if ($this->node2->getId() == $node->getId()){
			return $this->node1;
		}
		die ("Fatal error - improper use of function");
	}
}
?>