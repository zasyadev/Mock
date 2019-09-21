@extends('layouts.components')

@section('content')
<div class="container">
    <div class="row">
        <a href="/{{$type}}/create" class="btn btn-primary" title="add new"><i class="fa fa-plus"></i>Add</a>
    </div>
    <table id="company_table">
        <thead>
            <!-- <tr>Id</tr>
            <tr>Name</tr>
            <tr>Email</tr>
            <tr>Actions</tr> -->
        </thead>
        <tbody>
        </tbody>
    </table>

    <form action="" method="POST" type="_hidden" id="delete_form">
    {{ csrf_field() }}
        @method('DELETE')
    </form>
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(() => {
            var table = $('#company_table').DataTable({
                "columns": [
                    {title: 'ID',data: 'id', name: 'id'},
                    {title: 'Name',data: 'name', name: 'name'},
                    {title: 'Email', data: 'email', name: 'email'},
                    {title: 'Actions'}
                ],
                "processing": true,
                "serverSide": false,
                "order": [],
                "bDestroy": true,
                stateSave: true,
                "ajax" : '/{{$type}}/data',
                "columnDefs": [
                    {
                        "targets": -1,
                        "data": null,
                        "defaultContent": '<a href="javascript:void(0);" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" class="delete" ><i class="fa fa-times" aria-hidden="true"></i></a>'
                    }
                ]
            });
        $('#company_table tbody').on('click', '.edit', function() {
                let data    = table.row( $(this).parents('tr') ).data();
                let id      = data.id;  
                location.href  = '/{{$type}}/'+id + '/edit';
            })
        $('#company_table tbody').on('click', '.delete', function() {
            let data  = table.row($(this).parents('tr')).data();
            let id      = data.id;  
            // var form = document.querySelectorAll('#delete_form');
            $('#delete_form').attr('action', '/{{$type}}/'+id);
            $('#delete_form').submit();
        })
        })
    </script>
@endpush

@endsection
