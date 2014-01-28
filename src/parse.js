//Calculate personality based on MD and matches from rapper database
//uses matches.js and manhattan
//1/28 removed: paramList parameter
function calculatePersonality(user, data) {

		var NUM_OUTPUT = 10;
		var str = "<br><br>";

		//Sample output; ordered primarily by #matches and secondarily by proximity
		//var closest = find_closest(user, data, paramList);
		//var data_by_decade = sort_decade(user, data)
		//console.log(data_by_decade);
		var most_matches = find_most_matches(user, data);
		var most_matches_shuffled = find_most_matches(user, shuffle(most_matches));
		var who = most_matches[0];
		str += "You are <strong>" + who["Rapper"] + "</strong>! You have "
				+ "a compatibility score of " + who["Matches"] + "<br><br>";
			//+ who["Matches"] + " traits in common and a rap proximity of " + who["Distance"] + "<br><br>";
		str += "However, you could also be:<br>"
		for (var i=1; i<NUM_OUTPUT; i++) {
			var alt_who = most_matches_shuffled[i];
			str += "<strong>" + alt_who["Rapper"] + "</strong> (compatibility score of "
				+ alt_who["Matches"] + ") <br>";
				//+ alt_who["Matches"] + " traits and a rap proximity of " + alt_who["Distance"] + ") <br>";
		}

		return str;
}

//Knuth shuffle (from https://github.com/coolaj86/knuth-shuffle)
function shuffle(original_array) {
  var array = [];
  for (var i=0; i<original_array.length; i++) {
  	array[i] = original_array[i];
  }		
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

//Tester
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
		for (key in rappers[0]) {
			r1[key] = rappers[0][key];
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
		str += "\n Closest rappers according to most matches are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			str += most_matches[i]["Rapper"] + " with " + most_matches[i]["Matches"] + " matches \n";
		}
		//console.log(most_matches);
		console.log(str);
}