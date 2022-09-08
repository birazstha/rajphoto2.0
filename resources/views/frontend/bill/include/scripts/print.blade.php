<script type="text/javascript">
function printBill()
{
var body = document.getElementById('body').innerHTML;
var bill = document.getElementById('bill').innerHTML;

    document.getElementById('body').innerHTML=bill;
    window.print()
    document.getElementById('body').innerHTML=body;


}
</script>
