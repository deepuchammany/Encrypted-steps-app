function make_active(item, image, name, points) {
    $('.item').removeClass("table-primary");
    $('#item' + item).addClass("table-primary");
    $('#focus_img').attr("src", "assets/" + image);
    $('#focus_name').html(name);
    $('#focus_points').html(points);
    $('#user_id').val(item);
    $('#user_name').val(name);
    var currentdate = new Date().toISOString().slice(0, 19).replace('T', ' ');
    $('#entry_time').val(currentdate);
}
$.ajax({
    url: 'leaderboard.json',
    type: "GET",
    success: function (data) {
        $.each(data, function (i, field) {
            $("#table").append('<tr id="item' + i + '" onclick=\'make_active("' + i + '","' + field.image + '","' + field.name + '","' + field.points + '")\' class="item ' + (i == 2 ? 'table-primary' : '') + '">\
                      <td>\
                          <img class="listing" src="assets/'+ field.image + '"> &nbsp;&nbsp; ' + (i + 1) + '. ' + field.name +
                '</td>\
                      <td>'
                + field.points + 'pts\
                      </td>\
                  </tr>');
            if (i == 2) {
                make_active(i, field.image, field.name, field.points);
            }
        });
    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(ajaxOptions);
        console.log(thrownError);
    }
});
