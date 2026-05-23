@extends('layouts.master')
@section('title','Contact')

@push('css')

@endpush

@section('content')

<!--Eco Template Banner-->
<div class="eco_banner eco_inner_page_banner">
    <!--Eco Template Banner img-->
    <div class="eco_headings">
    </div>

</div>
<!--Eco Template Banner ends-->

<!--Eco Template content-->
<div class="content">

    <section>
        <div class="container">
            <div class="eco_contact_form">
                <div class="row">
                    <div class="col-md-8 no-padding col-sm-12 responsive-991-width">
                        <form>
                            <div class="your-submit-message">
                                <h5 class="eco_sm_titles">أرسل لنا رسالة</h5>
                                <div class="writeing-felid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" placeholder="أدخل الاسم" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" placeholder="البريد الإلكتروني" />
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="الموضوع" />
                                        </div>
                                        <div class="col-md-12">
                                            <textarea placeholder="نص الرسالة"></textarea>
                                        </div>
                                    </div>
                                    <button class="btn-small xsmall-btn">أرسل</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 no-padding col-sm-12 responsive-991-width">
                        <div class="eco_detail_address">
                            <h5 class="eco_sm_titles">معلومات التواصل</h5>

                            <ul class="eco_admin_info">

                                <li><i class="fa fa-phone" aria-hidden="true"></i><p>32 07 06 00 6 212+</p></li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i><p>info@balsam.com </p></li>
                            </ul>
                            <h5 class="eco_sm_titles">حسابات التواصل الاجتماعي</h5>
                            <ul class="social-icons">
                                <li><a href="https://facebook.com/BalsamAutisme/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<!--Eco content ends-->



@endsection

@push('js')

@endpush


