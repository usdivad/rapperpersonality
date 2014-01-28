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

//by decade
var ageList = {
	"1980s": 2.5,
	"1990s": 5,
	"2000s": 7.5,
	"2010s": 10,
	"1970s": 0
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
	"DrugOfChoice": drugList,
	"DrinkOfChoice": drinkList,
	"Decade": ageList,
	"Fashion": fashionList,
	"Region": regionList,
	"CriminalHistory": criminalList,
	"Food_Fitness_BodyType": fitnessList,
	"Intelligence": intelligenceList,
	"PimpHand": pimpList,
	"Tattoos": tattoosList,
	"Sound": soundList
};