/* connect nodes with edges */
window.onload = function() {

    let width = 1200;
    let height = 650;

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
    new URLSearchParams(window.location.search).get('graphData');

    let data = JSON.parse(new URLSearchParams(window.location.search).get('graphData'));
    const edges = data['edges'];
    const algoResult = data['minCostMaxFlow'];
    let edge_label = '';
    let nodeX = 50;
    let nodeY = height / 2;
    for (let i = 0; i < algoResult.length; i++) {
        let g = new Dracula.Graph();
        const track = algoResult[i]['track'];
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
            g.addEdge(edges[j].from + 1, edges[j].to + 1, {
                directed: true,
                label: edge_label,
                label1: edges_w[j],
                label2: edges_w[j+1],
            });
            edge_label = '';
        }
        for(let j = 0; j < g.edges.length; j++) {
            for (let k = 0; k < track.length - 1; k++) {
                if (track[k] + 1 === g.edges[j].source.label && track[k+1] + 1 === g.edges[j].target.label) {
                    let edge = edges.find(el => el.from + 1 === g.edges[j].source.label && el.to + 1 === g.edges[j].target.label);
                    g.edges[j]['style'].fill = '#FF0000';
                    break;
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
