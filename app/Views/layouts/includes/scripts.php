<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/vendor/datatables/datatables.min.js')?>"></script>
<script src="<?=base_url('assets/js/scripts.js')?>"></script>


<script type="module">
import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs')?>'
$(document).ready(function() {
    $('#dataTable').DataTable({
        responsive: true,
        language: language
    });
});
</script>