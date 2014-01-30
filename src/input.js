
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
	var url_self = "http://zumic.com/rapper-personality-quiz/";
	var result_arr = calculatePersonality(user, data);
	var who = result_arr[0];
	var NUM_OUTPUT = 10;
	var custom_text = who["ResultText"];

	var str = "<div id='results_div'>";

	//Sample output; 
	//Compatibility calculation
	var max_score = match_score(who, who);
	var compatibility = compatibility_score(who["Matches"], max_score);
	var high_compatibility = (compatibility > 80);


	//First rapper: who are you?
	str += "<div id='you_are'>"
	

	//Using placeholder text
	if (custom_text == "RESULT TEXT PLACEHOLDER") {
	 	custom_text = "Your rapper personality is " + who["Rapper"] + "!";
	 }
	str += custom_text;



	/*if (high_compatibility) { //only if it's a high compatibility
		str += " You are " + compatibility + "% compatible.";
	}*/
	str += "<div id='img_div'><img id='first_rapper_image'></div>";
	str += "<br>For " + who["Rapper"] + "'s latest music, news and tour dates, check out their <a id='first_rapper_link'>Zumic artist page</a>."
	str += "</div>"; //end you_are

	//Share: [facebook, twitter, google+, tumblr links]
	str += "<br>";
	str += "Share your results:";
	str += "<br>"

	//Facebook
	//str += '<div id="fb_share_result" class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="700px" data-height="200px" width="500px" height="100px" data-type="button"></div>';
	//str += '<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="500px" data-type="button"></div>'
	str += "<a id='fb_share_result' href='#'><img src='http://zumic.zumicentertainme.netdna-cdn.com/wp-content/uploads/2014/01/fb_share.png'></a>";

	//Twitter
	str += '<a href="https://twitter.com/share" id="twitter_share_result" class="twitter-share-button" data-url="' + url_self +'" data-text="Rapper Personality Quiz!" data-via="zumic"><img src="http://zumic.zumicentertainme.netdna-cdn.com/wp-content/uploads/2014/01/twitter_share.png"></a>';

	str += "<br><br>";

	//TESTING: json get artists whose pages we do and don't have
	/*
	var test_base_url = "/";
	console.log("ARTISTS WE HAVE: ");
	var have_artists = 0;
	var artists_with_pages = function(i, data) {
		//console.log(i);
		if (i < data.length) {
			var artist_request = {
				"json": "get_search_results",
				"search": data[i]["Rapper"],
				"post_type": "artist-page",
				"page": 0
			}
			$.getJSON(test_base_url, artist_request, function(artist_data) {
				var post = artist_data["posts"][0];
				if (typeof post != "undefined") {
					//console.log(artist_request["search"] + "\n");
					//have_artists++;
				}
				else {
					console.log(artist_request["search"] + "\n");
					have_artists++;
				}
				artists_with_pages(i+1, data);
			});
		}
		else {
			console.log("We're missing " + have_artists + " out of " + i + " artist pages");
		}
	};

	artists_with_pages(0, data);
	*/

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
		var artist_page_url = "http://zumic.com/post-type/artist-page";
		var img_url = "http://zumic.zumicentertainme.netdna-cdn.com/wp-content/uploads/2014/01/jayz_small.png";
		if (typeof post != "undefined") {
			artist_page_url = post["url"];
			try {
				img_url = post["thumbnail_images"]["medium"]["url"];
			}
			catch(e) {
				console.log("No image found, buddy");
			}
		}


		//fb button
		
		//fb new
		var social_desc = "Which rapper are you?";
		var fb_share = function() {
			FB.ui({
				method: "feed",
				name: "My rapper personality is " + who["Rapper"] + "!",
				//name: you_to_me(custom_text),
				link: url_self,
				picture: img_url,
				description: social_desc + " Take the quiz on Zumic to find out!",
				app_id: 1375271719406903
			}, function(response) {
				if (response && response.post_id) {}
				else{}
			});
		};

		var twitter_text = "My rapper personality is " + who["Rapper"] + "! Take the quiz on Zumic to find out yours: ";
		
		var twitter_url = "https://twitter.com/intent/tweet?original_referer=" + url_self
						//+ "&text=" + you_to_me(custom_text) + " " + social_desc
						+ "&text=" + twitter_text
						+ "&url=" + url_self
						+ "&via=zumic";

		//!!set attributes of html elems
		$("#first_rapper_link").attr("href", artist_page_url);
		$("#first_rapper_image").attr("src", img_url);
		$("#subtitle").html("");

		//fb old
		//$("#fb_share_result").attr("href", fb_url);
		
		//fb new
		$("#fb_share_result").click(function() {
			fb_share();
		});

		//twitter
		//$("#twitter_share_result").attr("data-text", twitter_text);
		$("#twitter_share_result").attr("href", twitter_url);

	});

	//Alternate rappers
	var alternate_rappers = [];
	str += "You could also be:<br>"
	//i=0 for shuffled array, i=1 for original array
	for (var i=1; i<NUM_OUTPUT; i++) {
		var alt_who = result_arr[i];
		if (typeof alt_who == "undefined") { //make sure we haven't run out of rappers
			i = NUM_OUTPUT;
		}
		else {
			var name = alt_who["Rapper"];
			var id = "alt_rapper_" + i;
			alternate_rappers.push({"name": name, "id": id});
			str += "<a id='" + id + "' href='http://zumic.com/post-type/artist-page'>" + name + "</a>";
			/*if (high_compatibility) {
				str += " (compatibility of " + compatibility_score(alt_who["Matches"], max_score) + "%)";
			}*/
			if (i == NUM_OUTPUT-1) {
				str += ".";
			}
			else if (i == NUM_OUTPUT-2) {
				str += ", or "
			}
			else {
				str += ", ";
			}
		}
	}

	str += "</div>"; //end results_div

	//Getting links for alternate "you could be"s
	var alt_artists = function(i, artists) {
		//console.log(i);
		if (i < artists.length) {
			var artist_request = {
				"json": "get_search_results",
				"search": artists[i]["name"],
				"post_type": "artist-page",
				"page": 0
			}
			$.getJSON(base_url, artist_request, function(artist_data) {
				var post = artist_data["posts"][0];
				if (typeof post != "undefined") {
					//console.log("found ");
					var artist_page_url = post["url"];
					var link_query = "#" + artists[i]["id"];
					$(link_query).attr("href", artist_page_url);
				}
			});
			alt_artists(i+1, artists); //recursively do json reqs
		}
		else {
		}
	};
	alt_artists(0, alternate_rappers);


	return str;
}

//From 2nd person to 1st person!
function you_to_me(s) {
	s = s.replace(/you're/g, "I'm");
	s = s.replace(/You're/g, "I'm");
	s = s.replace(/You are/g, "I am");
	s = s.replace(/you are/g, "I am");
	s = s.replace(/your/g, "my");
	s = s.replace(/Your/g, "My");
	s = s.replace(/you/g, "me");
	s = s.replace(/You/g, "Me");
	return s;
}
