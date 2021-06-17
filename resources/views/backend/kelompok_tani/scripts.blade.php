<script type="text/javascript">
    $(function(){
        $('.dataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route($route.".datatables") !!}',
            columns: [
                {data: 'no', searchable: false, width: '5%', className: 'center'},
                {data: 'name'},
                {data: 'action', orderable: false, searchable: false, width: '15%', className: 'center action'},
            ],
            drawCallback: function () {
                APP.run();
            }
        });
    });
</script>
