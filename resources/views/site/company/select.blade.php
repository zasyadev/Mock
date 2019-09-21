@extends('layouts.components')

@section('content')
<div class="container">
    @if ($type == 'update')
        @include('site.company.form',[ 'company' => $company ])
    @else 
        @include('site.company.form')
    @endif 
</div>
@push('js')
    <script type="text/javascript">
    </script>
@endpush

@endsection
