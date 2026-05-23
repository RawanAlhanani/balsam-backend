@extends('layouts.master')
@section('title','Object')

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

                                <img class="img-responsive cimage" src="content/upload/who-are-we/adobestock_92183997.jpg" alt="Photo">


                            </figure>
                            <div class="eco_blog_detail_content">
                                <p id="mcetoc_1cckmu7j90"><strong>تهدف الجمعية حسب قانونها الأساسي في المادة الخامسة إلى تقديم خدمات للأشخاص التوحديين وذويهم، وذلك ب:</strong></p>
                                <p>1- استفادة الأطفال ذوي التوحد من تمدرس يمكنهم من الاندماج في المؤسسات التعليمية العمومية والخصوصية.</p>
                                <p>2- تقديم جميع أنواع الخدمات الطبية والشبه الطبية للأطفال والأشخاص التوحديين في حدود الإمكانيات المتوفرة لدى الجمعية.</p>
                                <p>3- تقديم خدمات تربوية، صحية، اجتماعية، رياضية، وتنظيم مخيمات تستجيب لمختلف حاجيات الأشخاص ذوي التوحد.</p>
                                <p>4- تمكين أسر الأشخاص ذوي التوحد من تكوينات تستجيب لتطلعاتهم من أجل تكفل أفضل بهم.</p>
                                <p>5- عقد شراكات مع المؤسسات الرسمية والخاصة والتعاون معها فيما له علاقة بمجال إفادة الأشخاص ذوي التوحد.</p>
                                <div class="eco_share-tag">
                                    <span> شارك المحتوى</span>
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://balsam.ma/object"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
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
                                     @foreach($news as $dernier)
                                    <li><a href="{{route('uneInf', $dernier->id)}}">{{$dernier->titre}}</a></li>
                                @endforeach
                                </ul>
                                <!--Eco recent blog posts ends-->
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

