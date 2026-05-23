@extends('layouts.master')
@section('title','Club')

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
     <!--Eco Template section-->
    <section>
        <!--Eco Template section content-->
        <div class="container">
            <!--Eco Template Heading-->
             <div class="eco_headings">
                <h3><b>نادي للأسر</b>   </h3>
                <h6>لقاءات النادي  |  نصائح للأسر</h6>
                <span><i class="icon-nature-2"></i></span>
            </div>
            <!--Eco services-->
            <div class="eco_featured_causes">
                <div class="row">
                    <!--Eco services flip colums-->

                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/reports/icon1-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="{{url('/clubmeet')}}">لقاءات النادي</a></h5>

                                        <div class="progress-names">
                                            <div class="progress-wrap progress" data-progress-percent="0">
                                                <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/reports/icon3-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="{{url('/tipsfamilies')}}">نصائح للأسر</a></h5>

                                        <div class="progress-names">
                                            <div class="progress-wrap progress" data-progress-percent="0">
                                                <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/reports/icon2-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d8%b1%d9%83%d8%b2-%d8%a7%d9%84%d8%a3%d8%b7%d8%b1%d8%a7%d9%81-%d8%a7%d9%84%d8%b5%d9%86%d8%a7%d8%b9%d9%8a%d8%a9.html">تقرير مركز الأطراف الصناعية في النصف الثاني من آذار 2018</a></h5>
                                        <p><p><strong>لمحة عن المشروع: </strong></p>
                                        <p>تركيب الاطراف الصناعية السفلية و تخفيف العبئ على المرض...</p>

                                        <span class="eco_progress-heading skill">عام: 2018</span>

                                        <div class="progress-names">
                                            <div class="progress-wrap progress" data-progress-percent="55">
                                                <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                            </div>

                                            <small class="pull-right">شهر: شهر آذار </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    -->


                    <!--Eco services flip colums ends-->
                </div>
            </div>
        <!--Eco Template section content ends-->
    </div></section>
</div>
<!--Eco content ends-->


@endsection

@push('js')

@endpush

