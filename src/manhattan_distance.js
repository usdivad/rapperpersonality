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
	var closestList = [];
	//get dist for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var dist = manhattan_distance(rapper1, rapper2, paramList);
		if (typeof dist != "undefined") {
			rapper2["Distance"] = dist;
		}
		closestList.push(rapper2);
	}

	//sort by dist
	closestList.sort(function(a, b) {
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
	});

	return closestList;
}