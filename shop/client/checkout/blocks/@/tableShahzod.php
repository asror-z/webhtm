<?php
/** @var ZView $this */

$this->fileJs('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js');
$this->fileJs('https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js');
$this->fileCss('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');
$this->fileCss('https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css');

use zetsoft\system\kernels\ZView;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\market\ZInputSpinnerWidget;

?>

<style>
    table.dataTable tr.group-end td {
        text-align: right;
        font-weight: normal;
    }
</style>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Age</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
    </tr>
    
    <tr>
        <td>Garrett Winters</td>
        <td>Accountant</td>
        <td>Tokyo</td>
        <td>63</td>
        <td>2011/07/25</td>
        <td>$170,750</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Age</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </tfoot>
</table>


<script>

    $(document).ready(function () {
        $('#example').DataTable({
            order: [[2, 'asc']],
            rowGroup: {
                endRender: function (rows, group) {
                    var avg = rows
                        .data()
                        .pluck(5)
                        .reduce(function (a, b) {
                            return a + b.replace(/[^\d]/g, '') * 1;
                        }, 0) / rows.count();

                    return 'Average salary in ' + group + ': ' +
                        $.fn.dataTable.render.number(',', '.', 0, '$').display(avg);
                },
                dataSrc: 2
            }
        });
    });

</script>


