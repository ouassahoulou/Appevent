@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
       <i class="icon_box-checked">   </i>{{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <i class="icon_error-triangle">   </i> {{session('error')}}
    </div>
@endif