

//Creates form, fills in attributes
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
	console.log(inner);
	return inner;
}

//Submit function
function getSubmit(data, paramList) {
	var you = getUser(data);
	var results = calculatePersonality(you, data, paramList);
	return results;
}

//Creates user profile based on form data
function getUser(data) {
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
			else {
				console.log("You're missing a " + key + ", son");
			}
		}
	}
	console.log(user);
	return user;
}