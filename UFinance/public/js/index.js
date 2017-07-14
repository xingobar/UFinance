var types ; 
$(document).ready(function(){
    addNewRow();
    removeLast();
});

function getTypes(){
    $.ajax({
        url:'/getTypes',
        async:false,
        success:function(data){
            types =  data;
        }
    });
}

function addNewRow(){
    getTypes();
    var price = 150;
    $('#add_to_last').click(function(){
        var table = $('.table tbody');
        $(table).append('\
            <tr>\
                <td>\
                    <input class="form-control" type="text" name="account[]" value=""/>\
                </td>\
                <td>\
                    <select class="form-control" name="type[]"></select>\
                </td>\
                <td>\
                    <input class="form-control" type="number" name="amount[]" value="'+ price +'"/>\
                </td>\
            </tr>\
            ');
            price += 10;
            types.forEach(function(item){
            $(table).find('tr:last-child select').append('<option value="'+ item['name'] + '">'+ item['name'] + '</option>' );
        });
    });
}

function removeLast(){
    $("#remove_last").click(function(){
        var lastElement = $('.table tbody tr:last-child');
        $(lastElement).remove();
    });
}
