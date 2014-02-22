//Tally ho!
function tally() {
    
    //Get the logged data
    $.get("collected_data.txt", function(data) {
        var tally_obj = {};
        var tally_arr = [];
        var lines = data.split("\n");
        var total = 0;
        var out = "";

        //Counting frequency of each rapper
        for (var i in lines) {
            var line = lines[i];
            var name_arr = line.match(/^(.+?(?= from))/);
            var name = "";
            if (name_arr != null) { //use null, not undefined check
                //console.log(line);
                //console.log(name_arr[0]);
                name = name_arr[0];
                if (typeof tally_obj[name] == "undefined") {
                    tally_obj[name] = 1;
                }
                else {
                    tally_obj[name]++;
                }
                total++;
            }
        }

        //Construct and sort an array of name-count pairs
        //Objects look like {"name":"DJ Dog Dick", "count":"666"}
        for (key in tally_obj) {
            obj = {};
            obj["name"] = key;
            obj["count"] = tally_obj[key];
            obj["percent"] = (obj["count"]/total)*100; //Now that we have the total we can compute %s
            //console.log(obj);
            tally_arr.push(obj);
        }
        tally_arr.sort(function(x, y) {
            var xc = x["count"];
            var yc = y["count"];
            if (xc < yc) { //descending
                return 1;
            }
            else if (xc == yc) {
                return 0;
            }
            else {
                return -1;
            }
        });

        //Print results
        out += "Total results: " + total + "<br><br>";
        //out += to_s(tally_arr, total);
        $("#results").html(out);
        //console.log(tally_obj);

        //D3
        visualize_pie(tally_arr);

    }); //end ajax
}

//
//t=tally_arr, n=total
function to_s(t, n) {
    s = "";
    for (var i in t) {
        var name = t[i]["name"];
        var count = t[i]["count"];
        var percent = t[i]["percent"];
        s += name + ": <b>" + count + "</b> (" + percent.toFixed(2) + "%)" + "<br>";
    }
    return s;
}

function rand_int(n) {
    return Math.floor(Math.random()*n);
}