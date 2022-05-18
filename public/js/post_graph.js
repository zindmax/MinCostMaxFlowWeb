$('#submit').on('click', async e => {
    e.preventDefault();

    const data = [];
    const edges = [];
    const n = document.getElementById('n').value;
    const s = document.getElementById('s').value;
    const t = document.getElementById('t').value;
    data.push(n);
    data.push(s);
    data.push(t);
    const edgeNodes = Array.from(document.getElementsByName('edges'));
    for (let i = 0; i < edgeNodes.length; i += 4) {
        edges.push({
            from: edgeNodes[i].value,
            to: edgeNodes[i + 1].value,
            capacity: edgeNodes[i + 2].value,
            cost: edgeNodes[i + 3].value,
        });
    }
    data.push(edges);
    // console.log(edges);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    await fetch('/graph', {
        method: 'post',
        headers: {
            'content-type': 'application/json',
            'accept': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({data})
    });

});
