<div class="print" id="print">
    <img src="../img/cheq.png" width="200px"><br>
    cheq brek trek sadasdsada sdsadasd
</div>

<style>
      .print{
     align-items:center;
     width:58mm;
     display: none;
     }
     @media print{
         .print{
         display:block;
         }
     }


</style>
<script>
// window.print();

function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=2,width=2');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

</script>
