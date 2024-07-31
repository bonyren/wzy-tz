<style type="text/css">
.node {cursor: pointer;}
</style>
<div style="position: relative">
    <div id="d3body"></div>
</div>
<script type="text/javascript" src="/static/js/d3.v3.min.js"></script>
<script type="text/javascript" src="/static/js/saveSvgAsPng.js"></script>
<script type="text/javascript">
var relationTree = {
    daochu:function(){
        saveSvgAsPng($("#d3body>svg")[0], "relation.png");
    },
    show:function(){
        var that = this;
        $.post('<?=$_request_url?>', {}, function(data){
            that.paint(data);
        }, 'json');
    },
    paint:function(treeData){
        // Calculate total nodes, max label length
        var totalNodes = 0;
        var maxLabelLength = 0;
        // panning variables
        var panSpeed = 200;
        // Misc. variables
        var i = 0;
        var duration = 750;
        var root;

        // size of the diagram
        var viewerWidth = $(document).width()-220;
        var viewerHeight = $(document).height()-80;

        var tree = d3.layout.tree().size([viewerHeight, viewerWidth]);

        // define a d3 diagonal projection for use by the node paths later on.
        var diagonal = d3.svg.diagonal().projection(function(d) {
            return [d.y, d.x];
        });

        // A recursive helper function for performing some setup by walking through all nodes
        function visit(parent, visitFn, childrenFn) {
            if (!parent) return;
            visitFn(parent);
            var children = childrenFn(parent);
            if (children) {
                var count = children.length;
                for (var i = 0; i < count; i++) {
                    visit(children[i], visitFn, childrenFn);
                }
            }
        }

        // Call visit function to establish maxLabelLength
        visit(treeData, function(d) {
            totalNodes++;
            maxLabelLength = Math.max(d.name.length, maxLabelLength);
        }, function(d) {
            return d.children && d.children.length > 0 ? d.children : null;
        });

        // sort the tree according to the node names
        function sortTree() {
            tree.sort(function(a, b) {
                return b.name.toLowerCase() < a.name.toLowerCase() ? 1 : -1;
            });
        }
        // Sort the tree initially incase the JSON isn't in a sorted order.
        //sortTree();

        // TODO: Pan function, can be better implemented.
        function pan(domNode, direction) {
            var speed = panSpeed;
            if (panTimer) {
                clearTimeout(panTimer);
                translateCoords = d3.transform(svgGroup.attr("transform"));
                if (direction == 'left' || direction == 'right') {
                    translateX = direction == 'left' ? translateCoords.translate[0] + speed : translateCoords.translate[0] - speed;
                    translateY = translateCoords.translate[1];
                } else if (direction == 'up' || direction == 'down') {
                    translateX = translateCoords.translate[0];
                    translateY = direction == 'up' ? translateCoords.translate[1] + speed : translateCoords.translate[1] - speed;
                }
                scaleX = translateCoords.scale[0];
                scaleY = translateCoords.scale[1];
                scale = zoomListener.scale();
                svgGroup.transition().attr("transform", "translate(" + translateX + "," + translateY + ")scale(" + scale + ")");
                d3.select(domNode).select('g.node').attr("transform", "translate(" + translateX + "," + translateY + ")");
                zoomListener.scale(zoomListener.scale());
                zoomListener.translate([translateX, translateY]);
                panTimer = setTimeout(function() {
                    pan(domNode, speed, direction);
                }, 50);
            }
        }

        // Define the zoom function for the zoomable tree
        function zoom() {
            svgGroup.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
        }


        // define the zoomListener which calls the zoom function on the "zoom" event constrained within the scaleExtents
        var zoomListener = d3.behavior.zoom().scaleExtent([0.1, 3]).on("zoom", zoom);

        // define the baseSvg, attaching a class for styling and the zoomListener
        var baseSvg = d3.select("#d3body").html('').append("svg")
            .attr("width", viewerWidth)
            .attr("height", viewerHeight)
            .style("background-color", "#fff")
            .call(zoomListener);

        // Helper functions for collapsing and expanding nodes.
        function collapse(d) {
            if (d.children) {
                d._children = d.children;
                d._children.forEach(collapse);
                d.children = null;
            }
        }
        function expand(d) {
            if (d._children) {
                d.children = d._children;
                d.children.forEach(expand);
                d._children = null;
            }
        }

        // Toggle children function
        function toggleChildren(d) {
            if (d.children) {
                d._children = d.children;
                d.children = null;
            } else if (d._children) {
                d.children = d._children;
                d._children = null;
            }
            return d;
        }

        // Toggle children on click.
        function click(d) {
            if (d3.event.defaultPrevented) return; // click suppressed
            d = toggleChildren(d);
            update(d);
        }

        function update(source) {
            // Compute the new height, function counts total children of root node and sets tree height accordingly.
            // This prevents the layout looking squashed when new nodes are made visible or looking sparse when nodes are removed
            // This makes the layout more consistent.
            var levelWidth = [1];
            var childCount = function(level, n) {
                if (n.children && n.children.length > 0) {
                    if (levelWidth.length <= level + 1) levelWidth.push(0);

                    levelWidth[level + 1] += n.children.length;
                    n.children.forEach(function(d) {
                        childCount(level + 1, d);
                    });
                }
            };
            childCount(0, root);
            var newHeight = d3.max(levelWidth) * 50; // 35 pixels per line
            if (newHeight > viewerHeight) {
                $("#d3body>svg").attr('height',newHeight+50);
            }
            tree = tree.size([newHeight, viewerWidth]);

            // Compute the new tree layout.
            var nodes = tree.nodes(root).reverse(),
                links = tree.links(nodes);

            // Set widths between levels based on maxLabelLength.
            nodes.forEach(function(d) {
                //d.y = (d.depth * (maxLabelLength * 40)); //maxLabelLength * 10px
                d.y = d.depth * 150; //500px per level.
                // alternatively to keep a fixed scale one can set a fixed depth per level
                // Normalize for fixed-depth by commenting out below line
            });

            // Update the nodes…
            var node = svgGroup.selectAll("g.node").data(nodes, function(d) {
                return d.id || (d.id = ++i);
            });

            // Enter any new nodes at the parent's previous position.
            var nodeEnter = node.enter().append("g")
                //.call(dragListener)
                .attr("class", "node")
                .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
                .on('click', click);

            nodeEnter.append("circle")
                .attr("r", 0)
                .attr("style", function(d) {
                    return 'stroke:steelblue;stroke-width:1.5px;'+(d._children?'fill:lightsteelblue':'fill:#fff');
                });

            nodeEnter.append("text")
                .attr("x", function(d){return d.children || d._children ? -10 : 10;})
                .attr("dy", ".35em")
                .attr("text-anchor", function(d){return d.children || d._children ? "end" : "start";})
                //.attr("text-anchor", function(d) { return d.level == 'top' ? 'end' : 'start'; })
                .attr('style', function(d){
                    return 'font-size:14px;fill-opacity:1;'+(d.is_manager?'font-weight:bold;fill:red;':'');
                })
                .text(function(d){
                    return d.name;
                });

            // Update the text to reflect whether node has children or not.
            //node.select('text')
            //    .attr("x", function(d){return d.children || d._children ? -10 : 10;})
            //    .attr("text-anchor",function(d){return d.children || d._children ? "end" : "start";})
            //    .text(function(d){return d.title ? d.name+'('+ d.title+')' : d.name;});

            // Change the circle fill depending on whether it has children and is collapsed
            node.select("circle")
                .attr("r", 4.5)
                .attr("style", function(d) {
                    return 'stroke:steelblue;stroke-width:1.5px;'+(d._children?'fill:lightsteelblue':'fill:#fff');
                });

            // Transition nodes to their new position.
            var nodeUpdate = node.transition()
                .duration(duration)
                .attr("transform", function(d) {
                    return "translate(" + d.y + "," + d.x + ")";
                });

            // Fade the text in
            nodeUpdate.select("text").style("fill-opacity", 1);

            // Transition exiting nodes to the parent's new position.
            var nodeExit = node.exit().transition()
                .duration(duration)
                .attr("transform", function(d) {
                    return "translate(" + source.y + "," + source.x + ")";
                })
                .remove();

            nodeExit.select("circle").attr("r", 0);

            nodeExit.select("text").style("fill-opacity", 0);

            // Update the links…
            var link = svgGroup.selectAll("path.link")
                .data(links, function(d) {
                    return d.target.id;
                });

            // Enter any new links at the parent's previous position.
            link.enter().insert("path", "g")
                .attr("class", "link")
                .attr("d", function(d) {
                    var o = {
                        x: source.x0,
                        y: source.y0
                    };
                    return diagonal({
                        source: o,
                        target: o
                    });
                })
                .attr('style',function(d){
                    return 'fill:none;stroke-width:0.5px;stroke:#333;'+ (d.target.type == 'industry' ? '' : 'stroke-dasharray:5;');
                });

            // Transition links to their new position.
            link.transition().duration(duration).attr("d", diagonal);

            // Transition exiting nodes to the parent's new position.
            link.exit().transition().duration(duration).attr("d", function(d) {
                var o = {
                    x: source.x,
                    y: source.y
                };
                return diagonal({
                    source: o,
                    target: o
                });
            }).remove();

            // Stash the old positions for transition.
            nodes.forEach(function(d) {
                d.x0 = d.x;
                d.y0 = d.y;
            });
        }

        // Append a group which holds all nodes and which the zoom Listener can act upon.
        var svgGroup = baseSvg
            .append("g")
            .attr("transform", "translate(100,20)");

        // Define the root
        root = treeData;
        root.x0 = viewerHeight / 2;
        root.y0 = 0;

        //Layout the tree initially and center on the root node.
        update(root);
    }
};
relationTree.show('recommend');
</script>