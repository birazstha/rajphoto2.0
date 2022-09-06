
   var fetchBillInfo = function(name) {  
    var path = "{{ URL::route('bill.getCustomerInfo') }}";
    $.ajax({
        method: 'post',
        url: path,
        data: {
            'customer_name': name,
            '_token': "{{ csrf_token() }}"
        },
        dataType: 'html',
        success: function(response) {
            const responseData = JSON.parse(response);
            const data = responseData[0]?.data;
            
            let html = '';
            for(let i =0; i< data.length; i++){
        
                const item = data[i];
                html +=
                    `<tr>
                        <td>${i+1}</td>
                        <td>${item.name}</td>     
                        <td>${item.grand_total}</td>
                        <td>${item.paid_amount}</td>
                        <td>${item.balance_amount}</td>
                        <td>${item.ordered_date} </td>
                        <td>${item.delivery_date}</td>
                        <td>${item.users.name}</td>
                        <td>  
                        <a href="search/${item.qr_code}" target="_blank" class="btn btn-success"><i class="far fa-eye"></i></a>
                        <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        <a href="bills/${item.id}" target="_blank" class="btn btn-warning"><i class="fas fas fa-print"></i></a>
                        </td>
                    </tr>`
            }

          

            if (html !== "") {
                $("#content").html(html);
            } else {
                $("#content").html(
                    '<tr><td colspan="9" class="text-center text-danger">No data found</td></tr>'
                );
            }
        },
    });


}