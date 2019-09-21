@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade in " role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times; &nbsp&nbsp&nbsp&nbsp</span>

        </button>
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="custom_alert alert alert-danger alert-dismissible fade in " role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times; &nbsp&nbsp&nbsp&nbsp</span>

        </button>
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade in " role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times; &nbsp&nbsp&nbsp&nbsp</span>
        </button>
        {{ session('success') }}
    </div>
@endif


 