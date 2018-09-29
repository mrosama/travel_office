
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Travel Mart</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/signin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/signin/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <link href="{{URL::to('/')}}/signin/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{URL::to('/')}}/signin/css/login-5-rtl.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <style type="text/css">
        @import url('http://fonts.googleapis.com/css?family=RobotoDraft:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en');
        @font-face {
          font-family: Droid Arabic Kufi;
          src: url(/css/app/fonts/fonts/DroidKufi-Regular.ttf);
      }
      body,h1,h2,h3,p{
          font-family: 'Droid Arabic Kufi';
      }
  </style>

  <body class="login">
      <input type="hidden" id="base_url" value="{{URL::to('/')}}">

      <!-- BEGIN : LOGIN PAGE 5-2 -->
      <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 login-container bs-reset">
                {{-- <img class="login-logo login-6" src="../assets/pages/img/login/login-invert.png" /> --}}
                <div class="login-content">
                    <h1>لوحة تسجيل الدخول</h1>
                    <p> اضرب في أرجاء الدنيا سافر حيث شئت.. سترى أشياء كثيرةٌ في العالم تغنيك.. تفتح أمامك أفاقاً لم تكن تخطر لك على بال كل هذا يجددك.</p>
                    <form action="javascript:;" class="login-form">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" placeholder="اسم المستخدم" class="form-control login-username" id="login_card_number" name="card_number" /> </div>
                                <div class="col-xs-6">
                                    <input type="password" placeholder="الباسوورد" class="form-control login-password" id="login_code_number" name="code_number" /> </div>
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
                                    <button class="btn blue" type="button" id="login">دخول</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-4 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-8 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>جميع الحقوق محفوظة &copy; <a href="https://www.facebook.com/engabcd" target="_blank">Mohamed Emad _theJeeky</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bs-reset">
                    <div class="login-bg"> </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{URL::to('/')}}/signin/js/jquery.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/signin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::to('/')}}/signin/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/signin/js/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{URL::to('/')}}/signin/js/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{URL::to('/')}}/signin/js/login-5.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{URL::to('/')}}/css/site/all_js.js"></script>

</body>


</html>