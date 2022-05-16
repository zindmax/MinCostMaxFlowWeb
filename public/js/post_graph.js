$('#submit').on('click', async e => {
    e.preventDefault();

    const edges = [];
    const edgeNodes = Array.from(document.getElementsByName('edges'));

    for (let i = 0; i < edgeNodes.length; i += 4) {
        edges.push({
            from: edgeNodes[i].value,
            to: edgeNodes[i + 1].value,
            capacity: edgeNodes[i + 2].value,
            cost: edgeNodes[i + 3].value,
        });
    }

    fetch('/graph', {
        method: 'post',
        headers: {
            'content-type': 'application/json',
            'accept': 'application/json',
        },
        body: JSON.stringify({edges}),
    });
});
