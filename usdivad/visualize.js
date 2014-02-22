//D3 visualization
function visualize_pie(arr) {
    var radius = 250,
        height = radius*2.5,
        width = height;
    var scale = d3.scale.linear()
        .domain([0, arr[0].count]) //remember it's sorted
        .range([height-100, 0]);

    var count_arr = [];
    for (var i in arr) {
        count_arr.push(arr[i].count);
    }

    /*var color = d3.scale.ordinal()
        .domain(d3.range(0,arr.length))
        .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);
        //.range(["#000000", "#ffffff"]);
    */

    var color = function(x) {
        return "#d0743c";
    }

    var chart = d3.select(".chart")
        .attr("height", height)
        .attr("width", width)
        .data([arr]) //quest
        .append("g")
            .attr("transform", "translate(" + radius*1.125 + "," + radius*1.125 + ")");

    var arc = d3.svg.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);

    //For labels
    var outer_arc = d3.svg.arc()
        .outerRadius(radius+10)
        .innerRadius(radius+10);

    var pie = d3.layout.pie()
        .sort(null)
        .value(function(d) {return d.count;});

    var arcs = chart.selectAll("g.slice")
        .data(pie)
        .enter()
            .append("g")
                .attr("class", "slice");

        arcs.append("path")
            .attr("d", arc)
            .on("mouseover", function(d) {
                var my_data = d;
                var me = d3.select(this);
                //var printed = false;
                var idx = 0;
                var centroid = outer_arc.centroid(my_data);
                //console.log(centroid[0]);
                me.style("fill", "#4682B4")
                    .style("opacity", "1");
                arcs.append("text")
                    .attr("transform", function() {
                        return "translate(" + centroid + ")";
                    })
                    .attr("text-anchor", function() {
                        if (centroid[0] == "-") { //negative x value
                            return "end";
                        }
                        else {
                            return "start";
                        }
                    })
                    .style("fill", "black")
                    //.attr("z-index", "1000")
                    .text(function() {
                        //We only print the LAST one
                        if (idx == arr.length - 1) {
                            console.log("x");
                            var s = my_data.data.name
                                + " (" + my_data.data.percent.toFixed(2) + "%)";
                            //printed = true;
                            return s;
                        }
                        else {
                            idx += 1;
                        }
                    });
                    console.log("save");
            })
            .on("mouseout", function(d) {
                var me = d3.select(this);
                var my_data = d;
                me.style("fill", function(d) {return color(d.data.count);})
                    .style("opacity", function(d) {
                return (d.data.percent * 15) / 100; //*15 cos 7's about the max, /100 because %
            });
                arcs.selectAll("text").remove(); 
                //console.log(me.select("text"))
            })
            .style("fill", function(d,i) {
                /*
                //Random color
                var color = "hsl(" + Math.random()*360 + ",20%,50%)";
                console.log(color);
                return color;
                */

                //Scaled
                console.log(color(d.data.count));
                return color(d.data.count);
            })
            .style("opacity", function(d) {
                return (d.data.percent * 15) / 100; //*15 cos 7's about the max, /100 because %
            });

        /*
        arcs.append("text")
            .attr("transform", function(d) {
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("text-anchor", "middle")
            .attr("fill", "white")
            .text(function(d, i) {
                var s = d.data.name
                    + " (" + d.data.count + ")"
                return s;
            });
        */  


    //chart.data()
}

function visualize_links() {
  var width = 960,
      height = 500;

  var color = d3.scale.category20();

  var force = d3.layout.force()
      .charge(-520)
      .linkDistance(100)
      .size([width, height]);

  var svg = d3.select("body").append("svg")
      .attr("width", width)
      .attr("height", height);

  d3.json("force_data.json", function(error, graph) {
    force
        .nodes(graph.nodes)
        .links(graph.links)
        .start();

    var link = svg.selectAll(".link")
        .data(graph.links)
      .enter().append("line")
        .attr("class", "link")
        .style("stroke-width", function(d) { return Math.sqrt(d.value); });

    var node = svg.selectAll(".node")
        .data(graph.nodes)
      .enter().append("circle")
        .attr("class", "node")
        .attr("r", 5)
        .style("fill", function(d) { return color(d.group); })
        .call(force.drag);

    node.append("title")
        .text(function(d) { return d.name; });

    force.on("tick", function() {
      link.attr("x1", function(d) { return d.source.x; })
          .attr("y1", function(d) { return d.source.y; })
          .attr("x2", function(d) { return d.target.x; })
          .attr("y2", function(d) { return d.target.y; });

      node.attr("cx", function(d) { return d.x; })
          .attr("cy", function(d) { return d.y; });
    });
  });
}

function viz_test() {
    var max = 100
    var total = 0;
    var arr = [
        {"name":"Kendrick Lamar", "count":rand_int(max)},
        {"name":"James Blake", "count":rand_int(max)},
        {"name":"Kurt Vile", "count":rand_int(max)}
    ];
    for (var i in arr) {
        total += arr[i]["count"];
    }
    for (var i in arr) {
        arr[i]["percent"] = 100*arr[i]["count"]/total;
    }
    visualize(arr);
    console.log(arr);
}