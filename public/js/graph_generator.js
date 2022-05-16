/* connect nodes with edges */
window.onload = function() {
    var g = new Dracula.Graph();

    var render = function(r, n) {
        var label = r.text(0, 0, n.label).attr({fill: '#000000', 'font-size': 20})
        var set = r.set()
            .push(
                r.circle(0, 0, 30)
                    .attr({fill: '#FFFFFF', 'fill-opacity': 0, r: 30 })
            )
            .push(label)
        return set
    }

    g.addNode("1", {render : render, label : "1"});
    g.addNode("2", {render : render, label : "2"});
    g.addNode("3", {render : render, label : "3"});
    g.addNode("4", {render : render, label : "4"});
    g.addNode("5", {render : render, label : "5"});
    g.addNode("6", {render : render, label : "6"});
    g.addNode("7", {render : render, label : "7"});
    g.addNode("8", {render : render, label : "8"});

    g.addEdge("1", "2", {
        directed : true,
        label: 'Label',
        label1: 0,
        label2: 1,
        style:{'font-size': '#000000'}
    });
    g.addEdge("1", "3", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("2", "3", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("2", "4", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("3", "5", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("4", "6", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("5", "4", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("5", "7", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("6", "7", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("6", "8", {
        directed : true,
        label: 'Label',
        label1: 0,
    });
    g.addEdge("7", "8", {
        directed : true,
        label: 'Label',
        label1: 0,
    });

    var layouter = new Dracula.Layout.Spring(g);
    layouter.layout();
    var renderer = new Dracula.Renderer.Raphael('#canvas', g, 1100, 1400);
    renderer.draw();

    redraw = function() {
        g.addEdge("1", "3", {
            directed : true,
            label: 'Label',
            label1: 0,
        });
        g.addEdge("2", "3", {
            directed : true,
            label: 'Label',
            label1: 0,
        });
        layouter.layout();
        renderer.draw();
    }
    // let g = new Dracula.Graph();
    // //
    // let layouter = new Dracula.Layout.Spring(g);
    // // layouter.layout();
    // //
    // let renderer = new Dracula.Renderer.Raphael(document.getElementById('canvas'), g, 700, 700);
    // // renderer.draw();
    //
    // var render = function (r, n) {
    //     var label = r.text(0, 0, n.label).attr({ fill: '#000000', 'font-size': 20 })
    //     var set = r.set()
    //         .push(
    //             r.circle(0, 0, 30)
    //                 .attr({ fill: '#FFFFFF', 'fill-opacity': 0, r: 30 })
    //         )
    //         .push(label)
    //     return set
    // }
    //
    // redraw  = function () {
    //     const edges = [];
    //     const edgeNodes = Array.from(document.getElementsByName('edges'));
    //
    //     for (let i = 0; i < edgeNodes.length; i += 4) {
    //         edges.push({
    //             from: edgeNodes[i].value,
    //             to: edgeNodes[i + 1].value,
    //             capacity: edgeNodes[i + 2].value,
    //             cost: edgeNodes[i + 3].value,
    //         });
    //     }
    //     console.log(edges)
    //     let edge_label = '';
    //     for (let i = 0; i < edges.length; i++) {
    //         // edge_label.concat(edges[i].capacity.toString, '\\', edges[i].cost.toString());
    //         edge_label = edge_label.concat(edges[i].capacity, '\\', edges[i].cost)
    //         g.addNode(edges[i].from, { render: render, label: edges[i].from });
    //         g.addNode(edges[i].to, { render: render, label: edges[i].to });
    //         g.addEdge(edges[i].from, edges[i].to, {
    //             directed: true,
    //             style: {
    //                 label: edge_label,
    //                 "label-style": {
    //                     "font-size": 20,
    //                     "fill": "#000000",
    //                     'background': 'red'
    //                 }
    //             }
    //         });
    //     }
    //     // console.log(g.edges);
    //     layouter.layout();
    //     renderer.draw();
    // };
};
