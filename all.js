function doAll() {

//all scores are out of 10

// weed < pills < cocaine < acid
/*
	none: 0
	weed: 2.5
	pills/lean: 5
	crack/cocaine: 7.5
	molly/acid: 10
*/

var drugList = {
	"Acid": 10,
	"Cocaine": 7.5,
	"Crack, Cocaine": 7.5,
	"Crack, Pills": 6.25,
	"Lean, Weed": 3.75,
	"Molly, Weed": 6.25,
	"None": 0,
	"Pills": 5,
	"Pills, Weed": 3.75,
	"Weed": 2.5,
	"Weed, Acid": 6.25,
	"Weed, Cocaine": 6.25,
	"Weed, Cocaine, Crack": 6.25,
	"Weed, Lean": 3.75,
	"Weed, Lean, Pills": 3.75,
	"Weed, Molly": 6.25
}

//5 cats: mt dew < beer < bottomshelf < champagne/wine < topshelf
var drinkList = {
	"Beer": 2.5,
	"beer/bottom shelf liquor": 3.75,
	"bottom shelf liquor": 5,
	"Champagne/Wine": 7.5,
	"Mountain Dew": 0,
	"top shelf liquor": 10
}

//vinyl < cassettes < cds < mixtapes < mp3s
var ageList = {
	"Cassettes": 2.5,
	"CDs": 5,
	"Mixtapes": 7.5,
	"MP3": 10,
	"Vinyl": 0
}

//just one for each
//but by proximity; so avant < hipster < upscale < tshirt < thug
var fashionList = {
	"Avant-garde": 0,
	"Hipster": 2.5,
	"T shirt & jeans": 7.5,
	"Thuggin'": 10,
	"Upscale": 5 
}

//west < dirty south < midwest < east < other
var regionList = {
	"Dirty South": 2.5,
	"East Coast": 7.5,
	"Mid West": 5,
	"Other": 10,
	"West Coast": 0
}

//none < minor < drug < assault < killed
var criminalList = {
	"Assault": 7.5,
	"Drug dealer": 5,
	"Might have killed someone": 10,
	"Minor": 2.5,
	"None": 0,
}

//conflating height and weight
var fitnessList = {
	"athletic": 8,
	"fat": 0,
	"short": 2.5,
	"short, athletic": 5,
	"short, fat": 1,
	"short, stocky": 2,
	"tall, athletic": 10,
	"tall, fat": 7.5,
	"tall, stocky": 7
}

//mentally incompetent < dumb < avg < reasonably smart < smart
var intelligenceList = {
	"Average": 5,
	"Dumb": 2.5,
	"Mentally incompetent": 0,
	"Reasonably smart": 7.5,
	"Smart": 10 
}

var pimpList = {
	"Legit pimp": 10,
	"no standards": 3.33,
	"Pussy whipped": 0,
	"Semi-Pimp": 6.66
}

var tattoosList = {
	"A few": 3.33,
	"Facial": 6.66,
	"Many": 10,
	"none": 0
}

/*
	classic = 0
	underground	= 2
	dirty south = 4
	trap = 6
	pop = 8
	always changing = 10

	use avg to figure out combinations
	e.g. always changing/pop = (10+8)/2 = 9
*/
var soundList = {
	"Always changing": 10,
	"Always changing/Pop": 9, 
	"Classic": 0,
	"Classic/Pop": 4,
	"Classic/underground/alternative": 1,
	"Dirty South": 4,
	"Dirty South/Classic": 2,
	"Dirty South/Pop": 6,
	"Dirty South/trap": 5,
	"Dirty South/underground/alternative": 3,
	"Pop": 8,
	"Pop/classic": 4,
	"Pop/trap": 7,
	"Pop/underground/alternative": 5,
	"Trap": 6,
	"Trap/Pop": 7,
	"Trap/underground/alternative": 3,
	"Underground/alternative": 2 
}

var allParams = {
	"Drug of choice": drugList,
	"Drink of choice": drinkList,
	"Age/Audio Format": ageList,
	"Fashion": fashionList,
	"Region": regionList,
	"Criminal History": criminalList,
	"Food/Fitness/Body Type": fitnessList,
	"Intelligence": intelligenceList,
	"Pimp Hand": pimpList,
	"Tattoos": tattoosList,
	"Sound": soundList
};


//Get rapper score (overall)
function get_score(rapper) {
	var r_score = 0;

	//get attrs
	//var name = rapper["Rapper"];
	var drug = rapper["Drug of choice"];
	var drink = rapper["Drink of choice"];
	var age = rapper["Age/Audio Format"];
	var fashion = rapper["Fashion"];
	var region = rapper["Region"];
	var criminal = rapper["Criminal History"];
	var fitness = rapper["Food/Fitness/Body Type"];
	var intelligence = rapper["Intelligence"];
	var pimp = rapper["Pimp Hand"];
	var tattoos = rapper["Tattoos"];
	var sound = rapper["Sound"];


	//making the score
	//r_score = drugList[drug] + drinkList[drink] + ageList[age];
	r_score = parse(drugList, drug) + parse(drinkList, drink) + parse(ageList, age);
	return r_score;
}

function convert_to_number(rapper) {
	//get attrs
	var drug = rapper["Drug of choice"];
	var drink = rapper["Drink of choice"];
	var age = rapper["Age/Audio Format"];
}

//Parse an individual attribute from a list of scores
function parse(list, attr) {
	if (typeof list[attr] != "undefined") {
		//console.log()
		return list[attr];
	}
	else {
		console.log("No " + attr + " found in list!");
		return 5;
	}
}

//Calculate Manhattan distance using all available params
function manhattan_distance(rapper1, rapper2, params) {
	var md = 0;
	var i = 0;
	for (key in rapper1) {
		//get the drug they like
		var param_rapper1 = rapper1[key];
		var param_rapper2 = rapper2[key];
		//get the list with the right params
		var list = params[key];
		if (typeof list != "undefined") {
			var score_rapper1 = list[param_rapper1];
			var score_rapper2 = list[param_rapper2];
			//console.log(score_rapper1);
			if (typeof score_rapper1 != "undefined" && typeof score_rapper2 != "undefined") {
				//console.log(drug_rapper1, score_rapper1);
				md += attribute_difference(score_rapper1, score_rapper2);
			}
		}
		
		i++;
	}
	return md;
}

//Diff between attributes
function attribute_difference(attr1, attr2) {
	return Math.abs(attr2 - attr1);
}

//Find closest rappers
function find_closest(rapper1, rapperList, paramList) {
	//get dist for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var dist = manhattan_distance(rapper1, rapper2, paramList);
		if (typeof dist != "undefined") {
			rapper2["Distance"] = dist;
		}
	}

	//sort by dist
	rapperList.sort(function(a, b) {
		var aDist = a["Distance"];
		var bDist = b["Distance"];
		if (aDist < bDist) {
			return -1;
		}
		else if (aDist > bDist) {
			return 1;
		}
		else {
			//try randomization
			/*var dice = Math.random();
			if (dice >= 0.5) {
				return 1;
			}
			else {
				return -1;
			}*/
			return 0;
		}
	})

	return rapperList;
}

//Find the most matches for a given rapper
function find_most_matches(rapper1, rapperList) {
	//get number of matches for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		var matches = num_matches(rapper1, rapper2);
		if (typeof matches != "undefined") {
			rapper2["Matches"] = matches;
		}
	}

	//sort by matches in *descending* order
	rapperList.sort(function(a, b) {
		var aMatch = a["Matches"];
		var bMatch = b["Matches"];
		if (aMatch < bMatch) {
			return 1;
		}
		else if (aMatch > bMatch) {
			return -1;
		}
		else {
			return 0;
		}
	});

	return rapperList;
}

//Finds number of matches between any two rappers
function num_matches(rapper1, rapper2) {
	var n = 0;
	for (key in rapper1) {
		if (rapper1[key] == rapper2[key]) { //no e.c. needed?
			n++;
		}
	}
	return n;
}

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


}//end do