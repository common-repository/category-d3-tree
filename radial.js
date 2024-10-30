/*
Category D3 Tree (Wordpress Plugin)
Copyright (C) 2014 Anshi Solutions
Contact me at ceo@anshisolutions.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
var taxonomy;
jQuery(document).ready(function ($) {
var root;
    
var diameter = 600;

var tree = d3.layout.tree()
    .size([360, diameter / 2 - diameter / 12])
    .separation(function(a, b) { return (a.parent == b.parent ? 1 : 2) / a.depth; });
    
var diagonal = d3.svg.diagonal.radial()
    .projection(function(d) { return [d.y, d.x / 180 * Math.PI]; });
    
    
var svg = d3.select("#categoryradial").append("svg")
    //.attr("width", diameter)
    //.attr("height", diameter)
        //.attr("width", width)
    //.attr("height", height)
    .attr("viewBox", "0 0 " + diameter+ " " + diameter)
    .attr("preserveAspectRatio", "xMinYMin")
    .append("g")
    .attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");

var link = svg.selectAll(".link"),
    node = svg.selectAll(".node");
    
jQuery.ajax({
          url: MyAjax.ajaxurl,
          data:{
               'action':'categorytree',
               'taxonomy': taxonomy
               },
          dataType: 'JSON',
          success:function(data){
          //alert(JSON.stringify(data));
                 // our handler function will go here
                 // this part is very important!
                 // its what happens with the JSON data
                 // after it is fetched via AJAX!
                 //alert(JSON.stringify(data));
                   root = data;
		  update();
                             },
          error: function(errorThrown){
               //alert(JSON.stringify(errorThrown));
               console.log(errorThrown);
          }
           
 
     });
 

function update() {
  var nodes = tree.nodes(root),
      links = tree.links(nodes);

  var link = svg.selectAll(".link")
      .data(links)
    .enter().append("path")
      .attr("class", "link")
      .attr("d", diagonal);

  var node = svg.selectAll(".node")
      .data(nodes)
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "rotate(" + (d.x - 90) + ")translate(" + d.y + ")"; })

  node.append("circle")
      .attr("r", 4.5);

  node.append("text")
      .attr("dy", ".31em")
      .attr("text-anchor", function(d) { return d.x < 180 ? "start" : "end"; })
      .attr("transform", function(d) { return d.x < 180 ? "translate(8)" : "rotate(180)translate(-8)"; })
      .text(function(d) { return d.name; });

d3.select(self.frameElement).style("height", diameter - 10 + "px");

}


});