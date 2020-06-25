

		
@extends('layouts.main')
@section('content')
<br><br><br>
<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                   <br><br><br><br><h3>Admin Area</h3>
                    <br><p> L'Authentification est Réservée Seulement Pour Les Administrateurs </p>
                    
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf
                       <div> <label for="login"> {{__('Login')}} </label>   
                         <input class="form-control" type="login" name="login" id="login" required> 
                       </div>
                       <div>
                        <label for="password"> {{__('Password')}} </label>
                        <input class="form-control" type="password" name="password" id="password" required>    
                       </div>
                        <div class="form-button">
                            <button  type="submit"  class="ibtn">Login</button> 
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

@endsection
