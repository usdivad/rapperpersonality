<!--Updated 2014/03/04 00:28 by David Su-->
<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
<style type="text/css">
div.concertsb6 h3{line-height:25px!important;}
div.concertsb6 {margin-left: 0px!important;}


.body-border label:hover:hover{
	background-color: transparent;
	font-weight: 900;
}
 
</style>
<?php get_header(); ?>
	<div id="fb-root"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
//fb
  window.fbAsyncInit = function() {
          FB.init({
            appId      : 1375271719406903,
            status     : true,
            xfbml      : true,
            oauth      : true
          });
        };

        /*(function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/all.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));*/

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1375271719406903";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      
//twitter
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

</script>





<div id="content" class="container">

				<div id="inner-content" class="wrap clearfix">

 						<div id="main" class="grid-8 first clearfix" role="main">
 							
 							<div class="body-border">
								<article class="main">
							      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							      
							        <h1 class="page-title clearfix"><?php the_title(); ?></h1>
							        
							        <?php the_content(__('Read more ...'));?>
							      <?php endwhile; else: ?>
							      <?php endif; ?>
							    </article>
							</div>
						</div>




						<div class="sidebar grid-4 last clearfix" role="complementary">

							 <div class="block-newsletter-signup clearfix">
                                 <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                             </div>
<div class="concertsb6">
            <h3></h3>
            <div class="zumic-a clearfix">
	     <a href="" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:auto!important" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png" >   
        </a>

	     <div class="sidebar-geotitle">

           
                
          <hr style="margin-right:15px;margin-left:25px;height:.2%;"> 
        </div>
		
	</div>	
			   
			    <div>
			    <?php

			        $args = array(
			            'post_type' => array( 'post', 'music-videos' ), 
			            'post_status' => 'publish', 
			            'posts_per_page' => 2, 
			            'orderby'  => 'menu_order',
			            'tax_query' => array(
			                array(
			                    'taxonomy' => 'category',
			                    'field' => 'slug',
			                    'terms' => array( 'concert-announcements' ),
			                    'operator' => 'IN'
			                )
			            ),  
			          
			        );

			       	$the_query = new WP_Query($args);
							while ( $the_query->have_posts() ) : $the_query->the_post();
					?>
							    
							        <div class="item link" data-href="<?php the_permalink(); ?>">
						                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                	 <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
						                </a>
						                <div class="single-title"><h3><?php the_title(); ?></h3></div>
						            </div>					   
					<?php 
						endwhile;
						wp_reset_postdata();
					?>
    </div>
</div>

  

<br>

							<div class="zumic-a" style="margin-top:auto;">
								<?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
							</div>

<div class="concertsb6" >


							<h2 class="title-headline">Popular Today</h2>


<?php

    the_widget(
     'Clicky_Popular_Posts_Widget', [
      'site_id'    =>  '100591291',
      'site_key'   =>  '46a8d7ed022b30ce',
      'number'     =>  4,
      'post_types' =>  array( 'post', 'music-videos' ),
      'date'       =>  'last-2-days',
    
       
      ] 

    );

?>
</div>


							<?php get_sidebar(); ?>
</div>
						</div>


			


				</div>
</div>

<?php get_footer(); ?> 

<style>
  label {
    font-weight: normal;
    margin-left: 4px;
    margin-bottom: 4px;
  }

  label:hover {
    background-color: #EBEBEB;
  }

  input:checked {
    background-color: red;
  }

  .post a {
    font-size: 100%;
  }
</style>


<script>
//Merged 2014/03/04 00:28 by David Su http://usdivad.com/
/*
 * MATCHES
 */

//Find the most matches for a given rapper
function find_most_matches(rapper1, rapperList) {
	var matchesList = [];
	//get number of matches for each rapper
	for (var i=0; i<rapperList.length; i++) {
		var rapper2 = rapperList[i];
		//var matches = num_matches(rapper1, rapper2);
		var matches = match_score(rapper1, rapper2);
		if (typeof matches != "undefined") {
			rapper2["Matches"] = matches;
		}
		matchesList.push(rapper2);
	}

	//sort by matches in *descending* order
	matchesList.sort(function(a, b) {
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

	return matchesList;
}

//Finds number of matches between any two rappers
/*function num_matches(rapper1, rapper2) {
	var n = 0;
	for (key in rapper1) {
		if (rapper1[key] == rapper2[key]) { //no e.c. needed?
			n++;
		}
	}
	return n;
}*/

//Finds number of matches, but takes into account multiple checkboxes
function match_score(rapper1, rapper2) {
	var score = 0;
	//Returning 0 if either rapper is Chance and either one doesn't select "Acid"
	if (rapper1["Rapper"] == "Chance The Rapper" || rapper2["Rapper"] == "Chance The Rapper") {
		if (typeof rapper1["DrugOfChoice"] == "undefined") {
			return 0;
		}
		drugs1 = rapper1["DrugOfChoice"].split(", ");
		drugs2 = rapper2["DrugOfChoice"].split(", ");
		if (drugs1.indexOf("Acid") == -1 || drugs2.indexOf("Acid") == -1) {
			return score;
		}
	}
	//Adding up the scores
	for (key in rapper1) {
			//console.log(key + " " + rapper1["Rapper"] + " " + rapper2["Rapper"] + ":");
			score += det_score(key, rapper1[key], rapper2[key]);
	}
	return score;
}

//Determines score for a given param: all inputs are strings
//value2 is value for "other"
function det_score(key, value1, value2) {
	var score = 0;
	var multiplier;
	
	//For one unit -> any
	//and MULTIPLIERS
	/*
	var DECADE = 3.14;
	var REGION = 2.24;
	var SOUND = 4.33;
	var DRINK = 1.23;
	var DRUG = 1.23;
	*/

	//equal multipliers
	var DECADE = 1;
	var REGION = 1;
	var SOUND = 1;
	var DRINK = 1;
	var DRUG = 1;

	var from_radio = false;

	//Params with multiple selection
	if (key == "Decade") {
		multiplier = DECADE;
	}
	else if (key == "Region") {
		multiplier = REGION;
		from_radio = true;
	}
	else if (key == "Sound") {
		multiplier = SOUND;
	}
	else if (key == "DrinkOfChoice") {
		multiplier = DRINK;
	}
	else if (key == "DrugOfChoice") {
		multiplier = DRUG;
	}
	else {
		//Params without multiple selection; unweighted anyways
		//toUpperCase provides case-insensitive matching
		if (value1 == value2) {
			score = 1;
			//console.log(value1 + " == " + value2);
		}
		return score;
	}

	//We scale it by number of values in value2
	//toUpperCase provides case-insensitive matching
	var value1_arr = value1.split(", ");
	var value2_arr = value2.split(", ");
	var value_unit = 1/value2_arr.length;

	//For each value in value1 we check whether it's in value2
	for (var i=0; i<value1_arr.length; i++) {
		if (value2_arr.indexOf(value1_arr[i]) != -1) {
			//If from radio we add 1 for the whole score
			if (from_radio) {
				score = 1;
				i = value1_arr.length;
			}
			//For checkbox we add one unit for each match
			else {
				score += value_unit;
				//console.log("matched " + value1_arr[i]);
			}
			//console.log(value1_arr[i] + " == " + value2_arr[i]);
		}
	}

	//We matched all of them for a given rapper! extra goodies
	if (score == 1) {
		score = 2;
	}
	score = score * multiplier;

	return score;
}

/*
 * PARSE
 */

//Calculate personality based on MD and matches from rapper database
//uses matches.js and manhattan
//1/30: the whole thing gets shuffled!
function calculatePersonality(user, data) {
	
	//You: region-filtered then ordered by score function. Only alternate suggestions (non-first) are shuffled
	var data_filtered = filter_by_region(user, data);
	console.log("Filtered data: ");
	console.log(data_filtered);
	var most_matches;
	var who;
	//in case user hasn't picked a region
	if (data_filtered.length > 0) {
		most_matches = find_most_matches(user, data_filtered); //unshuffled
	}
	else {
		most_matches = find_most_matches(user, data); //unshuffled!
	}
	
	//Shuffling the rest
	
	who = most_matches.splice(0, 1)[0]; //[0]
	console.log(most_matches.length);

	most_matches = find_most_matches(user, shuffle(most_matches));
	most_matches.unshift(who);
	console.log(most_matches.length);
	
	console.log("Final matches: ");
	console.log(most_matches);
	return most_matches;
}

//Scales compatibility score out of 100%
function compatibility_score(score, max) {
	return ((score/max)*100).toFixed(1);
}

//Filters out rappers who aren't in user's chosen region (RIVALRIES!)
function filter_by_region(user, data) {
	console.log("filtering");
	var filtered = [];
	for (var i=0; i<data.length; i++) {
		var rapper = data[i];
		var rapper_regions = rapper["Region"].split(", ");
		for (var j=0; j<rapper_regions.length; j++) {
			if (user["Region"] == rapper_regions[j]) {
				filtered.push(rapper);
				//console.log("You and " + rapper["Rapper"] + " both are from " + rapper_regions[j] + user["Region"]);
			}
		}
	}
	//console.log(filtered);
	return filtered;
}

//Knuth shuffle (from https://github.com/coolaj86/knuth-shuffle)
//re-modified back to original
function shuffle(array) {
  /*
  var array = [];
  for (var i=1; i<original_array.length; i++) { //remove first element
  	array.push(original_array[i]);
  }
  */
  //console.log("pre-shuf");
  //console.log(array);	
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

/*TESTER*/
//1/28: removed paramList parameter
function test_parse(data) {

		//Data parsing
		console.log("From test_parse: ");
		console.log(data);
		rappers = data;
		console.log(rappers.length);

		//Tester params
		var str = "";
		var NUM_OUTPUT = 5;

		//case 1
		//var r1 = {"Rapper":"Mister Twister","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"Facial","Food_Fitness_BodyType":"short","Zone":"Getting your freak on","Intelligence":"Dumb","CriminalHistory":"None","PimpHand":"Legit Pimp","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"Weed"};
		//var r1 = {"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Making money"};

		//Just testing params
		var r1 = {"Region":"Mid West", "Intelligence":"Smart"};

		//testing EVERY rapper with themselves
		/*
		for (var i=0; i<rappers.length; i++) {
			var str = "";
			for (key in rappers[i]) {
				r1[key] = rappers[i][key];
			}
			//r1["Sound"] = "Pop";
			//console.log(r1);
		*/
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
		//}
		

}

//Testing data collected from usdivad.com/rapperpersonality/collected_data.txt
function test_collected(rappers) {
	var qtips = [{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Classic, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Assault, Minor","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Dirty South, Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Getting your freak on"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Assault","Sound":"Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Classic, Underground/alternative, Dirty South","DrinkOfChoice":"Beer, Mountain Dew","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Playing video games"},{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Dirty South, Trap, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Getting your freak on"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Pop","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Thuggin\'","Tattoos":"none","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"Molly","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2010s","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor, Bottom shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Minor","Sound":"Always changing","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Always changing","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"None","Zone":"Playing video games"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Pills","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"None","Sound":"Pop, Always changing","DrinkOfChoice":"Beer, Mountain Dew","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Pop, Always changing","DrinkOfChoice":"Beer, Bottom shelf liquor, Mountain Dew","DrugOfChoice":"Crack","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed, Acid","Zone":"Chilling"},{"Decade":"1990s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Top shelf liquor, Mountain Dew","DrugOfChoice":"Lean, Pills","Zone":"Playing video games"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"None","Zone":"Getting your freak on"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Working out"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Bottom shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Eating"},{"Decade":"2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Pop, Trap, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Eating"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed, Lean","Zone":"Chilling"},{"Decade":"1990s, 2010s","Region":"East Coast","Fashion":"Thuggin\'","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession, Assault, Minor","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed, Lean, Pills","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Pop, Trap, Always changing","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"1980s, 1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None","Zone":"Fighting"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession","Sound":"Classic","DrinkOfChoice":"Beer","DrugOfChoice":"Acid","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Playing video games"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Playing video games"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Playing video games"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Champagne/Wine, Top shelf liquor, Mountain Dew","DrugOfChoice":"None, Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Always changing","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1980s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"}];
	var childishs = [{"Decade":"2010s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Dirty South","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"None, Weed","Zone":"Playing video games"},{"Decade":"2010s","Region":"Dirty South","Fashion":"Thuggin\'","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor, None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Pills","Zone":"Playing video games"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Dirty South","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"Weed, Crack, Lean","Zone":"Chilling"},{"Decade":"2010s","Region":"West Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"Drug possession, Drug dealer, Minor","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed, Crack, Lean, Acid, Molly, Pills","Zone":"Working out"},{"Decade":"1980s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession, Minor","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Crack, Lean, Molly, Pills","Zone":"Getting your freak on"},{"Decade":"2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Minor","Sound":"Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Always changing","DrinkOfChoice":"Beer, Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Always changing","DrinkOfChoice":"Beer, Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s","Region":"West Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"Weed, Acid","Zone":"Making money"},{"Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None, Weed, Lean","Zone":"Playing video games"},{"Decade":"2000s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Getting your freak on"},{"Decade":"1990s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"1990s, 2000s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"Assault, Minor","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s, 2010s","Region":"West Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Dirty South, Trap, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Playing video games"},{"Decade":"2010s","Region":"West Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop, Trap","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Playing video games"},{"Decade":"1980s, 1990s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Dirty South, Trap","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed, Lean, Pills","Zone":"Fighting"},{"Decade":"1990s, 2000s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Working out"},{"Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"many","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Dirty South, Trap","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"None","Zone":"Getting your freak on"},{"Decade":"2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"facial","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Trap","DrinkOfChoice":"Beer","DrugOfChoice":"Acid","Zone":"Chilling"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"1990s, 2000s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Working out"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None, Weed, Lean","Zone":"Chilling"},{"Decade":"2000s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Street smart","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Working out"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"None, Weed, Lean","Zone":"Eating"},{"Decade":"2000s","Region":"West Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer","Zone":"Getting your freak on"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Trap, Always changing","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Molly, Pills","Zone":"Working out"},{"Decade":"1980s, 1990s","Region":"Dirty South","Fashion":"Thuggin\'","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Drug possession, Drug dealer, Minor","Sound":"Underground/alternative, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Weed, Crack, Acid, Molly","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s, 1990s, 2000s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Molly","Zone":"Chilling"},{"Decade":"1980s, 1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Minor","Sound":"Classic","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Crack, Acid, Pills","Zone":"Eating"},{"Decade":"2000s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Classic, Underground/alternative, Dirty South, Trap","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Acid, Molly","Zone":"Chilling"},{"Decade":"1990s","Region":"West Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug possession, Minor","Sound":"Classic, Underground/alternative, Trap","DrinkOfChoice":"Beer, Champagne/Wine","DrugOfChoice":"Weed, Acid, Molly","Zone":"Fighting"},{"Decade":"1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Dirty South","DrinkOfChoice":"Beer","DrugOfChoice":"Lean","Zone":"Making money"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Dirty South","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed, Lean, Acid","Zone":"Making money"},{"Decade":"1990s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Underground/alternative","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Making money"},{"Decade":"1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Minor","Sound":"Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Acid","Zone":"Playing video games"},{"Decade":"1990s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Acid, Molly, Pills","Zone":"Playing video games"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Crack, Lean, Acid, Molly, Pills","Zone":"Chilling"},{"Decade":"2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Trap","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Getting your freak on"},{"Decade":"2000s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Acid","Zone":"Building a stronger community"}];
	var drakes = [{"Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Chilling"},{"Decade":"2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Acid","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Making money"},{"Decade":"2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2000s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2010s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Eating"},{"Decade":"1990s, 2010s","Region":"Mid West","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Crack, Molly, Pills","Zone":"Chilling"},{"Decade":"1990s, 2010s","Region":"Mid West","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Molly, Pills","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s, 1990s","Region":"Mid West","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Working out"},{"Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Minor","Sound":"Classic, Underground/alternative, Pop, Trap, Always changing","DrinkOfChoice":"Champagne/Wine, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Making money"},{"Decade":"2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Eating"},{"Decade":"2010s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s, 2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Trap","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Playing video games"},{"Decade":"1990s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s, 1990s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed, Acid","Zone":"Chilling"},{"Decade":"2010s","Region":"Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Drug dealer, Minor","Sound":"Underground/alternative, Pop, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed, Crack, Molly, Pills","Zone":"Chilling"},{"Decade":"2000s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Minor","Sound":"Classic","DrinkOfChoice":"Beer, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Getting your freak on"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Top shelf liquor, Bottom shelf liquor, Mountain Dew","DrugOfChoice":"Weed, Crack, Lean","Zone":"Making money"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Top shelf liquor, Bottom shelf liquor","DrugOfChoice":"Weed, Crack, Lean","Zone":"Making money"},{"Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession, Minor","Sound":"Pop, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Underground/alternative, Pop, Trap, Always changing","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"2000s","Region":"Mid West","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Crack","Zone":"Building a stronger community"},{"Decade":"2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s, 1990s, 2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Bottom shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"1990s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug possession","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Building a stronger community"},{"Decade":"2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Beer, Champagne/Wine, Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1980s, 2000s, 2010s","Region":"Mid West","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Always changing","DrinkOfChoice":"Champagne/Wine, Top shelf liquor","DrugOfChoice":"None, Weed","Zone":"Eating"},{"Decade":"2000s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Working out"},{"Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Minor","Sound":"Always changing","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession, Minor","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Crack","Zone":"Chilling"},{"Decade":"1990s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Underground/alternative, Pop, Dirty South, Trap, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2010s","Region":"Mid West","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Underground/alternative, Pop, Dirty South, Trap","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"2010s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative, Pop, Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Eating"},{"Decade":"2000s, 2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative, Pop, Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Eating"},{"Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Pop","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s","Region":"Mid West","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Drug possession, Drug dealer","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"},{"Decade":"1990s, 2000s","Region":"Dirty South","Fashion":"Thuggin\'","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Dirty South, Trap, Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling"}];
	//var qtips = [{"Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative, Always changing","DrinkOfChoice":"Beer, Top shelf liquor, Mountain Dew","DrugOfChoice":"None","Zone":"Making money"},{"Decade":"1990s","Region":"East Coast","Fashion":"Hipster","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"None","Zone":"Building a stronger community"},{"Decade":"2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Classic, Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Chilling"}];
	var NUM_OUTPUT = 5;
	var seconds = {};

	var chosen = drakes;

	for (var idx=0; idx<chosen.length; idx++) {
		var r1 = chosen[idx];
		var str = "";
		//Testing matches
		//console.log("testing matches:");
		var most_matches = find_most_matches(r1, rappers);
		//str += "Your name is " + r1["Rapper"] + "! \n";
		str += idx + ": You are " + r1 + "\n";
		str += "\n Closest rappers according to most matches are: \n";
		for (var i=0; i<NUM_OUTPUT; i++) {
			var r_name = most_matches[i]["Rapper"];
			if (typeof seconds[r_name] == "undefined") {
				seconds[r_name] = 1;
			}
			else {
				seconds[r_name]++;
			}
			str += r_name + " with " + most_matches[i]["Matches"] + " matches \n";
		}
		//console.log(most_matches);
		console.log(r1);
		console.log(str+"\n");
	}

	for (key in seconds) {
		console.log(key + ": " + seconds[key]);
	}
}


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
	var NUM_OUTPUT = 6;
	var custom_text = who["ResultText"];
	var str = "<div id='results_div' class='body-border' style='margin-left:25%;'>";
	var whorapper = who["Rapper"].replace(/ /g, '-');

	//Sample output; 
	//Compatibility calculation
	/*
	var max_score = match_score(who, who);
	var compatibility = compatibility_score(who["Matches"], max_score);
	var high_compatibility = (compatibility > 80);
	*/

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
    first_rapper_link = "http://zumic.com/artists/" + whorapper
	str += "<div id='img_div'><a id='img_link' href='" + first_rapper_link + "'><img id='first_rapper_image'></a></div>";
	str += "<br>Check out " + who["Rapper"] + "'s <a  href='" + first_rapper_link + "'>Zumic artist page</a> for music, news, and tour dates."
	str += "</div>"; //end you_are


	//Alternate rappers
	var alternate_rappers = [];
	str += "<br>You could also be:<br>"
	//i=0 for shuffled array, i=1 for original array
	for (var i=1; i<NUM_OUTPUT; i++) {
		var alt_who = result_arr[i];
		if (typeof alt_who == "undefined") { //make sure we haven't run out of rappers
			i = NUM_OUTPUT;
		}
		else {

			
			var name = alt_who["Rapper"].replace(/ /g, '-');
			var id = "alt_rapper_" + i;
			var namedis = alt_who["Rapper"];
			alternate_rappers.push({"name": name, "id": id});
			str += "<a id='" + id + "' href='http://zumic.com/artists/" + name + "/'>" + namedis + "</a>";
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

	

	//Share: [facebook, twitter, google+, tumblr links]
	str += "<br>";
	str += "Share your results:";
	str += "<br>"

	//Facebook
	//str += '<div id="fb_share_result" class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="700px" data-height="200px" width="500px" height="100px" data-type="button"></div>';
	//str += '<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="500px" data-type="button"></div>'
	str += "<a id='fb_share_result' href='" + "javascript:;" + "'><img src='http://zumic.com/wp-content/uploads/2014/01/fb_share.png'></a>";

	//Twitter
	str += '<a href="https://twitter.com/share" id="twitter_share_result" class="twitter-share-button" data-url="' + url_self +'" data-text="Rapper Personality Quiz!" data-via="zumic"><img src="http://zumic.zumicentertainme.netdna-cdn.com/wp-content/uploads/2014/01/twitter_share.png"></a>';

	str += "<br><br>";
	str += "</div>"; //end results_div

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
				if (typeof post != "undefined") { //we have
					//console.log(artist_request["search"] + "\n");
					//have_artists++;
				}
				else { //we don't have
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

    // $.getJSON(base_url, json_request, function(zumic_data) { //error-check the ind reqs
    $.post("http://zumic.com/rapper-personality-results", {rapper: who["Rapper"], alternate_rappers: alternate_rappers}, function(zumic_data) {
		// console.log(zumic_data);
		// var post = zumic_data["posts"][0];
		// var artist_page_url = "http://zumic.com/post-type/artist-page";
		// var img_url = "http://zumic.com/wp-content/uploads/2014/01/jayz_small.png";
		// if (typeof post != "undefined") {
		// 	artist_page_url = post["url"];
		// 	try {
		// 		img_url = post["thumbnail_images"]["medium"]["url"];
		// 	}
		// 	catch(e) {
		// 		console.log("No image found, buddy");
		// 	}
		// }

        // NEW
        console.log(zumic_data);
        var post = "";
        // var artist_page_url = "http://zumic.com/";
        var img_url = zumic_data;


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
				app_id: 1375271719406903,
				appId: 1375271719406903
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
		// $("#first_rapper_link").attr("href", artist_page_url);
		$("#first_rapper_image").attr("src", img_url);
        // $("#img_div").html(img_url);
        // $("#img_link").attr("href", artist_page_url);
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

	//Getting links for alternate "you could be"s
	//has to be after base_url defined
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
					console.log("found ");
					var artist_page_url = post["url"];
					var link_query = "#" + artists[i]["id"];
					$(link_query).attr("href", artist_page_url);
				}
				else {
					console.log("not found");
				}
			});
			alt_artists(i+1, artists); //recursively do json reqs
		}
		else {
		}
	};
	alt_artists(0, alternate_rappers);

	//Data collection
	var now = new Date();
	var post_data = who["Rapper"] + " from " + to_s(user) + " on " + now;
	$.post("http://usdivad.com/rapperpersonality/collect.php", {data: post_data}, function(d) {
		console.log(post_data);
		console.log(d);
	});
	console.log(post_data);

    // //Post to results page
    // $.post("http://zumic.com/rapper-personality-results", {rapper: who["Rapper"], alternate_rappers: alternate_rappers}, function(d) {
    //     console.log("Posted to results page");
    //     console.log(d);
    // });

	return str;
} //end get_html

function to_s(user) {
	s = "{";
	for (key in user) {
		if (typeof user[key] != "undefined" && user[key] != "") {
			s+= key + ":" + user[key] + ",";
		}
	}
	s = s.slice(0, -1); //remove the last comma
	return s + "}";
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

	var data = [{"Rapper":"Snoop Dogg","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You're laid back, with your mind on your money on your mind. Your rap personality is Snoop Dogg!"},
{"Rapper":"Notorious B.I.G.","Decade":"1990s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Drug dealer","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Eating","ResultText":"Throw your hands in the air if you're a true player, your rap personality is Big Poppa!"},
{"Rapper":"Kendrick Lamar","Decade":"2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Always changing","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"Macklemore thinks you're awesome. Your rap personality is Kendrick Lamar."},
{"Rapper":"MC Hammer","Decade":"1980s, 1990s","Region":"West Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"Stop. Hammer time! Your rap personality is MC Hammer!"},
{"Rapper":"Andre 3000","Decade":"1990s, 2000s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Playing video games","ResultText":"Stank you smelly much for playing, your rap personality is André 3000!"},
{"Rapper":"Danny Brown","Decade":"2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Drug dealer, Drug possession","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Molly, Weed","Zone":"Getting your freak on","ResultText":"Like Lieutenant Dan, you're rolling. Your rap personality is Danny Brown."},
{"Rapper":"Insane Clown Posse","Decade":"1990s, 2000s, 2010s","Region":"Mid West","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Minor","Sound":"Underground/alternative","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Crack, Pills","Zone":"Eating","ResultText":"Fuckin' quizzes, how do they work? Your rap personality is ICP!"},
{"Rapper":"Drake","Decade":"2000s, 2010s","Region":"East Coast, Dirty South, Mid West","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop, Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"Better be on your worst behavior, because your rap personality is Drake."},
{"Rapper":"Jay-Z","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"Drug dealer","Sound":"Always changing, Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Making money","ResultText":"Jigga what?  Jigga who?  Your rap personality is Jay Z!"},
{"Rapper":"Kanye West","Decade":"2000s, 2010s","Region":"East Coast, Mid West, Dirty South","Fashion":"Avant-garde","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Pussy whipped","CriminalHistory":"Assault","Sound":"Always changing","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"You'd rather be a dick than a swallower. Your rap personality is Kanye West!"},
{"Rapper":"Eminem","Decade":"1990s, 2000s, 2010s","Region":"East Coast, Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Assault","Sound":"Pop, Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"none","Zone":"Fighting","ResultText":"Your rap personality is the real Slim Shady. Please stand up."},
{"Rapper":"Beastie Boys","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Minor","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Building a stronger community","ResultText":"Your rap personality is the Beastie Boys, and you're now officially liscensed to ill."},
{"Rapper":"Tupac","Decade":"1990s","Region":"West Coast","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"Thug life.  Your rap personality is 2Pac."},
{"Rapper":"Lil Wayne","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"facial","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor","Sound":"Dirty South","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Lean, Weed","Zone":"Getting your freak on","ResultText":"You've been handling the game so long, your thumb's bruised. Your rap personality is Lil Wayne."},
{"Rapper":"Afrika Bambaataa","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"Welcome to Planet Rock, your rap personality is Afrika Bambaataa."},
{"Rapper":"Action Bronson","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed, Cocaine","Zone":"Eating","ResultText":"You're posted up in the Galapagos, higher than an opera note. Your rap personality is Action Bronson!"},
{"Rapper":"Vanilla Ice","Decade":"1990s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Classic, Pop","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"None","Zone":"Making money","ResultText":"Word to your mother.  Your rap personality is Vanilla Ice!"},
{"Rapper":"Riff Raff","Decade":"2000s, 2010s","Region":"East Coast, Dirty South, West Coast","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Minor, Drug possession","Sound":"Trap, Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed, Molly, Cocaine","Zone":"Chilling","ResultText":"Your rap personality is RiFF RaFF! The rap game Farrah Fawcett!"},
{"Rapper":"Mac Miller","Decade":"2000s, 2010s","Region":"East Coast, Mid West","Fashion":"Hipster","Tattoos":"many","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Drug possession","Sound":"Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Acid","Zone":"Chilling","ResultText":"You're not Donald Trump, your rap personality is Mac Miller!"},
{"Rapper":"J. Cole","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"t shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy Whipped","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You let Nas down, then made him proud. Your rap personality is J. Cole."},
{"Rapper":"Chance The Rapper","Decade":"2010s","Region":"Mid West","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Acid","Zone":"Playing video games","ResultText":"You like LSD so much, you named a mixtape after it. Your rap personality is Chance the Rapper."},
{"Rapper":"Macklemore","Decade":"2000s, 2010s","Region":"West Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"You're the guy in the fur coat with all the Grammys. Your rap personality is Macklemore."},
{"Rapper":"Nas","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"many","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Minor","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"Break out the Hennessy, your rap personality is Nas!"},
{"Rapper":"Dr. Dre","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Making money","ResultText":"You still take time to perfect the Beats™. Your rap personality is Dr. Dre."},
{"Rapper":"Rick Ross","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Trap","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Eating","ResultText":"Welcome to the boss life, your rap personality is Rick Ross!"},
{"Rapper":"50 Cent","Decade":"2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone","Sound":"Pop, Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Making money","ResultText":"You got rich, and didn't die trying. Your rap personality is 50 Cent."},
{"Rapper":"Redman","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"Your crew does drugs Duane Reade couldn't breed. Your rap personality is Redman."},
{"Rapper":"Tyler, The Creator","Decade":"2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Playing video games","ResultText":"You'd like to stab Bruno Mars in his esophagus. Your rap personality is Tyler, the Creator!"},
{"Rapper":"Schoolboy Q","Decade":"2000s, 2010s","Region":"West Coast","Fashion":"Hipster","Tattoos":"many","Intelligence":"Street smart","PimpHand":"no standards","CriminalHistory":"Drug dealer","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Pills, Weed","Zone":"Making money","ResultText":"Look up in the sky, it's a bird, it's a plane... no, it's just you, Schoolboy Q."},
{"Rapper":"Wale","Decade":"2000s, 2010s","Region":"East Coast, Dirty South","Fashion":"Upscale","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Pussy Whipped","CriminalHistory":"None","Sound":"Pop, Classic","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You went from hipster to gangster in less than sixty secords.  Your rap personality is Wale!"},
{"Rapper":"Pusha T","Decade":"1990s, 2000s, 2010s","Region":"East Coast, Dirty South","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Cocaine","Zone":"Making money","ResultText":"You might sell a brick on your birthday. Your rap personality is Pusha T."},
{"Rapper":"2 Chainz","Decade":"2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Legit Pimp","CriminalHistory":"Drug dealer, Drug possession","Sound":"Trap, Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Cocaine","Zone":"Making money","ResultText":"Better step up your neck jewelery game, because your rap personality is 2 Chainz!"},
{"Rapper":"Q-Tip","Decade":"1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"You're abstract, and we're not talking about Picasso. Your rap personality is Q-Tip."},
{"Rapper":"Busta Rhymes","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Working out","ResultText":"Woo hah!! You've got us all in check. Your rap personality is Busta Rhymes."},
{"Rapper":"Dmx","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed, Cocaine, Crack","Zone":"Working out","ResultText":"Your Wikipedia 'legal issues' section is more illustrious than your discography. Your rap personality is DMX."},
{"Rapper":"ol dirty bastard","Decade":"1990s","Region":"East Coast","Fashion":"t shirt & Jeans","Tattoos":"a few","Intelligence":"Mentally incompetent","PimpHand":"no standards","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Crack, Cocaine","Zone":"Fighting","ResultText":"Your rap personality is the Osiris of this shit, AKA Ol' Dirty Bastard."},
{"Rapper":"Black Thought","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Building a stronger community","ResultText":"On your first day of high school, you had sex with a senior in the bathroom. Your rap personality is Black Thought."},
{"Rapper":"Mos Def","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"Your rap personality is most definitely Mos Def."},
{"Rapper":"Talib Kweli","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Building a stronger community","ResultText":"Kanye used to name-drop you to pick up girls. Your rap personality is Talib Kweli."},
{"Rapper":"Madlib","Decade":"1990s, 2000s, 2010s","Region":"West Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Playing video games","ResultText":"You must be one of America's Most Blunted, because your rap personality is Madlib!"},
{"Rapper":"Wiz Khalifa","Decade":"2000s, 2010s","Region":"East Coast, Mid West","Fashion":"Hipster","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You are Kanye's eskimo bro, Wiz Khalifa."},
{"Rapper":"AsAP Rocky","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault","Sound":"Underground/alternative","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Fighting","ResultText":"Your rap personality is A$AP Rocky, you pretty motherfucker, you."},
{"Rapper":"AsAP Ferg","Decade":"2000s, 2010s","Region":"Mid West, East Coast","Fashion":"Hipster","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Trap","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You must be a Trap Lord and/or Hood Pope, because your rap personality is A$AP Ferg!"},
{"Rapper":"Childish Gambino","Decade":"2000s, 2010s","Region":"West Coast, Dirty South","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Beer","DrugOfChoice":"Weed, Acid","Zone":"Playing video games","ResultText":"Your rap personality is Childish Gambino because, well, the internet."},
{"Rapper":"Bone Thugs N Harmony","Decade":"1990s, 2000s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Assault","Sound":"Dirty South, Classic","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You are Krayzie, Layzie, Bizzy, Wish and Flesh-n all rolled into one. Your rap personality is Bone Thugs N Harmony!"},
{"Rapper":"Nicki Minaj","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"None","Zone":"Making money","ResultText":"You've got the largest barbie collection in the world. Your rap personality is Nicki Minaj."},
{"Rapper":"Deltron 3030","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"None","Zone":"Playing video games","ResultText":"In the year 3030, everybody wants to be you. Your rap personality is Deltron 3030!"},
{"Rapper":"Run-D.M.C.","Decade":"1980s, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Making money","ResultText":"Peter Piper picked peppers, Run rocked rhymes, and you just took a quiz. Your rap personality is Run-DMC!"},
{"Rapper":"MF Doom","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Playing video games","ResultText":"The mystery is finally solved! You, of all people, are MF DOOM."},
{"Rapper":"Chuck  D","Decade":"1980's, 1990s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"Minor","Sound":"Classic, Underground/alternative","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Building a stronger community","ResultText":"You are Public Enemy number one.  Your rap personality is Chuck D."},
{"Rapper":"Joey BadaSS","Decade":"2010s","Region":"East Coast","Fashion":"Hipster","Tattoos":"a few","Intelligence":"Smart","PimpHand":"no standards","CriminalHistory":"None","Sound":"Underground/alternative","DrinkOfChoice":"Bottom shelf liquor, Beer","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"You're the 19-year-old OG Swanklord. Your rap personality is Joey Bada$$"},
{"Rapper":"Lauryn Hill","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Building a stronger community","ResultText":"You've got 'That Thing.' Your rap personality is Lauryn Hill."},
{"Rapper":"Future","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"Minor","Sound":"Pop, Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Molly","Zone":"Making money","ResultText":"I'm just being honest, your rap personality is Future!"},
{"Rapper":"Method Man","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Classic","DrinkOfChoice":"Beer, Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"You don't eat green eggs and ham, because your rap personality is Method Man!"},
{"Rapper":"Ghostface Killah","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Chilling","ResultText":"Your rap personality is Tony Starks AKA Ghostdeini AKA Pretty Toney AKA Ghostface Killah."},
{"Rapper":"French Montana","Decade":"2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"Drug dealer","Sound":"Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Cocaine","Zone":"Getting your freak on","ResultText":"You, my friend, are a cocaine connoisseur. Your rap personality is French Montana."},
{"Rapper":"Gucci Mane","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"facial","Intelligence":"Mentally incompetent","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone","Sound":"Dirty South, Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Lean, Pills","Zone":"Fighting","ResultText":"Better wear a coat, beacuse... Burr! Your rap personality is Gucci Mane!"},
{"Rapper":"Nelly","Decade":"1990s, 2000s, 2010s","Region":"Mid West","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Working out","ResultText":"Is it hot in herre, or is it just you? Your rap personality is Nelly!"},
{"Rapper":"T- Pain","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Avant-garde","Tattoos":"many","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"None","Sound":"Dirty South, Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Getting your freak on","ResultText":"You fucked a mermaid! Your rap personality is T-Pain. "},
{"Rapper":"Ludacris","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Dirty South","DrinkOfChoice":"Beer","DrugOfChoice":"Weed","Zone":"Getting your freak on","ResultText":"What's your fantasy?  Your rap personality is Ludacris."},
{"Rapper":"Big K.R.I.T.","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Dirty South, Underground/alternative","DrinkOfChoice":"Bottom shelf liquor","DrugOfChoice":"Weed","Zone":"Building a stronger community","ResultText":"You must be on some country shit, because your rap personality is Big K.R.I.T."},
{"Rapper":"Missy Elliott","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Avant-garde","Tattoos":"none","Intelligence":"Smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Getting your freak on","ResultText":"Supa dupa fly, your rap personality is Missy Elliot!"},
{"Rapper":"Paul Wall","Decade":"2000s, 2010s","Region":"Dirty South","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Street smart","PimpHand":"Semi-Pimp","CriminalHistory":"None","Sound":"Dirty South","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed, Lean","Zone":"Chilling","ResultText":"You open up your mouth and see more carats than a salad. Your rap personality is Paul Wall!"},
{"Rapper":"Slick Rick","Decade":"1980s, 1990s, 2000s","Region":"East Coast","Fashion":"Upscale","Tattoos":"none","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Pills, Weed","Zone":"Fighting","ResultText":"La di da di, it's time to party!  Your rap personality is Slick Rick!"},
{"Rapper":"Chief Keef","Decade":"2010s","Region":"Mid West","Fashion":"Thuggin'","Tattoos":"many","Intelligence":"Mentally incompetent","PimpHand":"Legit Pimp","CriminalHistory":"Might have killed someone, Drug dealer","Sound":"Trap","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"Bang bang! Stay out of trouble, Chief Keef."},
{"Rapper":"Fat Joe","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"no standards","CriminalHistory":"Might have killed someone","Sound":"Classic","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Eating","ResultText":"Pull up your pants, your rap personality is Fat Joe!"},
{"Rapper":"P Diddy","Decade":"1990s, 2000s, 2010s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Smart","PimpHand":"Legit Pimp","CriminalHistory":"Minor","Sound":"Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Making money","ResultText":"You're a Bad Boy for life, no matter how many times you change your name.  Your rap personality is P. Diddy."},
{"Rapper":"Ja Rule","Decade":"2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"many","Intelligence":"Dumb","PimpHand":"Pussy whipped","CriminalHistory":"None","Sound":"Pop","DrinkOfChoice":"Top shelf liquor","DrugOfChoice":"Weed","Zone":"Working out","ResultText":"Your pimp game is very religious. Your rap personality is Ja Rule."},
{"Rapper":"LL Cool J","Decade":"1980s, 1990s, 2000s","Region":"East Coast","Fashion":"T shirt & Jeans","Tattoos":"a few","Intelligence":"Street smart","PimpHand":"Legit Pimp","CriminalHistory":"Assault","Sound":"Classic","DrinkOfChoice":"Mountain Dew","DrugOfChoice":"None","Zone":"Working out","ResultText":"Ladies must love you, your rap personality is LL Cool J!"},
{"Rapper":"Lil' Kim","Decade":"1990s, 2000s","Region":"East Coast","Fashion":"Upscale","Tattoos":"a few","Intelligence":"Dumb","PimpHand":"Legit Pimp","CriminalHistory":"Minor","Sound":"Pop","DrinkOfChoice":"Champagne/Wine","DrugOfChoice":"Weed","Zone":"Fighting","ResultText":"According to Ben Stiller, you're phat. Your rap personality is Lil' Kim."}];


	var data_index = 0;
	for (rapper in data) {
		rapper["Index"] = data_index;
		data_index++;
	}
	
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
</script>







   
















