/* connect nodes with edges */
window.onload = function() {

    let width = 1200;
    let height = 650;

    var render = function(r, n) {
        var label = r.text(0, 0, n.label).attr({fill: '#000000', 'font-size': 20})
        var set = r.set()
            .push(
                r.circle(0, 0, 30)
                    .attr({stroke: '#000000', 'stroke-width' : 2, fill: '#FFFFFF', 'fill-opacity': 0, r: 25 })
            )
            .push(label)
        return set
    }
    new URLSearchParams(window.location.search).get('graphData');

    let data = JSON.parse(new URLSearchParams(window.location.search).get('graphData'));
    const edges = data['edges'];
    const algoResult = data['minCostMaxFlow'];
    let edge_label = '';
    let nodeX = 50;
    let nodeY = height / 2;
    for (let i = 0; i < algoResult.length; i++) {
        let g = new Dracula.Graph();
        let track = [];
        if (i > 0) {
            track = algoResult[i-1]['track'];
        }else {
            track = algoResult[i]['track'];
        }
        for (let j = 1; j <= data['n']; j+=1) {
            if (j !== 1) {
                if (j % 2 === 0) {
                    nodeY = height / 2 - 200;
                    nodeX += 250;
                }else {
                    nodeY = height / 2 + 200;
                }
            }
            if (j === parseInt(data['n'])) {
                nodeY = height / 2;
            }
            g.addNode(j, { render: render, label: j, x: nodeX, y: nodeY });
        }
        let edges_w = algoResult[i]['edges_w'];
        let edges_flow = algoResult[i]['edges_flow'];
        for(let j = 0; j < edges.length; j+=2) {
            edge_label = edge_label.concat(edges[j].capacity, '\\', edges[j].cost, '\\', edges_flow[j]);
            let color = "#000000";
            if (edges[j].capacity === edges_flow[j]) {
                color = "#FF0000";
            }
            g.addEdge(edges[j].from + 1, edges[j].to + 1, {
                directed: true,
                fill: color,
                label: edge_label,
                label1: edges_w[j+1],
                label2: edges_w[j],
            });
            edge_label = '';
        }

        if (i > 0) {
            for(let j = 0; j < g.edges.length; j++) {
                for (let k = 0; k < track.length - 1; k++) {
                    let from = g.edges[j].source.label;
                    let to = g.edges[j].target.label;
                    if (track[k] + 1 === from && track[k+1] + 1 === to) {
                        g.edges[j]['style'].fill = '#00FF00';
                        break;
                    }
                    if (track[k] + 1 === to && track[k+1] + 1 === from) {
                        g.edges[j]['style'].fill = '#0000FF';
                        break;
                    }
                }
            }
        }
        var layouter = new Dracula.Layout.Spring(g);
        layouter.layout();
        var renderer = new Dracula.Renderer.Raphael('#canvas'+i, g, width, height);
        renderer.draw();
        nodeX = 50;
        nodeY = height / 2;
    }
};
