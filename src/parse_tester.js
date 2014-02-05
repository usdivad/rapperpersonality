
/*TESTER*/
//1/28: removed paramList parameter
function test_parse(data) {

		//Data parsing
		console.log("From test_parse: ");
		console.log(data);
		rappers = data;
		console.log(rappers.length);

		//Tester params
		//var str = "";
		var NUM_OUTPUT = 2;

		//case 1
		var r1 = {"Rapper":"Mister Twister","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"Facial","Food_Fitness_BodyType":"short","Zone":"Getting your freak on","Intelligence":"Dumb","CriminalHistory":"None","PimpHand":"Legit Pimp","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"Weed"};

		//testing EVERY rapper with themselves
		/*
		for (var i=0; i<rappers.length; i++) {
			var str = "";
			for (key in rappers[i]) {
				r1[key] = rappers[i][key];
			}
			//r1["Sound"] = "Pop";
			//console.log(r1);

			//Testing Manhattan distance
			
			// var closest = find_closest(r1, rappers, paramList);
			// str += "Closest rappers according to Manhattan distance are: \n";
			// for (var i=0; i<NUM_OUTPUT; i++) {
			//	str += closest[i]["Rapper"] + " with a distance of " + closest[i]["Distance"] + "\n";
			// }
			//console.log(closest);
			

			//Testing matches
			console.log("testing matches:");
			var most_matches = find_most_matches(r1, rappers);
			str += "Your name is " + r1["Rapper"] + "! \n";
			str += "\n Closest rappers according to most matches are: \n";
			for (var i=0; i<NUM_OUTPUT; i++) {
				str += most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches \n";
			}
			//console.log(most_matches);
			console.log(str+"\n");
		}
		*/

}

