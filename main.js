//Maindo
function main() {
	var rappers;

	//JSON req
	$.getJSON("rapper_stats.json", function(data) {
		console.log(data);
		rappers = data;
		console.log(rappers.length);

		//for (rapper in rappers) {
		for (var i=0; i<rappers.length; i++) {
			var rapper = rappers[i];
			//console.log(rapper);
			rapper_score = get_score(rapper);
			//console.log(rapper["Rapper"] + ": " + rapper_score);
		}

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
		var closest = find_closest(r1, rappers, allParams);
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

	}); //end JSON req
}

$(document).ready(function() {
	main();
})