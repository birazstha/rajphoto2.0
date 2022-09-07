<script>
    function getCustomerInfo(data) {
        var path = "/getCustomerInfo";
        $.ajax({
            method: 'get',
            url: path,
            data: data,
            dataType: 'html',
            success: function(response) {
                const responseData = JSON.parse(response);
                const data = responseData[0]?.data;
                let thead = `<thead>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Advance</th>
                    <th>Balance Amount</th>
                    <th>Ordered Date</th>
                    <th>Delivery Date</th>
                    <th>Prepared By</th>
                    <th>Action</th>
                </thead>`;
                let html = thead ;
                for (let i = 0; i < data.length; i++) {
                    const item = data[i];
                    html +=`
                    <tbody>
                        <tr>
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
                    </tr>
                    </tbody>   
                    `
                }
                
                if (data.length>0) {
                    $("#content").html(html);
                    $('.no-data').addClass('d-none');
                } else {

                    $('.no-data').removeClass('d-none');
    
                    $("#content").html(`${thead}
                <tbody>
                    <tr>
                        <tr>
                        <td>-</td>
                        <td>-</td>     
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>- </td>
                        <td>-</td>
                        <td>-</td>
                        <td>  
                        -
                        </td>
                    </tbody>
                
                `);
                }
            },
        });

    }
</script>
