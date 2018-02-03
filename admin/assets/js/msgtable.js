jQuery(document).ready(function() {

    var $tbody = $("#msg-tbody");

    function addRow(msg, recipients, date) {
        var el = $("<tr></tr>");
        el.append($("<td>" + msg + "</td>"));
        el.append($("<td>" + recipients + "</td>"));
        el.append($("<td>" + date + "</td>"));

        $tbody.append(el);
    }

    $.ajax({
        url: "assets/action.php",
        method: "POST",
        data: { fetchOutbox: 1 },
        success: function(data) {
            $tbody.html(data);
        }
    });

});