<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Admin Password Change</title>

    <style>
        .alldiv {
            background: #f9f6f6;
            overflow: hidden;
            padding-bottom: 10rem;
        }

        .center {

        margin:0 auto;

      }
    </style>
</head>
<body>


  <div class="container alldiv mt-3">

     <div class="row" style="margin-top:6rem;">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">
              <div class="card-header">
                <h4 class="text-center">Change Password
                    <a href="{{ url('/') }}" class="btn btn-info" style="float: right;">Back</a>
                </h4>
              </div>
                <div class="card-body">
                    <form action="{{ route('admin.password.update') }}" method="post">
                        @csrf


                         <div class="form-group">
                            <label>Password <span class="text-danger">*</span> </label>
                            <input type="text" name="password"  class="form-control" placeholder="Enter password...." required>
                            <p class="text-danger">If you want to change your password please enter new passord...</p>

                         </div>
                        <input type="submit" value="Submit" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
     </div>
  </div>
</body>
</html>
