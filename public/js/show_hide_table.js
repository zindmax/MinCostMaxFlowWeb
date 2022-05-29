function showTable(id) {
    console.log(id);
    let table = document.getElementById(id);
    console.log(table);
    table.style.display = table.style.display === "block" ? "none" : 'block';
}
