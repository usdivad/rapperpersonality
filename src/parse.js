//Calculate personality based on MD and matches from rapper database
function calculatePersonality(user, data, paramList) {
		var NUM_OUTPUT = 5;
		var str = "<br><br>";

		//Sample output
		var most_matches = find_most_matches(user, data);
		var closest = find_closest(user, data, paramList);
		var who = most_matches[0]
		str += "You are <strong>" + who["Rapper"] + "</strong>! You have "
			+ who["Matches"] + " traits in common and a rap proximity of " + who["Distance"] + "<br><br>";
		str += "However, you could also be:<br>"
		for (var i=1; i<NUM_OUTPUT; i++) {
			var alt_who = most_matches[i];
			str += "<strong>" + alt_who["Rapper"] + "</strong> ("
				+ alt_who["Matches"] + " traits and a rap proximity of " + alt_who["Distance"] + ") <br>";
		}

		/*
		//Testing matches
		var most_matches = find_most_matches(user, data);
		str += "<br> Closest rappers according to most matches are: <br>";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches <br>";
		}

		//Testing Manhattan distance
		var closest = find_closest(user, data, paramList);
		str += "Closest rappers according to distance are: <br>";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += closest[i]["Rapper"] + " with a distance of " + closest[i]["Distance"] + "<br>";
		}
		*/

		return str;
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

//Find the most matches for a given rapper
function find_most_matches(rapper1, rapperList) {
	//get number of matches for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var matches = num_matches(rapper1, rapper2);
		if (typeof matches != "undefined") {
			rapper2["Matches"] = matches;
		}
	}

	//sort by matches in *descending* order
	rapperList.sort(function(a, b) {
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

	return rapperList;
}

//Finds number of matches between any two rappers
function num_matches(rapper1, rapper2) {
	var n = 0;
	for (key in rapper1) {
		if (rapper1[key] == rapper2[key]) { //no e.c. needed?
			n++;
		}
	}
	return n;
}


//Tester
function test_parse(data, paramList) {

		//Data parsing
		console.log(data);
		rappers = data;
		console.log(rappers.length);

		//Tester params
		var str = "";
		var NUM_OUTPUT = 10;

		//case 1
		var r1 = {"Rapper":"Mister Twister","Drug of choice":"Weed, Lean","Drink of choice":"Beer","Age/Audio Format":"Vinyl","Fashion":"Hipster","Region":"West Coast","Criminal History":"Might have killed someone","Food/Fitness/Body Type":"stocky","Intelligence":"Dumb","Pimp Hand":"Legit Pimp","Tattoos":"many","Sound":"Classic"};

		//case 2
		r1 = {"Rapper":"Slim Jim","Drug of choice":"Acid","Drink of choice":"Champagne/Wine","Age/Audio Format":"Cassettes","Fashion":"Upscale","Region":"Dirty South","Criminal History":"Drug dealer","Food/Fitness/Body Type":"tall, fat","Intelligence":"Smart","Pimp Hand":"Pussy whipped","Tattoos":"Facial","Sound":"Pop/underground/alternative"};

		//case 3
		for (key in rappers[46]) {
			r1[key] = rappers[46][key];
		}
		r1["Sound"] = "Pop";
		console.log(r1);

		//Testing Manhattan distance
		var closest = find_closest(r1, rappers, paramList);
		str += "Closest rappers according to Manhattan distance are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += closest[i]["Rapper"] + " with a distance of " + closest[i]["Distance"] + "\n";
		}
		//console.log(closest);

		//Testing matches
		var most_matches = find_most_matches(r1, rappers);
		str += "\n Closest rappers according to most matches are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches \n";
		}
		//console.log(most_matches);
		console.log(str);
}