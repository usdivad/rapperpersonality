
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
	var str = "<div id='results_div'>";

	//Sample output; 
	//Compatibility calculation
	var max_score = match_score(who, who);
	var compatibility = compatibility_score(who["Matches"], max_score);
	var high_compatibility = (compatibility > 80);


	//First rapper: who are you?
	str += "<div id='you_are'>"
		+ "Your closest rapper personality is <b>" + who["Rapper"] + "</b>!";
	if (high_compatibility) { //only if it's a high compatibility
		str += " You are " + compatibility + "% compatible.";
	}
	str += "<div id='img_div'><img id='first_rapper_image'></div>";
	str += "<br>For " + who["Rapper"] + "'s latest music, news and tour dates, check out their <a id='first_rapper_link'>Zumic artist page</a>."
	str += "</div>"; //end you_are

	//Share: [facebook, twitter, google+, tumblr links]
	str += "<br><br>";
	str += "Share your results:";
	str += "<br>"

	//Facebook
	//str += '<div id="fb_share_result" class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-type="button"></div>';
	str += "<a id='fb_share_result'>Share on Facebook</a>";
	str += "<br><br>"

	//JSON req; fill in the links and images
	var base_url = "/"; // so not cross-domain
	var json_request = {
		"json": "get_search_results",
		"search": who["Rapper"],
		"post_type": "artist-page",
		"page": 0
	}
	$.getJSON(base_url, json_request, function(zumic_data) { //error-check the ind reqs
		console.log(zumic_data);
		var post = zumic_data["posts"][0];
		var artist_page_url = post["url"];
		var img_url = post["thumbnail_images"]["medium"]["url"];


		//fb button
		//old
		fb_url = "http://www.facebook.com/sharer.php?s=100&";
		fb_url += "&p[url]=http://zumic.com/rapper-personality-quiz/"
				+ "&p[images][0]=" + img_url
				+ "&p[title]=My closest rapper personality on Zumic is " + who["Rapper"] + "!"
				+ "&p[summary]=Which rapper are you? Take the quiz to find out!";
		
		//new
		var fb_share = function() {
			FB.ui({
				method: "feed",
				name: "My rapper personality is " + who["Rapper"] + "!",
				link: "http://zumic.com/rapper-personality-quiz/",
				picture: img_url,
				description: "Which rapper are you? Take the quiz on Zumic to find out!",
				app_id: 1375271719406903
			}, function(response) {
				if (response && response.post_id) {}
				else{}
			});
		};

		var fb_share_simple = function() {
			FB.ui(
				 {
				  method: 'feed'
				 }
			);
		};
		

		//set attributes of html elems
		$("#first_rapper_link").attr("href", artist_page_url);
		$("#first_rapper_image").attr("src", img_url);
		//$("#fb_share_result").attr("href", fb_url);
		
		//new
		$("#fb_share_result").click(function() {
			fb_share();
		})

	});

	//Alternate rappers
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

	str += "</div>"; //end results_div

	return str;
}
