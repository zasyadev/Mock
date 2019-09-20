@extends('layouts.components')

@section('content')
<div class="container">
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
                "serverSide": true,
                "order": [],
                "bDestroy": true,
                stateSave: true,
                "ajax" : '/company/data',
                "columnDefs": [
                    {
                        "targets": -1,
                        "data": null,
                        "defaultContent": '<a href="javascript:void(0);" class="edit"><i class="fa fa-pencil"></i>edit</a>&nbsp;<a href="javascript:void(0);" class="delete" <i class="fa fa-pencil"></i>del</a>'
                    }
                ]
            });
        $('#company_table tbody').on('click', 'a', () => {
                var data = table.row( $(this).parents('tr') ).data();
                console.log(data)  
            })
        $('#company_table tbody').on('click', '.delete', () => {
            let data  = table.row($(this).parents('tr')).data();
            console.log(data)  
        })
        })
    </script>
@endpush

@endsection
