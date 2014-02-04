
/*
 * PARSE
 */

//Calculate personality based on MD and matches from rapper database
//uses matches.js and manhattan
//1/30: the whole thing gets shuffled!
function calculatePersonality(user, data) {
	
	//You: region-filtered then ordered by score function. Only alternate suggestions (non-first) are shuffled
	var data_filtered = filter_by_region(user, data);
	console.log("Filtered data: ");
	console.log(data_filtered);
	var most_matches;
	var who;
	//in case user hasn't picked a region
	if (data_filtered.length > 0) {
		most_matches = find_most_matches(user, data_filtered); //unshuffled
	}
	else {
		most_matches = find_most_matches(user, data); //unshuffled!
	}
	
	//Shuffling the rest
	
	who = most_matches.splice(0, 1)[0]; //[0]
	console.log(most_matches.length);

	most_matches = find_most_matches(user, shuffle(most_matches));
	most_matches.unshift(who);
	console.log(most_matches.length);
	
	console.log("Final matches: ");
	console.log(most_matches);
	return most_matches;
}

//Scales compatibility score out of 100%
function compatibility_score(score, max) {
	return ((score/max)*100).toFixed(1);
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
	//console.log(filtered);
	return filtered;
}

//Knuth shuffle (from https://github.com/coolaj86/knuth-shuffle)
//re-modified back to original
function shuffle(array) {
  /*
  var array = [];
  for (var i=1; i<original_array.length; i++) { //remove first element
  	array.push(original_array[i]);
  }
  */
  //console.log("pre-shuf");
  //console.log(array);	
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
