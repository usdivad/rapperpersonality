/*
 * MATCHES
 */

//Find the most matches for a given rapper
function find_most_matches(rapper1, rapperList) {
	var matchesList = [];
	//get number of matches for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		//var matches = num_matches(rapper1, rapper2);
		var matches = match_score(rapper1, rapper2);
		if (typeof matches != "undefined") {
			rapper2["Matches"] = matches;
		}
		matchesList.push(rapper2);
	}

	//sort by matches in *descending* order
	matchesList.sort(function(a, b) {
		var aMatch = a["Matches"];
		var bMatch = b["Matches"];
		if (aMatch < bMatch) {
			return 1;
		}
		else if (aMatch > bMatch) {
			return -1;
		}
		else {
			return 0;
		}
	});

	return matchesList;
}

//Finds number of matches between any two rappers
/*function num_matches(rapper1, rapper2) {
	var n = 0;
	for (key in rapper1) {
		if (rapper1[key] == rapper2[key]) { //no e.c. needed?
			n++;
		}
	}
	return n;
}*/

//Finds number of matches, but takes into account multiple checkboxes
function match_score(rapper1, rapper2) {
	var score = 0;
	for (key in rapper1) {
			score += det_score(key, rapper1[key], rapper2[key]);
	}
	return score;
}

//Determines score for a given param: all inputs are strings
//value2 is "other"
function det_score(key, value1, value2) {
	var score = 0;
	var multiplier;

	//For one unit -> any
	//and MULTIPLIERS
	var DECADE = 3.14;
	var REGION = 2.24;
	var SOUND = 4.33;
	var DRINK = 1.23;
	var DRUG = 1.23;

	var from_radio = false;

	//Params with multiple selection
	if (key == "Decade") {
		multiplier = DECADE;
		from_radio = true;
	}
	else if (key == "Region") {
		multiplier = REGION;
		from_radio = true;
	}
	else if (key == "Sound") {
		multiplier = SOUND;
	}
	else if (key == "DrinkOfChoice") {
		multiplier = DRINK;
	}
	else if (key == "DrugOfChoice") {
		multiplier = DRUG;
	}
	else {
		//Params without multiple selection; unweighted anyways
		if (value1[key] == value2[key]) {
			score = 1;
			return score;
		}
	}

	//We scale it by number of values in value2
	var value1_arr = value1.split(", ");
	var value2_arr = value2.split(", ");
	var value_unit = 1/value2_arr.length;

	//For each value in value1 we check whether it's in value2
	for (var i=0; i<value1_arr.length; i++) {
		if (value2_arr.indexOf(value1_arr[i]) != -1) {
			//If from radio we add 1 for the whole score
			if (from_radio) {
				score = 1;
				i = value1_arr.length;
			}
			//For checkbox we add one unit for each match
			else {
				score += value_unit;
				//console.log("matched " + value1_arr[i]);
			}
		}
	}

	//We matched all of them for a given rapper! extra goodies
	if (score == 1) {
		score = 2;
	}
	score = score * multiplier;

	return score;
}
