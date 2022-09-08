
@include('frontend.bill.include.scripts.getCustomerInfo')
<script>

$(document).ready(function(){
    var pageNumber = 1;
 
    $(document).on('click','.pagination li',function(e){

        
        e.preventDefault();
        // var page = $(this).attr('href').split('page=')[1];

        var btnType = $(this).data('type');
        if(btnType === 'next'){
            $('.previous').removeClass('disabled');
            pageNumber++;
          
        }else{
          
            if(pageNumber==0){
                $('.previous').addClass('disabled');
               return false;
            }
            pageNumber--;
          

        }
     
        
        getCustomerInfo(pageNumber);   
        $(this).parent().addClass('active');

        // window.history.pushState('obj', 'newtitle', `?page=${page}`);

    });
});
</script>
