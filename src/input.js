
/*
 *INPUT and OUTPUT
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
	var results = get_html(you, data);
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

function get_html(user, data) {
	var result_arr = calculatePersonality(user, data);
	var who = result_arr[0];
	var NUM_OUTPUT = 10;
	var str = "<br><br>";

	//Sample output; region-filtered then ordered by score function. Only alternate suggestions (non-first) are shuffled
	//Compatibility calculation
	var max_score = match_score(who, who);
	var compatibility = compatibility_score(who["Matches"], max_score);
	var high_compatibility = (compatibility > 80);


	//First
	str += "You are <strong>" + who["Rapper"] + "</strong>!"
	if (high_compatibility) { //only if it's a high compatibility
		str += " You have a compatibility score of " + compatibility + "%";
	}
	str += "<br><br>";

	//JSON
	var base_url = "http://zumic.com/?json=get_search_results&search="
	var query = who["Rapper"];
	var url_extension = "&post_type=artist-page&page=0";
	var json_request = base_url + query + url_extension;

	//Rest
	str += "However, you could also be:<br>"
	//i=0 for shuffled array, i=1 for original array
	for (var i=1; i<NUM_OUTPUT; i++) {
		var alt_who = result_arr[i];
		if (typeof alt_who == "undefined") { //make sure we haven't run out of rappers
			i = NUM_OUTPUT;
		}
		else {
			str += "<strong>" + alt_who["Rapper"] + "</strong>";
			if (high_compatibility) {
				str += " (compatibility of " + compatibility_score(alt_who["Matches"], max_score) + "%)";
			}
			str += "<br>";
		}
	}

	return str;
}
