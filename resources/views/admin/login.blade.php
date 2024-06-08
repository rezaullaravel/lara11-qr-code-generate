<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Admin Login</title>

    <style>
        .alldiv {
            background: #f9f6f6;
            overflow: hidden;
            padding-bottom: 10rem;
        }
    </style>
</head>
<body>


  <div class="container alldiv mt-3">

     <div class="row" style="margin-top:6rem;">
        <div class="col-sm-4 offset-sm-4">
            <h4 class="text-center">Admin Panel</h4>
            <div class="card">
                @if (session('message'))
                   <div class="alert alert-danger">
                     <p class="text-center">{{ Session::get('message') }}</p>
                   </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                         <div class="form-group">
                            <label>Email <span class="text-danger">*</span> </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email address....">
                            @error('email')
                              <span class="text-danger text-center">{{ $message }}</span>
                            @enderror
                         </div>

                         <div class="form-group">
                            <label>Password <span class="text-danger">*</span> </label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter password....">
                            @error('password')
                              <span class="text-danger text-center">{{ $message }}</span>
                            @enderror
                         </div>
                        <input type="submit" value="Login" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
     </div>
  </div>
</body>
</html>
