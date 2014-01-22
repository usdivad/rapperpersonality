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
		var r0 = rappers[0];
		//var r1 = rappers[23];
		var r1 = {"Rapper":"Mister Twister","Drug of choice":"Weed","Drink of choice":"Beer","Age/Audio Format":"MP3","Fashion":"Hipster","Region":"West Coast","Criminal History":"Might have killed someone","Food/Fitness/Body Type":"stocky","Intelligence":"Dumb","Pimp Hand":"Legit Pimp","Tattoos":"many","Sound":"Classic"};
		//console.log("dist between " + r0["Rapper"] + " and " + r1["Rapper"] + " is " + manhattan_distance(r0, r1, allParams));

		//Testing Manhattan distance
		var closest = find_closest(r1, rappers, allParams);
		console.log("Closest rappers according to Manhattan distance are: ");
		for (var i=0; i<5; i++) {
			console.log(closest[i]["Rapper"] + " with a distance of " + closest[i]["Distance"]);
		}
		console.log(closest);

		//Testing matches
		var most_matches = find_most_matches(r1, rappers, allParams);
		console.log("Closest rappers according to most matches are: ");
		for (var i=0; i<5; i++) {
			console.log(most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches");
		}
		console.log(most_matches);
	});
}

$(document).ready(function() {
	main();
})