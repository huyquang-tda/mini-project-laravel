<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <br><br>
    <div class="row">
        <div class="jumbotron col-lg-4 offset-lg-4">
            <h3 class="text-center"> Reset Password</h3>
                <form  action="{{route('reset')}}" method="POST">
                    <div class="form-group">
                        <label>Email Address</label> <p class="text-danger d-inline"> * </p>
                        <input type="email" class="form-control" name="email" value="{{request()->get('email')}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label> <p class="text-danger d-inline"> * </p>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password">
                    </div>
                    <div class="form-group"> 
                        <label>Password Confirmation</label> <p class="text-danger d-inline"> * </p>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
                    </div>
                    <input hidden name="token" placeholder="token" value="{{request()->get('token')}}">
        
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
        </div>        
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>