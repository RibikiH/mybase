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
        $('#table-main').DataTable({
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
            "columnDefs": [{
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
            ]
        });
    });
</script>