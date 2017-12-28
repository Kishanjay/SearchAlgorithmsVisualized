var startIndex = 0;
var endIndex = <?php echo count($numbers)-1; ?>;

var index_p = rounder((endIndex+1)/2); // pivot
var index_i = 0;
var index_j = endIndex;

var indexes_done = [];
var unsolved = [];

var numbers = <?php echo json_encode($numbers); ?>; 
var parts = [<?php echo json_encode($numbers); ?>];
var status = 0;

function performStepMergesort(){
	if (status == 2){
		console.log("finished");
		return;
	}
	var moddedParts = [];


	// split parts
	if (status == 0){
		var split = false;
		for (var i = 0; i < parts.length; i++){
			console.log(parts[i]);
			if (parts[i].length <= 2){
				moddedParts.push(parts[i]);
				console.log("good part");
				continue
			}
			else {
				console.log("split part");
				var splitIndex = parseInt(parts[i].length / 2);
				var part1 = parts[i].slice(0, splitIndex);
				var part2 = parts[i].slice(splitIndex);
				moddedParts.push(part1);
				moddedParts.push(part2);
				split = true;
			}
		}

		parts = moddedParts;

		// sort
		if (split == false){
			status = 1;
			console.log("sort");
			for (var i = 0; i < parts.length; i++){
				parts[i].sort(compareNumbers);
			}
		}
	}


	// merge
	else if (status == 1){
		console.log("merging");
		for (var i = 0; i < parts.length; i++){
			if (i+1 < parts.length && parts[i+1].length == 1){
				moddedParts.push(parts[i]);
				continue
			}
			if (i+1 < parts.length){
				var merged = parts[i].concat(parts[i+1]).sort(compareNumbers);
				moddedParts.push(merged);
				i++;
			}	
		}
		parts = moddedParts;
	}
	
	addTable(parts);
	if (parts.length == 1){
		status = 2;
	}

}

function addTable(parts){
	console.log(parts);
	var amountOfTables = parts.length;
	var tables = $("#tables");
	var width = 100/amountOfTables;
	for (var i = 0; i < parts.length; i++){
		width = (parts[i].length / numbers.length) * 100;
		tables.append(createTable(width,parts[i]));	
	}	
}

function createTable(width, items){
	var table = document.createElement("table");
	table.classList.add("table");
	table.classList.add("table-bordered");
	table.style.width = width-1 + "%";
	table.style.marginRight = "1%";
	table.style.float = "left";
	// Create an empty <tr> element and add it to the 1st position of the table:
	var row = table.insertRow(0);

	for (var i = 0; i < items.length; i ++ ){
		var cell = row.insertCell(i);
		cell.innerHTML = items[i];
	}
	
	return table;
}

function performStepQuicksort(){
	if (isFinished()){ return; }
	var number1 = getNumberByIndex(index_i);
	var number2 = getNumberByIndex(index_j);
	var pivot =  getNumberByIndex(index_p);

	if (index_i == index_j){
		// new instance
		indexes_done.push(index_i);

		if (index_i != 0){
			var part1 = [startIndex, index_i-1];
			if (part1[0] < part1[1]){
				unsolved.unshift(part1);
			}
			else { indexes_done.push(part1[0]); indexes_done.push(part1[1]);}
		}
		if (index_i != endIndex){
			var part2 = [index_i+1, endIndex];
			if (part2[0] < part2[1]){
				unsolved.push(part2);
			}
			else { indexes_done.push(part2[0]); indexes_done.push(part2[1]);}
		}
		
		if (unsolved.length > 0){
			var newpart = unsolved.shift();

			startIndex = newpart[0];
			endIndex = newpart[1];
			index_i = newpart[0];
			index_j = newpart[1];
			index_p = rounder((endIndex - startIndex ) / 2) + startIndex;
		}
		else {
			console.log("finished!");
		}
	}
	else if (number1 >= pivot && number2 <= pivot){
		// do this
		swapNumbers(index_i, index_j);
	}
	else if (number1 < pivot){
		index_i ++;
	}
	else if (number2 > pivot){
		index_j --;
	}
	updateTable();
}

function isFinished(){
	var amountOfNumbers = $("#numbers")[0].children.length;
	console.log(indexes_done.filter(onlyUnique).length + "/" + amountOfNumbers);
	if (indexes_done.filter(onlyUnique).length == amountOfNumbers){
		console.log("finished");
		return true;
	}
	return false;
}

function swapNumbers(index1, index2){
	var number1 = getNumberByIndex(index1);
	var number2 = getNumberByIndex(index2);

	setNumberByIndex(index1, number2);
	setNumberByIndex(index2, number1);

	if (index1 == index_p){
		index_p = index2;
	}
	else if (index2 == index_p){
		index_p = index1;
	}
}

function setNumberByIndex(index, value){
	$("#n" + index).html(value);
}

function getNumberByIndex(index){
	return parseInt($("#n" + index).html());
}

function getControllerByIndex(index){
	return ($("#c" + index).html());
}


function updateTable(){
	var numberColumns = $("#numbers")[0].children.length;

	// wipe style
	for (var i = 0; i < numberColumns; i++){
		$("#c" + i).removeClass("selected");
		$("#n" + i).removeClass("selected");
		$("#c" + i).html("");
	}

	// insert new style
	if (!isFinished()){
		$("#n" + index_p).addClass("selected");
		$("#c" + index_i).addClass("selected");
		$("#c" + index_j).addClass("selected");
		$("#c" + index_j).html("j");
		$("#c" + index_i).html("i");
	}

	// show dones
	for (var i = 0; i < indexes_done.length; i ++){
		$("#n" + indexes_done[i]).addClass("done");
	}

}


function rounder(number){
	if (number === parseInt(number, 10)){
		return number;
	}
	return parseInt(number+1);
}

// TESTING
function assertInt(num1, num2){
	if (num1 !== num2){
		display_error ("assertion ERROR" + num1 + "!="  + num2);
	}
}

function display_error(msg){
  console.log(msg);
}

function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

assertInt(rounder(1.5), 2);
assertInt(rounder(1.2), 2);
assertInt(rounder(1.9), 2);

function compareNumbers(a, b)
{
    return a - b;
}