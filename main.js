//Maindo
function main() {
	//var rappers;

	//JSON req
	$.getJSON("rapper_stats.json", function(data) {
		//rappers = data;
		$("#inputForm").append(createForm(data, allParams));
		$("#submitButton").click(function() {
			getSubmit(data);
		});
		//getSubmit(data);
		//test(data, allParams);

	}); //end JSON req
}

//Creates form, fills in attributes
function createForm(data, paramList) {
	//generating the form params
	var example = data[0];
	//var content = $("#content");
	var inner = "";
	//inner += "<form id='inputForm'>";
	for (key in example) {
		if (key != "Rapper") { //no rappers in paramList, only attrs
			inner += "<strong>" + key + "</strong><br>";
			var keyList = paramList[key];
			//console.log(keyList);
			if (typeof keyList != "undefined") {
				for (pKey in keyList) {
					//console.log(pKey);
					inner += "<input type='radio' "
							+ "name='" + key + "'"
							+ "value='" + pKey + "'"
							+ ">" + pKey + "<br>";
				}
			}
		} //endif
	}
	//inner += "</form>";

	//submit action

	//return the created form
	return inner;
}

//Creates user profile based on form data
function getSubmit(data) {
	var example = data[0];;
	var user = {};
	for (key in example) {
		if (key != "Rapper") {
			var inputQuery = "input:radio[name=" + key + "]:checked";
			//console.log(inputQuery);
			var q_value = $(inputQuery).val();
			if (typeof q_value != "undefined") {
				user[key] = q_value;
				//console.log(user["key"]);
			}
		}
	}
	console.log(user);
}

function setInput(data, paramList) {
	//$("li")
}

//Tester
function test(data, paramList) {

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

$(document).ready(function() {
	main();
})