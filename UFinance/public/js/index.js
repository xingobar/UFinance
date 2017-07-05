var types ; 
$(document).ready(function(){
    addNewRow();
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
                    <select class="form-control" name="type[]"></select>\
                </td>\
                <td>\
                    <input type="number" name="amount[]" value="'+ price +'"/>\
                </td>\
            </tr>\
            ');
            price += 10;
            types.forEach(function(item){
                $(table).find('tr:last-child select').append('<option value="'+ item['name'] + '">'+ item['name'] + '</option>' );
            });
        });

    });   
}
