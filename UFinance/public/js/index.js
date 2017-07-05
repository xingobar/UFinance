$(document).ready(function(){
    addNewRow();
});

function addNewRow(){
    var price = 150;
    $('.table tbody').click(function(){
        var table = $(this);
        var lastElement = $(table).find('tr:last-child td:last-child');
        $(lastElement).click(function(){
            $(table).append('\
            <tr>\
                <td>\
                    <input type="text" name="account[]" value=""/>\
                </td>\
                <td>\
                    <input type="text" name="type[]" value=""/>\
                </td>\
                <td>\
                    <input type="number" name="amount[]" value="'+ price +'"/>\
                </td>\
            </tr>\
            ');
            price += 10;
        });
    });   
}
