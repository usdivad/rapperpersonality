//Maindo
function main() {
	//var rappers;

	//JSON req
	$.getJSON("./src/rapper_stats.json", function(data) {
		//rappers = data;
		$("#inputForm").append(createForm(data, allParams));
		$("#submitButton").click(function() {
			var r = getSubmit(data, allParams);
			$("#results").html(r);
		});
		//getSubmit(data);
		test_parse(data, allParams);

	}); //end JSON req
}

$(document).ready(function() {
	main();
})