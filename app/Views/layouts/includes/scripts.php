<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/vendor/datatables/datatables.min.js')?>"></script>
<script src="<?=base_url('assets/vendor/daterangepicker/moment.min.js')?>"></script>
<script src="<?=base_url('assets/vendor/daterangepicker/daterangepicker.js')?>"></script>

<script src="<?=base_url('assets/js/scripts.js')?>"></script>


<script type="module">
import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs')?>'
$(document).ready(function() {
    $('#dataTable').DataTable({
        responsive: true,
        language: language
    });

    $('.dateRange').daterangepicker({
        // singleDatePicker: true,
        showDropdowns: true,
        autoApply: false,
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD'
        }
    }).on("apply.daterangepicker", function(e, picker) {
        picker.element.val(picker.startDate.format(picker.locale.format) + ' - ' + picker.endDate
            .format(picker.locale.format));
    }).on("cancel.daterangepicker", function(e, picker) {
        picker.element.val("");
    });
});
</script>