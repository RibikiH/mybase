<?= $this->Html->script([
    'admin/app.min.js',
    'admin/jquery.slimscroll.min.js',
    'admin/fastclick.min.js',
    'admin/jquery.dataTables.min.js',
    'admin/dataTables.bootstrap.min.js',
    'admin/admin.js'
]) ?>

<script type="text/javascript">
    var baseUrl = '<?= $this->Url->build('/', true); ?>';
    $.extend( true, $.fn.dataTable.defaults, {
        'language': {
            "decimal": ",",
            "emptyTable": "<?= __('No data available in table') ?>",
            "info": "<?= __('Showing _START_ to _END_ of _TOTAL_ entries') ?>",
            "infoEmpty": "<?= __('Showing 0 to 0 of 0 entries') ?>",
            "infoFiltered": "<?= __('(filtered from _MAX_ total entries)') ?>",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "<?= __('Show _MENU_ entries') ?>",
            "loadingRecords": "<?= __('Loading...') ?>",
            "processing": "<?= __('Processing...') ?>",
            "search": "<?= __('Search:') ?>",
            "zeroRecords": "<?= __('No matching records found') ?>",
            "paginate": {
                "first": "<?= __('First') ?>",
                "last": "<?= __('Last') ?>",
                "next": "<?= __('Next') ?>",
                "previous": "<?= __('Previous') ?>"
            },
            "aria": {
                "sortAscending": "<?= __(': activate to sort column ascending') ?>",
                "sortDescending": "<?= __(': activate to sort column descending') ?>"
            }
        }
    });
</script>