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
	var DECADE = 3;
	var REGION = 2;
	var SOUND = 4;
	var DRINK = 1;
	var DRUG = 1;

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

/*
 * PARSE
 */

//Calculate personality based on MD and matches from rapper database
//uses matches.js and manhattan
//1/28 removed: paramList parameter
function calculatePersonality(user, data) {
		var NUM_OUTPUT = 10;
		var str = "<br><br>";

		//Sample output; region-filtered then ordered by score function. Only alternate suggestions (non-first) are shuffled
		var data_filtered = filter_by_region(user, data);
		console.log(data_filtered);
		var most_matches;
		//in case user hasn't picked a region
		if (data_filtered.length > 0) {
			most_matches = find_most_matches(user, data_filtered);
		}
		else {
			most_matches = find_most_matches(user, data);
		}
		var most_matches_shuffled = find_most_matches(user, shuffle(most_matches));
		var who = most_matches[0];
		//First
		str += "You are <strong>" + who["Rapper"] + "</strong>! You have "
				+ "a compatibility score of " + who["Matches"] + "<br><br>";
		//Rest
		str += "However, you could also be:<br>"
		//i=0 for shuffled, i=1 for original
		for (var i=0; i<NUM_OUTPUT; i++) {
			var alt_who = most_matches_shuffled[i];
			if (typeof alt_who == "undefined") { //make sure we haven't run out of rappers
				i = NUM_OUTPUT;
			}
			else {
				str += "<strong>" + alt_who["Rapper"] + "</strong> (compatibility score of "
					+ alt_who["Matches"] + ") <br>";
			}
		}

		return str;
}

//Filters out rappers who aren't in user's chosen region (RIVALRIES!)
function filter_by_region(user, data) {
	console.log("filtering");
	var filtered = [];
	for (var i=0; i<data.length; i++) {
		var rapper = data[i];
		var rapper_regions = rapper["Region"].split(", ");
		for (var j=0; j<rapper_regions.length; j++) {
			if (user["Region"] == rapper_regions[j]) {
				filtered.push(rapper);
				//console.log("You and " + rapper["Rapper"] + " both are from " + rapper_regions[j] + user["Region"]);
			}
		}
	}
	console.log(filtered);
	return filtered;
}

//Knuth shuffle (from https://github.com/coolaj86/knuth-shuffle)
//modified to return a NEW array **with the original's first element removed!!
//original_array should be sorted already
function shuffle(original_array) {
  var array = [];
  for (var i=1; i<original_array.length; i++) { //remove first element
  	array.push(original_array[i]);
  }
  console.log("pre-shuf");
  console.log(array);	
  var currentIndex = array.length
    , temporaryValue
    , randomIndex
    ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

/*TESTER*/
//1/28: removed paramList parameter
function test_parse(data) {

		//Data parsing
		console.log("From test_parse: ");
		console.log(data);
		rappers = data;
		console.log(rappers.length);

		//Tester params
		var str = "";
		var NUM_OUTPUT = 10;

		//case 1
		var r1 = {"Rapper":"Mister Twister","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"Facial","Food_Fitness_BodyType":"short","Intelligence":"Dumb","CriminalHistory":"None","PimpHand":"Legit Pimp","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"Weed"};
		//r1 = {"Rapper":"Nelly","Decade":"1990s, 2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed"};

		//case 2
		//r1 = {"Rapper":"Slim Jim","Drug of choice":"Acid","Drink of choice":"Champagne/Wine","Age/Audio Format":"Cassettes","Fashion":"Upscale","Region":"Dirty South","Criminal History":"Drug dealer","Food/Fitness/Body Type":"tall, fat","Intelligence":"Smart","Pimp Hand":"Pussy whipped","Tattoos":"Facial","Sound":"Pop/underground/alternative"};

		//case 3
		for (key in rappers[19]) {
			r1[key] = rappers[19][key];
		}
		//r1["Sound"] = "Pop";
		//console.log(r1);

		//Testing Manhattan distance
		/*
		var closest = find_closest(r1, rappers, paramList);
		str += "Closest rappers according to Manhattan distance are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += closest[i]["Rapper"] + " with a distance of " + closest[i]["Distance"] + "\n";
		}
		//console.log(closest);
		*/

		//Testing matches
		var most_matches = find_most_matches(r1, rappers);
		str += "Your name is " + r1["Rapper"] + "! \n";
		str += "\n Closest rappers according to most matches are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches \n";
		}
		//console.log(most_matches);
		console.log(str);
}


/*
 *INPUT
 */

//Creates form, fills in attributes
//requires: paramList from params.js
function createForm(data, paramList) {
	//generating the form params
	var example = data[0];
	//var content = $("#content");
	var inner = "";
	//inner += "<form id='inputForm'>";
	for (key in example) {
		if (key != "Rapper") { //no rappers in paramList, only attrs
			inner += "<br><strong>" + key + "</strong><br>";
			var keyList = paramList[key];
			//console.log(keyList);
			if (typeof keyList != "undefined") {
				for (pKey in keyList) {
					//console.log(pKey);
					inner += "<input type='radio' "
							+ "name='" + key + "'"
							+ "id='" + pKey + "'"
							+ "value='" + pKey + "'"
							+ ">" + " "
							+ "<label for='" + pKey + "'>"
							+ pKey + "</label><br>";
				}
			}
		} //endif
	}
	//inner += "</form>";
	inner += "<br>";
	//submit action

	//return the created form
	//console.log(inner);
	return inner;
}

//Submit function
function getSubmit(data) {
	var you = getUser(data);
	var results = calculatePersonality(you, data);
	return results;
}

//Creates user profile based on form data
function getUser(data) {
	var example = data[0];;
	var user = {};
	for (key in example) {
		if (key != "Rapper") {
			var inputQuery = "input[name=" + key + "]:checked";
			var query_arr = $(inputQuery);
			var traits = [];
			var traits_str = "";

			//get traits from query_arr
			for (var i=0; i<query_arr.length; i++) {
				traits.push(query_arr[i].value);
			}
			//concat into string to pass into calculator
			traits_str = traits.join(", ");

			if (typeof traits_str != "undefined") {
				user[key] = traits_str;
				//console.log(user["key"]);
			}
			else {
				console.log("You're missing a " + key + ", son");
			}
		}
	}
	console.log("You are: ");
	console.log(user);
	return user;
}
/*
 * MAINDO
 */
function main() {
	//var rappers;

	//JSON req
	$.getJSON("./src/rapper_stats.json", function(data) {
		//rappers = data;
		//$("#inputForm").append(createForm(data, allParams));
		$("#submitButton").click(function() {
			var r = getSubmit(data);
			$("#results").html(r);
		});
		//getSubmit(data);
		test_parse(data);

	}); //end JSON req
}

$(document).ready(function() {
	main();
})
