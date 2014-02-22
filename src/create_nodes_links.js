//For local / usdivad.com
function main_local() {
    //var rappers;

    //JSON req
    $.getJSON("./src/rapper_stats.json", function(data) {

        var out = create_nodes_links(data);
        $("#output").html(JSON.stringify(out));

    }); //end JSON req
}

//Create nodes and links in format for d3
function create_nodes_links(data) {
    var nodes = node(data);
    var links = link(data);

    return {"nodes":nodes, "links":links};
}

//Create nodes array
function node(data) {
    var nodes = [];
    for (var i in data) {
        var element = data[i];
        var node = {};
        node["name"] = element["Rapper"];
        node["group"] = det_group(element["Region"]);
        node["index"] = i;
        nodes.push(node);
    }
    return nodes;
}

//Create links array
function link(data) {
    var links = [];
    var params = get_params();
    var threshold = 18; //otherwise too many links
    for (var i in data) {
        for (var j=i; j<data.length; j++) {
            var link = {"source":parseInt(i), "target":parseInt(j)}; //parseInt to abolish formatting errors in json
            //console.log(data[i]);
            link["value"] = manhattan_distance(data[i], data[j], params)+1; //remove 0's
            if (link["value"] < threshold) { //we want shortest links
                links.push(link);
            }
        }
    }
    return links;
}

function det_group(attr) {
    //West and East Coast are generally mutually exclusive
    if (attr.indexOf("West Coast") != 0) {
        if (attr.indexOf("Dirty South") != 0 && attr.indexOf("Mid West") != 0) {
            return 1;
        }
        else if (attr.indexOf("Dirty South") != 0) {
            return 2;
        }
        else if (attr.indexOf("Mid West") != 0) {
            return 3;
        }
    }
    if (attr.indexOf("East Coast") != 0) {
        if (attr.indexOf("Dirty South") != 0 && attr.indexOf("Mid West") != 0) {
            return 4;
        }
        else if (attr.indexOf("Dirty South") != 0) {
            return 5;
        }
        else if (attr.indexOf("Mid West") != 0) {
            return 6;
        }
    }

}