@extends('admin.layouts.app')

@section('title')
لوحة التحكم
@endsection

@section('content')
<br>
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Contacts App- View Contact-->
                <div class="row">
                    <!--begin::Content-->
                    <div class="col-xl-12">
                        <!--begin::Contacts-->
                        <div class="card card-flush h-lg-100" id="kt_contacts_main">
                            <!--begin::Card body-->
                            <div class="card-body pt-5">

                                <!--begin:Form-->
                                <h1 class="text-warning">Hello Oday Muammer</h1>
                                <!--end::Form-->

                            </div>
                            <!--end::Card body-->
                                <a  class="btn btn-warning w-25" href="{{route('admin.cities.create')}}"> اضافة مدينة</a>
                            <br>

                                <a  class="btn btn-danger w-25" href="{{ route('admin.ambulances.create') }}"> اضافة اسعاف</a>
                            <br>
                                <a  class="btn btn-primary w-25" href="{{ route('admin.hospitals.create') }}"> اضافة مشفى</a>
                            <br>
                                <a  class="btn btn-success w-25" href="{{ route('admin.laboratories.create') }}"> اضافة مختبر</a>
                            <br>
                                <a  class="btn btn-google w-25" href="{{ route('admin.majors.create') }}"> اضافة تخصص</a>
                            <br>
                                <a style="position: relative; right: 454px; bottom: 316px;" class="btn btn-info w-25" href="{{ route('admin.doctors.create') }}"> اضافة طبيب</a>
                            <br>
                                <a style="position: relative; right: 454px; bottom: 316px;" class="btn btn-light w-25 href="{{ route('admin.categories.create') }}"> اضافة فئة</a>
                            <br>
                                <a style="position: relative; right: 454px; bottom: 316px;" class="btn btn-dark w-25" href="{{ route('admin.articles.create') }}"> اضافة مقالة</a>
                            <br>
                                <a style="position: relative; right: 454px; bottom: 316px;" class="btn btn-danger w-25" href="{{ route('admin.settings.create') }}"> اضافة اعدادات</a>
                             <br>
                                <a style="position: relative; right: 454px; bottom: 316px;" class="btn btn-info w-25" href="{{ route('admin.admins.create') }}"> اضافة ادمن</a>



                            {{--                                <a  class="btn btn-danger" href="{{ route('admin.proceses_log.index')}}">العمليات</a>--}}
                        </div>
                        <!--end::Contacts-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Contacts App- View Contact-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
