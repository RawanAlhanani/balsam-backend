@extends('layouts.master')
@section('title','Clubmeet')

@push('css')

@endpush

@section('content')


<div class="eco_banner eco_inner_page_banner">
    <!--Eco Template Banner img-->
    <div class="eco_headings">
    </div>

</div>
<!--Eco Template Banner ends-->

<!--Eco Template content-->
<div class="content">
    <section>
        <div class="eco_blog_detail">

            <div class="container">
                <div class="row">

                    <div class="col-md-9 col-sm-12 col-xs-12 responsive-991-width">
                        <!--Eco Template section-->
                        <div class="eco_blog_detail_post">
                            <figure>

                                     <img class="img-responsive cimage" src="content/upload/reports/icon1.png" alt="Photo">


                            </figure>
                            <div class="eco_blog_detail_content">
                                    <!--
                                    <p><strong>لمحة عن المشروع: </strong></p>
                                    <p>بسبب دخول أكثر من 200 حالة اسعافية شهريا إلى تركيا ,منظومة تتبع الإسعاف التي أنشأناها و المكونة من كوادر طبية ,مترجمين,وسائقين تقوم بتقديم الخدمات لهؤلاء المرضى</p>
                                    <p><strong>خدمات المشروع:</strong></p>
                                    <ul>
                                        <li>تحديد المشافي التي نقل اليها المرضى</li>
                                        <li>تقديم خدمات الترجمة للمرضى.</li>
                                        <li>تقديم اللوازم الطبية للمرضى.</li>
                                        <li>تخريج المرضى و نقلهم بالسيارات.</li>
                                        <li>تقديم تقارير عن الحالة الطبية للمرضى</li>
                                    </ul>
                                    <p> </p>
                                    -->
                                    <div class="eco_share-tag">
                                        <span> شارك المحتوى</span>
                                        <ul class="social-icons">
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u="><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="https://twitter.com/home?status="><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url="><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        </ul>

                                    </div>
                            </div>

                        </div>
                        <!--Eco Template section ends-->
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12 responsive-991-width">

                        <div class="margin-buttom_50 responsive-column responsive-devider-50">
                            <div class="widget_post_content">
                                <h5 class="eco_sm_titles">أحدث الأخبار</h5>
                                <!--Eco archives column posts-->

                                <ul class="eco_widget_list_style">

                                                                                <!--Eco  archives column post-->
                                    <li><a href="{{url('/news2')}}">ورشة التغذية و التوحد</a></li>
                                    <!--Eco  archives column post-->
                                    <li><a href="{{url('/news3')}}">L'ortophonie حصص تقويم النطق </a></li>
                                                                                <!--Eco  archives column post->
                                    <li><a href="#">تسليم أدوية إلى مركز ترمانين الصحي</a></li>
                                                                                <!--Eco  archives column post->
                                    <li><a href="#"> تسليم أدوية ومستهلكات طبية إلى مركز كفر عروق</a></li>
                                                                                <!--Eco  archives column post->
                                    <li><a href="#">حملة إصابتي ليست عجزاً من بلسم</a></li>
                                                                                <!--Eco  archives column post->
                                    <li><a href="#">الإستجابة الطارئة للمدنيين النازحين من ريفي حلب وحماة</a></li>
                                         -->
                                </ul>
                                <!--Eco recent blog posts ends-->
                            </div>
                        </div>
                        <div class="margin-buttom_50 responsive-column responsive-devider-50">
                            <div class="widget_post_content">
                                <h5 class="eco_sm_titles">أحدث المشاريع</h5>
                                <!--Eco featured widget column posts-->
                                <div class="widget_post_slider">


                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/eko-device-/2018-05-04-12.41.07-pm-250x250.jpg" alt="" />
                                        </figure>
                                    </div>

                                    <!--
                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/tarmin-center-project-/01-250x250.jpg" alt="" />
                                        </figure>
                                    </div>

                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/prostheses-and-orthoses-project/6y5a2310-250x250.jpg" alt="" />
                                        </figure>
                                    </div>

                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/hiba-kid-/img_2984-250x250.jpg" alt="" />
                                        </figure>
                                    </div>

                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/odai-hospital-/2018-05-04-12.34.44-pm-250x250.jpg" alt="" />
                                        </figure>
                                    </div>

                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/bab-al-hawah-hospital-/2018-05-04-12.38.29-pm-250x250.jpg" alt="" />
                                        </figure>
                                    </div>
                                    -->


                                </div>
                            </div>
                        </div>
                        <div class="margin-buttom_50 responsive-column responsive-devider-50">
                            <div class="widget_post_content">
                                <h5 class="eco_sm_titles">أحدث لقاءات نادي الأسر</h5>
                                <!--Eco featured widget column posts-->
                                <div class="widget_post_slider">


                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/reports/icon2-250x250.png" alt="" />
                                        </figure>
                                    </div>


                                    <!--
                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/reports/icon1-250x250.png" alt="" />
                                        </figure>
                                    </div>

                                    <div class="widget_post">
                                        <figure>
                                            <img src="content/cache/content/upload/reports/icon3-250x250.png" alt="" />
                                        </figure>
                                    </div>
                                    -->

                                </div>
                            </div>
                        </div>

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

