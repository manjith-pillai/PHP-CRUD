
$(function(){
    var url = "http://localhost/CorePHPCrud/";
   	 	/* Create new Item */
$(".crud-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var title = $("#create-item").find("input[name='title']").val();
    var description = $("#create-item").find("textarea[name='description']").val();
    if(title != '' && description != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{title:title, description:description}
        }).done(function(data){
            $("#create-item").find("input[name='title']").val('');
            $("#create-item").find("textarea[name='description']").val('');
              $('#userData tbody').prepend('<tr id="tr_'+data.id+'"><td>'+data.title+'</td><td>'+data.description+'</td><td data-id="'+data.id+'"><button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> <button class="btn btn-danger remove-item">Delete</button></td></tr>');
            $(".modal").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 2000});
            
        });
       
    }else{
        alert('You are missing title or description.')
    }
    

});

/* Remove Item */
$("body").on("click",".remove-item",function(){

    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url + 'api/delete.php',
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 2000});
    });

});

/* Edit Item */
$("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").data('id');

    var title = $(this).parent("td").prev("td").prev("td").text();
    var description = $(this).parent("td").prev("td").text();
    $("#edit-item").find("input[name='title']").val(title);
    $("#edit-item").find("textarea[name='description']").val(description);
    $("#edit-item").find(".edit-id").val(id);

});

/* Updated new Item */
$(".crud-submit-edit").click(function(e){

    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var title = $("#edit-item").find("input[name='title']").val();
    var description = $("#edit-item").find("textarea[name='description']").val();
    var id = $("#edit-item").find(".edit-id").val();
    if(title != '' && description != ''){
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + form_action,
            data:{title:title, description:description,id:id}
        }).done(function(data){
          $('#tr_' + data.id).find("td").eq(0).html(data.title);
          $('#tr_' + data.id).find("td").eq(1).html(data.description);
          $('#tr_' + data.id).find("td").eq(2).html('<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> <button class="btn btn-danger remove-item">Delete</button>');
            $(".modal").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 2000});
        });
    }else{
        alert('You are missing title or description.')
    }

});
   	 });
   