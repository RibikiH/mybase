<?php
    $this->assign('title', __('Users'));
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= __('List user') ?></h3>
                <div class="box-tools">
                    <a href="<?= $this->Url->Build('/admin/user/add', true) ?>" class="btn btn-block btn-primary"><?= __('Add') ?></a>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-main" class="table table-bordered table-hover" cellspacing="0" >
                    <thead>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <th>Email</th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created at') ?></th>
                            <th><?= __('Delete') ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <th>Email</th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created at') ?></th>
                            <th><?= __('Delete') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <!-- /.col -->
</div>

<script>
    $(document).ready(function() {
        var sortedCol = $.cookie('sortedCol'),
            table = $('#table-main'),
            sort = AdminController.getParams('sort'),
            dir = AdminController.getParams('dir'),
            page = AdminController.getParams('page'),
            pageLength = AdminController.getParams('length'),
            length = (!pageLength) ? 25 : pageLength;

        switch (AdminController.getParams('sort')) {
            case 'username':
            default:
                sort = 0;
                break;
            case 'email':
                sort = 1;
                break;
            case 'role':
                sort = 2;
                break;
            case 'created':
                sort = 3;
                break;
        }

        var dataTable = table.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?= $this->Url->Build('/admin/user/get-data.json', true) ?>",
            "columns": [
                {"name" : "username"},
                {"name" : "email"},
                {"name" : "role", "searchable": false},
                {"name" : "created", "searchable": false},
                {"name" : "delete", "searchable": false, "sortable": false}
            ],
            "columnDefs": [
                {
                    "targets": [0],
                    "render": function ( data, type, row ) {
                        var itemID = row[4];
                        return '<a href="<?= $this->Url->Build('/admin/user/edit', true) ?>/'+itemID+' ">' + data + '</a>';
                    }
                },
                {
                    "targets": [4],
                    "render": function ( data, type, row ) {
                        var itemID = row[4];
                        return '<a href="#" data-toggle="modal" data-target="#delete_modal" data-id="' + itemID + '" data-model="user"><?= __('Delete') ?></a>';
                    }
                }
            ],
            "order": (!sort || !dir) ? [[0, 'asc']] : [[sort , dir]],
            "displayStart" : (!page) ? 0 : (page - 1) * length,
            "pageLength" : length,
            "lengthChange": false
        });

        var orderCount = 1;
        table.on( 'order.dt', function () {
            var order = dataTable.order();
            columns = dataTable.settings().init().columns;

            if (order[0] instanceof Array && orderCount !== 1) {
                AdminController.insertParam('sort', columns[order[0][0]].sName);
                AdminController.insertParam('dir', order[0][1]);
            }
            orderCount += 1;
        });
        table.on( 'page.dt', function () {
            var info = dataTable.page.info();
            AdminController.insertParam('page', info.page + 1);
        } );
        table.on( 'length.dt', function (e, settings, len) {
            console.log(len);
            AdminController.insertParam('length', len);
        } );
    });
</script>