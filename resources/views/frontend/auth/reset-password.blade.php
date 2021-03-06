<!DOCTYPE html>
<html class="login_page">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= config('app.name') ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  {!! AssetHelper::loadAdminAsset(1) !!}

</head>
<body>

<div class="container sm">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <h1><?= config('app.name') ?> - Login</h1>
  {!! Form::open(['url' => route('frontend.reset-password'), 'method' => 'POST', 'id' => 'reset-form', 'class' => 'form']) !!}
  <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group icon">
      {!! Form::text('email', $email,['class' => 'form-control', 'placeholder' => 'Email'] ) !!}
      <i class="fa fa-user-o"></i>
    </div>
    <div class="form-group icon">
      {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password'] ) !!}
      <i class="fa fa-lock"></i>
    </div>
    <div class="form-group icon">
      {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password'] ) !!}
      <i class="fa fa-lock"></i>
    </div>
    <div class="form-group action mb0">
      {{ Form::button('Reset Password <i class="fa fa-angle-right"></i>', ['type' => 'submit', 'class' => 'btn full'] )  }}
    </div>
  {!! Form::close() !!}  
</div> <!--container-->

<!-- JS -->
{!! JsValidator::formRequest('App\Http\Requests\Admin\ResetPasswordRequest', '#reset-form') !!}

{!! AssetHelper::loadAdminAsset() !!}

</body>
</html>
