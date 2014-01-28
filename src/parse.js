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