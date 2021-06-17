<script type="text/javascript">
    $(function(){
        $('.dataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route($route.".datatables") !!}',
            columns: [
                {data: 'no', searchable: false, width: '5%', className: 'center'},
                {data: 'username'},
                {data: 'name'},
                {data: 'role'},
                {data: 'status'},
                {data: 'action', orderable: false, searchable: false, width: '15%', className: 'center action'},
            ],
            drawCallback: function () {
                APP.run();
            }
        });
    });

    $(document).on('change', '.change-status', function () {
        let id = $(this).data('id');
        $.ajax({
            url: '{!! route($route.".changeStatus") !!}',
            data: {
                'id': id
            },
            method: 'POST',
            error: function (e) {
                console.log(e);
            },
        });

    });
</script>
