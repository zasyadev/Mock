@if ( isset($type) && $type == 'update')
<form class="form" method="post" action="/{{$module}}/{{$employee->id}}">
{{ method_field('PUT') }}
@else
<form class="form" method="post" action="/{{$module}}">
@endif
{{ csrf_field() }}
    <div class="form-group">
        <label for="name">First Name</label>
        <input type="text" class="form-control" id="name" name="first_name"  placeholder="First Name" @if(isset($employee) &&  !is_null($employee)) value="{{$employee->first_name}}" @else value="{{old('first_name')}}" @endif required>
    </div>
    <div class="form-group">
        <label for="name">Last Name</label>
        <input type="text" class="form-control" id="name" name="last_name"  placeholder="Last Name" @if(isset($employee) &&  !is_null($employee)) value="{{$employee->last_name}}" @else value="{{old('last_name')}}" @endif required>
    </div>
    <div class="form-group">        
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" @if( isset($employee) && !is_null($employee)) value="{{$employee->email}}" @else value="{{old('email')}}" @endif placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="companies">Select Company</label>
        <select class="form-control" id="companies" name="company_id" required>
            <option value="0">Select</option>
            @foreach( $companies as $company )
                <option value={{$company->id}} @if(isset($employee) && $company->id == $employee->company_id) selected @endif>{{$company->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">        
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone"  name="phone" @if( isset($employee) && !is_null($employee)) value="{{$employee->phone}}" @else value="{{old('phone')}}" @endif placeholder="000-000-0000"  required>
    </div>
  <button type="submit" class="btn btn-primary">{{ $type == 'update' ? 'Update' : 'Submit' }}</button>
</form>