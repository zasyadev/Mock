@if ( isset($type) && $type == 'update')
<form class="form" method="post" action="/company/{{$company->id}}" enctype="multipart/form-data">
{{ method_field('PUT') }}
@else
<form class="form" method="post" action="/company" enctype="multipart/form-data">
@endif
{{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" class="form-control" id="name" name="name"  placeholder="Name" @if(isset($company) &&  !is_null($company)) value="{{$company->name}}" @else value="{{old('name')}}" @endif required>
    </div>
    <div class="form-group">        
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" @if( isset($company) && !is_null($company)) value="{{$company->email}}" @else value="{{old('email')}}" @endif placeholder="Enter email" required>
    </div>
    @if (isset($company) &&  !is_null($company) && isset($company->logo)) 
    <div class="form-group"> 
        <img src="{{asset('storage/logos/'.$company->logo)}}"  alt="{{ $company->logo }}" height="200"/>
    </div>    
    @endif
    <div class="form-group">        
        <label for="file_upload">Upload logo</label>
        <input type="file" class="form-control" id="file_upload" name="logo" />
    </div>
  <button type="submit" class="btn btn-primary">{{ $type == 'update' ? 'Update' : 'Submit' }}</button>
</form>