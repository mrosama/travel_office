<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
    <input type="hidden" id="baseurl" name="baseurl" value="{{url('/')}}" />
    <meta charset="utf-8" />
    <title>شركة نور البتول  @if(isset($page_title)) {{' | ' . $page_title}} @endif</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{URL::to('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5-rtl.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{URL::to('/')}}/assets/global/css/components-rounded-rtl.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{URL::to('/')}}/assets/global/plugins/bootstrap-select/css/bootstrap-select-rtl.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{URL::to('/')}}/assets/global/css/components-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL::to('/')}}/assets/global/css/plugins-rtl.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{URL::to('/')}}/assets/pages/css/invoice-2-rtl.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{URL::to('/')}}/assets/layouts/layout2/css/layout-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/')}}/assets/layouts/layout2/css/themes/blue-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{URL::to('/')}}/assets/layouts/layout2/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
    @yield('CssLinks')
    <style type="text/css">
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        body, h1, h2, h3, h4, h5, h6{
            font-family: 'Droid Arabic Kufi', sans-serif;
        }

        .modalDialog {
            position: fixed;
            font-family: Arial, Helvetica, sans-serif;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 99999;
            opacity:0;
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            pointer-events: none;
            direction: rtl;
            text-align: center;

        }
        .modalDialog:target {
            opacity:1;
            pointer-events: auto;
        }
        .modalDialog > div {
            width: 500px;
            position: relative;
            margin: 10% auto;
            padding: 5px 20px 13px 20px;
            border-radius: 4px;
            background: #fff;

        }
        .close-M {
            border-radius: 12px!important;
            background: #606061;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            -moz-box-shadow: 1px 1px 3px #000;
            -webkit-box-shadow: 1px 1px 3px #000;
            box-shadow: 1px 1px 3px #000;
            opacity: 1;
            font-size: 13px;
        }
        .close-M:hover {
            background: #00d9ff;
        }
        .log-info{
            font-family: 'Droid Arabic Kufi', sans-serif;
            padding:0px 0px 20px 0;
        }
    </style>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
    <input type="hidden" id="base_url" value="{{URL::to('/')}}">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index.html">
                    <img src="{{URL::to('/')}}/assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE ACTIONS -->
            <!-- DOC: Remove "hide" class to enable the page header actions -->
            <div class="page-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript:;">
                                <i class="icon-docs"></i> New Post </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-tag"></i> New Comment </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-share"></i> Share </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-flag"></i> Comments
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-users"></i> Feedbacks
                                <span class="badge badge-danger">2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE ACTIONS -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN HEADER SEARCH BOX -->
                <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="query">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END HEADER SEARCH BOX -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">



                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" onmouseover="changeNotificationsSeen()">
                                <i class="icon-bell"></i>
                                <span class="badge badge-default" id="notificationsCount1"> {{App\Notification::where('seen' , 0)->count()}} </span>
                            </a>
                            <ul class="dropdown-menu">



                                <li class="external">
                                    <h3>
                                        <span class="bold" id="notificationsCount2">{{App\Notification::where('seen' , 0)->count()}}</span> اشعارات</h3>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        @if(App\Notification::count() != 0)
                                        @foreach(App\Notification::orderBy('id' , 'desc')->get() as $notification)

                                        <?php
                                        $date1 = new DateTime(date_default_timezone_get());
                                        $date2 = new DateTime($notification->created_at);
                                        $interval = $date1->diff($date2);
                                        ?>
                                        <li>

                                            @if($notification->type == "meeting")
                                            <a href="{{URL::to('admin/meetings' , $notification->bill_id)}}" style="text-decoration: none;">
                                                @elseif($notification->type == "partner_bill")
                                                <a href="{{URL::to('admin/bills' , $notification->bill_id)}}" style="text-decoration: none;">
                                                    @endif

                                                    @if($interval->format("%d") > 0)
                                                    <span class="time">منذ {{$interval->format("%d يوم")}}</span>
                                                    @elseif($interval->format("%h") > 0)
                                                    <span class="time">منذ {{$interval->format("%h ساعة")}}</span>
                                                    @else
                                                    <span class="time">منذ {{$interval->format("%i دقيقة")}}</span>
                                                    @endif
                                                    <span class="details" style="font-family: 'Droid Arabic Kufi', sans-serif">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> {{$notification->message}} </span>
                                                </a>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="text-center" style="font-family: 'Droid Arabic Kufi', sans-serif"><a><b>لا يوجد اى اشعارات</b></a></li>
                                        @endif

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" onmouseover="changeMessagesSeen()">
                                <i class="icon-envelope-open"></i>
                                <span class="badge badge-default" id="messageCount1"> {{App\Message::where('seen' , 0)->count()}} </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>
                                        <span class="bold" id="messageCount2">{{App\Message::where('seen' , 0)->count()}}</span> رسائل</h3>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        @if(App\Message::count() != 0)
                                        @foreach(App\Message::orderBy('id' , 'desc')->get() as $message)

                                        <?php
                                        $date1 = new DateTime(date_default_timezone_get());
                                        $date2 = new DateTime($message->created_at);
                                        $interval = $date1->diff($date2);
                                        ?>
                                        <li>

                                            @if($message->type == "advertise")
                                            <a href="{{URL::to('admin/advertisements' , $message->message_id)}}" style="text-decoration: none;">
                                                @endif
                                                @if($interval->format("%d") > 0)
                                                <span class="time">منذ {{$interval->format("%d يوم")}}</span>
                                                @elseif($interval->format("%h") > 0)
                                                <span class="time">منذ {{$interval->format("%h ساعة")}}</span>
                                                @else
                                                <span class="time">منذ {{$interval->format("%i دقيقة")}}</span>
                                                @endif
                                                <span class="details" style="font-family: 'Droid Arabic Kufi', sans-serif">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span> {{$message->message}} </span>
                                            </a>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="text-center" style="font-family: 'Droid Arabic Kufi', sans-serif"><a><b>لا يوجد اى رسائل</b></a></li>
                                        @endif

                                    </ul>
                                </li>



                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>

                            </a>
                            <ul class="dropdown-menu extended tasks">
                                <!-- <li style="margin-right:25px;margin-top:35px;">
                                        <iframe name="prayertimes" src="http://timesprayer.com/widgets.php?name=cairo.html&amp;frame=3&amp;lang=ar&amp;sound=true&amp;avachang=false" width="215"  height="280" style="border: none;" scrolling="no"></iframe>
                                </li> -->
                            </ul>
                        </li>
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{URL::to('/')}}/assets/layouts/layout2/img/avatar3_small.jpg" />
                                <span class="username username-hide-on-mobile"> Nick </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="page_user_profile_1.html">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="app_calendar.html">
                                        <i class="icon-calendar"></i> My Calendar </a>
                                </li>
                                <li>
                                    <a href="app_inbox.html">
                                        <i class="icon-envelope-open"></i> My Inbox
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="app_todo_2.html">
                                        <i class="icon-rocket"></i> My Tasks
                                        <span class="badge badge-success"> 7 </span>
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="page_user_lock_1.html">
                                        <i class="icon-lock"></i> Lock Screen </a>
                                </li>
                                <li>
                                    <!--<a href="page_user_login_1.html">
                                        <i class="icon-key"></i> Log Out </a>-->
   <a href="{{url('admin/logout')}}"> <i class="icon-key"></i> Log Out </a>

                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte-->

                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
