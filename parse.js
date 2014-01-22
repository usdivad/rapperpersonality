
//Get rapper score (overall)
function get_score(rapper) {
	var r_score = 0;

	//get attrs
	//var name = rapper["Rapper"];
	var drug = rapper["Drug of choice"];
	var drink = rapper["Drink of choice"];
	var age = rapper["Age/Audio Format"];
	var fashion = rapper["Fashion"];
	var region = rapper["Region"];
	var criminal = rapper["Criminal History"];
	var fitness = rapper["Food/Fitness/Body Type"];
	var intelligence = rapper["Intelligence"];
	var pimp = rapper["Pimp Hand"];
	var tattoos = rapper["Tattoos"];
	var sound = rapper["Sound"];


	//making the score
	//r_score = drugList[drug] + drinkList[drink] + ageList[age];
	r_score = parse(drugList, drug) + parse(drinkList, drink) + parse(ageList, age);
	return r_score;
}

function convert_to_number(rapper) {
	//get attrs
	var drug = rapper["Drug of choice"];
	var drink = rapper["Drink of choice"];
	var age = rapper["Age/Audio Format"];
}

//Parse an individual attribute from a list of scores
function parse(list, attr) {
	if (typeof list[attr] != "undefined") {
		//console.log()
		return list[attr];
	}
	else {
		console.log("No " + attr + " found in list!");
		return 5;
	}
}

//Calculate Manhattan distance using all available params
function manhattan_distance(rapper1, rapper2, params) {
	var md = 0;
	var i = 0;
	for (key in rapper1) {
		//get the drug they like
		var param_rapper1 = rapper1[key];
		var param_rapper2 = rapper2[key];
		//get the list with the right params
		var list = params[key];
		if (typeof list != "undefined") {
			var score_rapper1 = list[param_rapper1];
			var score_rapper2 = list[param_rapper2];
			//console.log(score_rapper1);
			if (typeof score_rapper1 != "undefined" && typeof score_rapper2 != "undefined") {
				//console.log(drug_rapper1, score_rapper1);
				md += attribute_difference(score_rapper1, score_rapper2);
			}
		}
		
		i++;
	}
	return md;
}

//Diff between attributes
function attribute_difference(attr1, attr2) {
	return Math.abs(attr2 - attr1);
}

//Find closest rappers
function find_closest(rapper1, rapperList, paramList) {
	//get dist for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var dist = manhattan_distance(rapper1, rapper2, paramList);
		if (typeof dist != "undefined") {
			rapper2["Distance"] = dist;
		}
	}

	//sort by dist
	rapperList.sort(function(a, b) {
		var aDist = a["Distance"];
		var bDist = b["Distance"];
		if (aDist < bDist) {
			return -1;
		}
		else if (aDist > bDist) {
			return 1;
		}
		else {
			//try randomization
			/*var dice = Math.random();
			if (dice >= 0.5) {
				return 1;
			}
			else {
				return -1;
			}*/
			return 0;
		}
	})

	return rapperList;
}

function find_most_matches(rapper1, rapperList, paramList) {
	//get number of matches for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var matches = num_matches(rapper1, rapper2);
		if (typeof matches != "undefined") {
			rapper2["Matches"] = matches;
		}
	}

	//sort by matches
	rapperList.sort(function(a, b) {
		var aMatch = a["Matches"];
		var bMatch = b["Matches"];
		if (aMatch < bMatch) {
			return -1;
		}
		else if (aMatch > bMatch) {
			return 1;
		}
		else {
			return 0;
		}
	})
}

function num_matches(rapper1, rapper2) {
	var n = 0;
	for (key in rapper1) {
		if (rapper1[key] == rapper2[key]) { //no e.c. needed?
			n++;
		}
	}
	return n;
}