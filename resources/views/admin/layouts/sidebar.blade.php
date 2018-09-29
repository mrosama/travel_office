<style type="text/css">
    hr{margin:5px 0 ;}
</style>
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-user-secret"></i>
                <span class="title">المدراء</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/admins/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/admins')}}" class="nav-link ">
                        <span class="title"> عرض </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-users"></i>
                <span class="title">العملاء</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/clients/create/first')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <!--                <li class="nav-item  ">
                                    <a href="{{url('admin/clients/create')}}" class="nav-link ">
                                        <span class="title"> اضافة</span>
                                    </a>
                                </li>-->
                <li class="nav-item  ">
                    <a href="{{url('admin/clients')}}" class="nav-link ">
                        <span class="title">عرض </span>
                    </a>
                </li>
                <hr>
                <li class="nav-item  ">
                    <a href="{{url('admin/clients/show/families')}}" class="nav-link ">
                        <span class="title">العائلة </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title"> طلبات العملاء</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/clients_orders/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/clients_orders')}}" class="nav-link ">
                        <span class="title">عرض </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title"> انواع  طلبات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <!-- 				<li class="nav-item  ">
                        <a href="{{url('admin/orders_types/create')}}" class="nav-link ">
                                <span class="title"> اضافة</span>
                        </a>
                </li> -->
                <li class="nav-item  ">
                    <a href="{{url('admin/orders_types')}}" class="nav-link ">
                        <span class="title">عرض </span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <span class="title">الاجتماعات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/meetings/create')}}" class="nav-link ">
                        <span class="title">اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/meetings')}}" class="nav-link ">
                        <span class="title">عرض</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/meeting_places')}}" class="nav-link ">
                        <span class="title">اماكن الاجتماعات</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/meeting_types')}}" class="nav-link ">
                        <span class="title">انواع الاجتماعات</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/meetings/send/emails')}}" class="nav-link ">
                        <span class="title">ارسال بريد الكترونى</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">مستودع النماذج</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/warehouse_template/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/warehouse_template')}}" class="nav-link ">
                        <span class="title">عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">وسائل النقل</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/transportations/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/transportations')}}" class="nav-link ">
                        <span class="title">عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">وسائل المواصلات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/transport_type/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/transport_type')}}" class="nav-link ">
                        <span class="title">عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-suitcase"></i>
                <span class="title">المكاتب السياحية والدينية</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_offices/create')}}" class="nav-link ">
                        <span class="title"> اضافة مكتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_offices')}}" class="nav-link ">
                        <span class="title">عرض المكاتب</span>
                    </a>
                </li>

                <li class="nav-item  ">
                    <a href="{{url('admin/travel_sections/create')}}" class="nav-link ">
                        <span class="title"> اضافة قسم للمكتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_sections')}}" class="nav-link ">
                        <span class="title">عرض اقسام المكاتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_employees/create')}}" class="nav-link ">
                        <span class="title"> اضافة موظف للمكتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_employees')}}" class="nav-link ">
                        <span class="title">عرض موظفين المكاتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_orders/create')}}" class="nav-link ">
                        <span class="title"> اضافة طلب للمكتب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/travel_orders')}}" class="nav-link ">
                        <span class="title">عرض طلبات المكاتب</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-bus" aria-hidden="true"></i>
                <span class="title">الرحلات السياحية بالباصات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">الباصات</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/create')}}" class="nav-link ">
                                <span class="title"> اضافة باص</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses')}}" class="nav-link ">
                                <span class="title"> عرض الباصات</span>
                            </a>
                        </li>

                        <li class="nav-item  ">
                            <a href="{{url('admin/busStops/create')}}" class="nav-link ">
                                <span class="title"> اضافة موقف باصات</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busStops')}}" class="nav-link ">
                                <span class="title"> عرض مواقف الباصات</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">حجز الباصات</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/reservations/create')}}" class="nav-link ">
                                <span class="title"> اضافة حجز</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/reservations')}}" class="nav-link ">
                                <span class="title"> عرض الباصات المحجوزة</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">فروع مزودين الباصات</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/branches/create')}}" class="nav-link ">
                                <span class="title"> اضافة فرع</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/branches')}}" class="nav-link ">
                                <span class="title"> عرض الفروع </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">مزودين الباصات</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/suppliers/create')}}" class="nav-link ">
                                <span class="title"> اضافة مزود</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/suppliers')}}" class="nav-link ">
                                <span class="title"> عرض المزودين</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/suppliers/send/emails')}}" class="nav-link ">
                                <span class="title"> ارسال بريد الكترونى</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">تسليم الباص للسائق</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/Handings/create')}}" class="nav-link ">
                                <span class="title"> اضافة </span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/busses/Handings')}}" class="nav-link ">
                                <span class="title"> عرض </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">السائقين</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('admin/drivers/create')}}" class="nav-link ">
                                <span class="title"> اضافة سائق</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('admin/drivers')}}" class="nav-link ">
                                <span class="title"> عرض السائقين</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">المشرفين </span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <a href="{{url('admin/supervisors/create')}}" class="nav-link ">
                            <li class="nav-item  ">
                                <span class="title"> اضافة  مشرف</span>
                        </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/supervisors')}}" class="nav-link ">
                        <span class="title"> عرض  المشرفين</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">البرامج السياحية</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/tourist/programmes/create')}}" class="nav-link ">
                        <span class="title"> اضافة برنامج سياحى</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/tourist/programmes')}}" class="nav-link ">
                        <span class="title"> عرض البرامج السياحية</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">حجز و طلب رحلة سياحية</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/flight/reservations/create')}}" class="nav-link ">
                        <span class="title"> اضافة طلب</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/flight/reservations')}}" class="nav-link ">
                        <span class="title"> عرض الطلبات</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>



<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-university"></i>
        <span class="title">المؤسسات والشركات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/company/create')}}" class="nav-link ">
                <span class="title"> اضافة مؤسسة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/company')}}" class="nav-link ">
                <span class="title">عرض المؤسسات  </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/companySection/create')}}" class="nav-link ">
                <span class="title"> اضافة قسم  للمؤسسة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/companySection')}}" class="nav-link ">
                <span class="title">عرض اقسام المؤسسات </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/companyEmployee/create')}}" class="nav-link ">
                <span class="title"> اضافة موظف  للمؤسسة  </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/companyEmployee')}}" class="nav-link ">
                <span class="title">عرض موظفين المؤسسات  </span>
            </a>
        </li>

        <li class="nav-item  ">
            <a href="{{url('admin/companyOrder/create')}}" class="nav-link ">
                <span class="title"> اضافة طلب  للمؤسسة  </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/companyOrder')}}" class="nav-link ">
                <span class="title">عرض طلبات المؤسسات  </span>
            </a>
        </li>
    </ul>
</li>






<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-suitcase"></i>
        <span class="title">المكاتب</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/offices/create')}}" class="nav-link ">
                <span class="title"> اضافة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/offices')}}" class="nav-link ">
                <span class="title">عرض</span>
            </a>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الموظفين</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/employee/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/employee')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>

        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الرواتب</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/salaries/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/salaries')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</li>


<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">الدول</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/country/create')}}" class="nav-link ">
                <span class="title"> اضافة دولة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/country')}}" class="nav-link ">
                <span class="title">عرض  الدول</span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">المدن</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/city/create')}}" class="nav-link ">
                <span class="title"> اضافة مدينة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/city')}}" class="nav-link ">
                <span class="title">عرض  المدن</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user-plus"></i>
        <span class="title">الشركاء</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">

        <li class="nav-item  ">
            <a href="{{url('admin/partners/create')}}" class="nav-link ">
                <span class="title"> اضافة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/partners')}}" class="nav-link ">
                <span class="title">عرض</span>
            </a>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">انواع الشركاء</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/partner_types/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/partner_types')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الفواتير</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/bills/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/bills')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الحسابات البنكية</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/banking/accounts/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/banking/accounts')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الموظفين</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item ">
                    <a href="{{url('admin/employees/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/employees')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
                <hr>
                <li class="nav-item ">
                    <a href="{{url('admin/employee_vacations/create')}}" class="nav-link ">
                        <span class="title"> اضافة طلب اجازة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/employee_vacations')}}" class="nav-link ">
                        <span class="title"> عرض طلبات الاجازة</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">انواع طبيعة العمل</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item ">
                    <a href="{{url('admin/nature_work/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/nature_work')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">انواع الاجازات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">

            <a href="{{url('admin/vacation_types/create')}}" class="nav-link ">
                <span class="title">  اضافة نوع</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/vacation_types')}}" class="nav-link ">
                <span class="title">عرض الانواع</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">الفواتير</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">

            <a href="{{url('admin/bill/create')}}" class="nav-link ">
                <span class="title"> انشاء فاتورة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/bill')}}" class="nav-link ">
                <span class="title">عرض الفواتير</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span class="title">الايرادات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">

        <li class="nav-item  ">
            <a href="{{url('admin/income/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/income')}}" class="nav-link ">
                <span class="title"> عرض </span>
            </a>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">انواع الايرادات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/income/types/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/income/types')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">المصروفات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">انواع الصرف</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/exchangeType/create')}}" class="nav-link ">
                        <span class="title"> اضافة نوع</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/exchangeType')}}" class="nav-link ">
                        <span class="title"> عرض الانواع</span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="nav-item  ">
            <a href="{{url('admin/expenses/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/expenses')}}" class="nav-link ">
                <span class="title"> عرض </span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">انواع الرحلات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">

            <a href="{{url('admin/trips/create')}}" class="nav-link ">
                <span class="title">  اضافة رحلة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/trips')}}" class="nav-link ">
                <span class="title">عرض الرحلات</span>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">روابط / مواقع مفيدة</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/useful_link/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/useful_link')}}" class="nav-link ">
                <span class="title">عرض </span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">المعاملات الحكومية و الخاصة</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu">

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">انواع المعاملات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/transactions/types/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/transactions/types')}}" class="nav-link ">
                        <span class="title"> عرض </span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item  ">
            <a href="{{url('admin/transactions/create')}}" class="nav-link ">
                <span class="title"> اضافة</span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/transactions')}}" class="nav-link ">
                <span class="title">عرض</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-info" aria-hidden="true"></i>
        <span class="title">المعلومات الخاصة و العامة</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/instructions/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/instructions')}}" class="nav-link ">
                <span class="title">عرض </span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">الاعلانات و البنرات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/advertisements/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/advertisements')}}" class="nav-link ">
                <span class="title">عرض </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/designer_advertising')}}" class="nav-link ">
                <span class="title">مصمم الاعلان </span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">الفيزا و التأشيرات</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/visas/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/visas')}}" class="nav-link ">
                <span class="title">عرض </span>
            </a>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">السفارات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/embassies/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/embassies')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الفروع</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/embassy/branches/create')}}" class="nav-link ">
                        <span class="title"> اضافة</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/embassy/branches')}}" class="nav-link ">
                        <span class="title"> عرض</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">الدورات و المعاهد</span>
        <span class="arrow"></span>
    </a>

    <ul class="sub-menu">

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">الدورات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/courses/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/courses')}}" class="nav-link ">
                        <span class="title"> عرض </span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <span class="title">المعاهد/الكليات/الجامعات</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('admin/institutes/create')}}" class="nav-link ">
                        <span class="title"> اضافة </span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('admin/institutes')}}" class="nav-link ">
                        <span class="title"> عرض </span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>


<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">بيانات الدخول الى المواقع</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{url('admin/loginSite/create')}}" class="nav-link ">
                <span class="title"> اضافة </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{url('admin/loginSite')}}" class="nav-link ">
                <span class="title"> عرض </span>
            </a>
        </li>
    </ul>
</li>




</ul>


<!-- END SIDEBAR MENU -->
</div>
