
@include('frontend.bill.include.scripts.getCustomerInfo')
<script>

$(document).ready(function(){
    $(document).on('click','.pagination a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getCustomerInfo(page);   
    });
});
</script>
