@extends('layouts.master')
@section('title','News')

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
                <h3><b>أخبار جمعية بلْسم</b>   </h3>
                <h6>نبذل قصارى جهدنا لخدمتكم</h6>
                <span><i class="icon-nature-2"></i></span>
            </div>
            <!--Eco services-->
            <div class="eco_featured_causes">
                <div class="row">
                    <!--Eco services flip colums-->

                    @foreach ($infos as $v)
                        <div class="col-md-4 col-sm-6 responsive-devider-50">
                            <div class="eco_flip-container">
                                <div class="flipper feature-blog">
                                    <div class="front">
                                        <figure>
                                            <div class="eco-thumb">
    <img src="{{asset('storage/MesImages'.'/'.$v->image_info)}}" alt="" />
                                            </div>
                                        </figure>
                                        <div class="feature_blog_caption">
                                            <h5><a href="{{route('uneInf', $v->id)}}">{{$v->titre}}</a></h5>
<p>{{ \Illuminate\Support\Str::limit($v->description, 150, $end='...') }} </p>
                                         <a href="{{route('uneInf', $v->id)}}" class="ProjectsRead">قراءة المزيد</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                 
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

