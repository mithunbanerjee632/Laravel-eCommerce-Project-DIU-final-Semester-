<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Vendor Login</title>
  </head>


     <body>
       <div class="container">
         <div class="row">
           <div class="col-md-3"></div>
           <div class="col-md-6">
             <div class="card mt-5">
               <div class="card card-header">
                  <h2 class="text-center mt-5">Vendor Login</h2>
                </div>
                <div class="card-body">
            
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


          
            @if(Session::has('error-msg'))
            
                <p class="text-danger">{{Session::get('error-msg')}}</p>
                @endif
          
                <form action="{{url('/vendor/loginForm')}}" method="post" >
                    @csrf
                    <div class="mb-3">
                      <label  class="form-label ">Email address</label>
                      <input type="email" name="email" class="form-control" >
                      
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" >
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
            </form>
            </div>
           </div>
         </div>
   </div>
</div>

  

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>