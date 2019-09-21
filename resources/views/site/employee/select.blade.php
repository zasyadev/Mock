@extends('layouts.components')

@section('content')
<div class="container">
    @if ($type == 'update')
        @include('site.employee.form',[ 'employee' => $employee ])
    @else 
        @include('site.employee.form')
    @endif 
</div>
@push('js')
    <script type="text/javascript">
    </script>
@endpush

@endsection
