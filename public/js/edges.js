$('.add').on('click', function ( ){
    // let new_chq_no = parseInt($("#total_edges").val()) + 1;
    let new_input = "<div class='d-flex flex-row mb-2'>" +
        "<div class='me-2'>" +
        "<input type='number' name ='edges' placeholder='from'>" +
        "</div>" +
        "<div class='me-2'>" +
        "<input type='number' name ='edges' placeholder='to'>" +
        "</div>" +
        "<div class='me-2'>" +
        "<input type='number' name ='edges' placeholder='capacity'>" +
        "</div>" +
        "<div class='me-2'>" +
        "<input type='number' name ='edges' placeholder='cost'>" +
        "</div>" +
        "</div>";
    $("#edges").append(new_input);
    // $("#total_edges").val(new_chq_no);
});
$('.remove').on('click', function () {
    let last_chq_no = $("#total_edges").val();
    if (last_chq_no > 0) {
        $('#edge_' + last_chq_no).remove();
        $("#total_edges").val(last_chq_no - 1) ;
    }
});
