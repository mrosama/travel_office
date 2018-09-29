<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title> شركة نور البتول</title>

    <!-- Bootstrap -->
       <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/signin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/signin/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />

   <style type="text/css">
        @import url('http://fonts.googleapis.com/css?family=RobotoDraft:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en');
        @font-face {
          font-family: Droid Arabic Kufi;
          src: url(/css/app/fonts/fonts/DroidKufi-Regular.ttf);
      }
      body,h1,h2,h3,p{
          font-family: 'Droid Arabic Kufi';
      }
      .login-content {
           font-family: 'Droid Arabic Kufi';
      }
  </style>
  </head>
  <body>
     <br> <br> <br>
 
      
<div class="panel panel-default login-content" style="width:50%;margin:0 auto;">
  <div class="panel-heading" style="text-align:right">لوحة تسجيل الدخول </div>
  <div class="panel-body">
        @if(session()->has('error'))
 <div style="margin:0 auto;" class="alert alert-danger login-content" role="alert">خطأ في تسجيل الدخول</div>
                      @endif
                      <br> <br>
 {!! Form::open(array('id'=>'formsingin', 'url' => 'admin/processlogin','method'=>'post','class'=>'form-signin' ,'autocomplete'=>'off')) !!}
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" placeholder="اسم المستخدم" class="form-control login-username" id="login_card_number" name="email" /> </div>
                                <div class="col-xs-6">
                                    <input type="password" placeholder="الباسوورد" class="form-control login-password" id="login_code_number" name="password" /> </div>
                                </div>
                                <div class="row">
                                    <center style="margin-bottom:15px">
                                      <font id="error" color="red" ></font>
                                      <font id="redirect" color="green" ></font>
                                  </center>
                                  <div class="col-sm-4">

                                  </div>
                                  <div class="col-sm-8 text-right">
                                    <div class="forgot-password">
                                    </div>
                                    
                                    <button class="btn blue" type="submit" id="login">دخول</button>
                                </div>
                            </div>
                       <!-- </form>-->{!! Form::close() !!}
  </div>
</div>
<script src="{{URL::to('/')}}/signin/js/jquery.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/signin/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>