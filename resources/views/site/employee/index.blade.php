@extends('layouts.components')

@section('content')
<div class="container">
    <div class="row">
        <a href="/{{$module}}/create" class="btn btn-primary" title="add new"><i class="fa fa-plus"></i>Add</a>
    </div>
    <table id="employee_table">
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
            var table = $('#employee_table').DataTable({
                "columns": [
                    {title: 'ID',data: 'id', name: 'id'},
                    {title: 'Name',data: 'name', name: 'name'},
                    {title: 'Company', data: 'company', name: 'company'},
                    {title: 'Email', data: 'email', name: 'email'},
                    {title: 'Phone', data: 'phone', name: 'phone'},
                    {title: 'Actions'}
                ],
                "processing": true,
                "serverSide": false,
                "order": [],
                "bDestroy": true,
                stateSave: true,
                "ajax" : '/{{$module}}/data',
                "columnDefs": [
                    {
                        "targets": -1,
                        "data": null,
                        "defaultContent": '<a href="javascript:void(0);" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="javascript:void(0);" class="delete" ><i class="fa fa-times" aria-hidden="true"></i></a>'
                    }
                ]
            });
        $('#employee_table tbody').on('click', 'a', function() {
                let data    = table.row( $(this).parents('tr') ).data();
                let id      = data.id;  
                location.href  = '/{{$module}}/'+id + '/edit';
            })
        $('#employee_table tbody').on('click', '.delete', function() {
            let data  = table.row($(this).parents('tr')).data();
            let id      = data.id;  
            $('#delete_form').attr('action', '/{{$module}}/'+id);
            $('#delete_form').submit(); 
        })
        })
    </script>
@endpush

@endsection
