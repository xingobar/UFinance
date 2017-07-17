var types ; 
$(document).ready(function(){
    addNewRow();
    removeLast();
    addTokenHeader();
    deleteTransaction();
    deleteType();
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

function addTokenHeader(){
    $.ajaxSetup({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function deleteTransaction(){
    $('.delete-transaction').click(function(){
        var delete_transaction_btn = $(this);
        var transaction_id = $(this).siblings('input.transaction-id').val();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url:'/deleteTransaction',
                method:'delete',
                data:{
                    transaction_id : transaction_id
                },
                success:function(data){
                    $(delete_transaction_btn).parents('.panel').remove();
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                }
            });
        });
    });
}

function deleteType(){
    $('.type-delete').click(function(){
        var typeId = $(this).attr('id');
        var typeDeleteBtn = $(this);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url:'/deleteType',
                method:'delete',
                data:{
                    typeId : typeId
                },
                success:function(data){
                    $(typeDeleteBtn).parents('.list-group-item').remove();
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                }
            });
        });
    });
}