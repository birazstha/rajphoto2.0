<script>
    //For attribute
    var attribute_wrapper = $("#attribute_wrapper"); //Fields wrapper
    var add_button_attribute = $("#addMoreBill"); //Add button ID
    var x =1;
    $(add_button_attribute).click(function (e){ //on add input button click
        e.preventDefault();
        var max_field = 15; //maximum input boxes allowed
        if(x < max_field){ //max input allowed
            x++; //textbox increment
            var id = 'remove_row' + x;
            var select_id = 'select_attribute_' + x;
            //ajax call with test id
            $("#attribute_wrapper tr:last").after(
                '<tr>'
                + '<td>'
                + '<td><input type="text" name="attribute_value[]" class="form-control" placeholder="Enter Attribute Value"/></td>'
                + '<td>'
                + '<a href="" class="btn btn-block btn-warning sa-warning remove_row"> <i class="fa fa-trash"> </i></a>'
                + '</td>'
                + '</tr>'
            );
                   $.ajax({
                url:path,
                data: {'_token':$('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                dataType: 'text',
                success:function(myJson){
                    var idd = '#'+select_id;
                    $.each(JSON.parse(myJson),function(key,val){
                        $(idd).append('<option value="' +key+ '">' +val+ '</option>');
                    });
                }
            });

        } else{
            alert("Max field reached." +max_field + "allowed");
        }
    });

    $(attribute_wrapper).on("click",".remove_row",function (e){
        e.preventDefault();
        $(this).parents("tr").remove();
        x--;
    });


</script>
