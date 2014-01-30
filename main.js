/*
 * MAINDO
 */

//For local / usdivad.com
function main_local() {
	//var rappers;

	//JSON req
	$.getJSON("./src/rapper_stats.json", function(data) {
		//rappers = data;
		//$("#inputForm").append(createForm(data, allParams));
		$("#submitButton").click(function() {
			var r = getSubmit(data);
			$("#results").html(r);
		});
		//getSubmit(data);
		test_parse(data);

	}); //end JSON req
}

//For Wordpress integration
function main_wp() {

	var data = [{"Rapper":"Snoop Dogg","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Legit pimp","CriminalHistory":"Might have killed someone"},
{"Rapper":"Madlib","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Tyler, The Creator","Decade":"2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"MC Hammer","Decade":"1980s, 1990s","Region":"West Coast","Fashion":"Avant-garde","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Dr. Dre","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"Athletic","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault"},
{"Rapper":"Kendrick Lamar","Decade":"2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"A$AP Ferg","Decade":"2000s, 2010s","Region":"Mid West, East Coast","Fashion":"Hipster","Tattoos":"many","Food_Fitness_BodyType":"Athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Chief Keef","Decade":"2010s","Region":"Mid West","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Mentally incompetent","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone, Drug dealer"},
{"Rapper":"2 Chainz","Decade":"2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"average","Intelligence":"Dumb","PimpHand":"Legit Pimp","CriminalHistory":"Drug dealer, Drug possession"},
{"Rapper":"Chance The Rapper","Decade":"2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Insane Clown Posse","Decade":"1990s, 2000s, 2010s","Region":"Mid West","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"fat","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Minor"},
{"Rapper":"Danny Brown","Decade":"2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"a few","Food_Fitness_BodyType":"skinny","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Drug dealer, Drug possession"},
{"Rapper":"Nelly","Decade":"1990s, 2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Bone Thugs N Harmony","Decade":"1990s, 2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"Skinny","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault"},
{"Rapper":"2 Pac","Decade":"1990s","Region":"West Coast","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone"},
{"Rapper":"Macklemore","Decade":"2000s, 2010s","Region":"East Coast, West Coast","Fashion":"Avant-garde","Tattoos":"none","Food_Fitness_BodyType":"skinny","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Kanye West","Decade":"2000s, 2010s","Region":"East Coast, Mid West, Dirty South","Fashion":"Avant-garde","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"Assault"},
{"Rapper":"Eminem","Decade":"1990s, 2000s, 2010s","Region":"East Coast, Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Assault"},
{"Rapper":"Wiz Khalifa","Decade":"2000s, 2010s","Region":"East Coast, Mid West","Fashion":"Hipster","Tattoos":"many","Food_Fitness_BodyType":"skinny","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Riff Raff","Decade":"2000s, 2010s","Region":"East Coast, Dirty South, West Coast","Fashion":"Avant-garde","Tattoos":"many","Food_Fitness_BodyType":"skinny","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Minor, Drug possession"},
{"Rapper":"Drake","Decade":"2000s, 2010s","Region":"East Coast, Dirty South, Mid West","Fashion":"Avant-garde","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Wale","Decade":"2000s, 2010s","Region":"East Coast, Dirty South","Fashion":"Upscale","Tattoos":"many","Food_Fitness_BodyType":"Athletic","Intelligence":"Street smart","PimpHand":"Pussy Whipped","CriminalHistory":"None"},
{"Rapper":"Pusha T","Decade":"1990s, 2000s, 2010s","Region":"East Coast, Dirty South","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"Lil' Kim","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Legit Pimp","CriminalHistory":"Minor"},
{"Rapper":"P Diddy","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor"},
{"Rapper":"50 Cent","Decade":"2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone"},
{"Rapper":"LL Cool J","Decade":"1980s, 1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Assault"},
{"Rapper":"Nicki Minaj","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"None"},
{"Rapper":"The Notorious B.I.G.","Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"fat","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"Slick Rick","Decade":"1980s, 1990s, 2000s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Food_Fitness_BodyType":"Skinny","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone"},
{"Rapper":"Q-Tip","Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Deltron 3030","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Mos Def aka Yasin Bey","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Talib Kweli","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Dmx","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Might have killed someone"},
{"Rapper":"ODB","Decade":"1990s","Region":"East Coast","Fashion":"t shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"Might have killed someone"},
{"Rapper":"Beastie Boys","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Minor"},
{"Rapper":"Black Thought","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"Average","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Run- Dmc","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"Average","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Fat Joe","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"fat","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"Might have killed someone"},
{"Rapper":"MF Doom","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Food_Fitness_BodyType":"fat","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Afrika Bambaataa","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Food_Fitness_BodyType":"fat","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Big Pun","Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"fat","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Assault"},
{"Rapper":"Action Bronson","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"fat","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Chuck  D","Decade":"1980's, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"Fat","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Minor"},
{"Rapper":"Schoolboy Q","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"many","Food_Fitness_BodyType":"Fat","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Drug dealer"},
{"Rapper":"Mac Miller","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"many","Food_Fitness_BodyType":"skinny","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession"},
{"Rapper":"Jay-Z","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug dealer"},
{"Rapper":"J. Cole","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"t shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Pussy Whipped","CriminalHistory":"None"},
{"Rapper":"Joey Bada$$","Decade":"2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"a few","Food_Fitness_BodyType":"skinny","Intelligence":"Smart","PimpHand":"wouldn't you like to know","CriminalHistory":"None"},
{"Rapper":"Ja Rule","Decade":"2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Redman","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"Nas","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Minor"},
{"Rapper":"Busta Rhymes","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault"},
{"Rapper":"Lauryn Hill","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Method Man","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"Athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"Missy Elliot","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Food_Fitness_BodyType":"fat","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Ghostface Killah","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"Fat","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"A$AP Rocky","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"a few","Food_Fitness_BodyType":"skinny","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault"},
{"Rapper":"French Montana","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Food_Fitness_BodyType":"average","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"},
{"Rapper":"Lil Wayne","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"facial","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Legit pimp","CriminalHistory":"Minor"},
{"Rapper":"Gucci Mane","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"facial","Food_Fitness_BodyType":"average","Intelligence":"Mentally incompetent","PimpHand":"Legit pimp","CriminalHistory":"Might have killed someone"},
{"Rapper":"T- Pain","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Food_Fitness_BodyType":"average","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"None"},
{"Rapper":"Vanilla Ice","Decade":"1990s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Future","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"Minor"},
{"Rapper":"Andre 3000","Decade":"1990s, 2000s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Childish Gambino","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Food_Fitness_BodyType":"average","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None"},
{"Rapper":"Ludacris","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"many","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Big Krit","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"a few","Food_Fitness_BodyType":"athletic","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Paul Wall","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"fat","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None"},
{"Rapper":"Rick Ross","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"many","Food_Fitness_BodyType":"fat","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer"}];

	$("#submitButton").click(function() {
		var r = getSubmit(data);
			$("#content").html(r);
			$("html, body").animate({scrollTop: 0}, "slow");
		});

		//getSubmit(data);
		
		test_parse(data);

} //end main_wp

$(window).load(function() {
	main_wp();
	console.log("ready");
});
