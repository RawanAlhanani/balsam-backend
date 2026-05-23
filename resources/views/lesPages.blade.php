@extends('layouts.master')
@section('title','Autism')

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
        <!--Eco blog content-->
        <div class="container">
            <!--Eco Template Heading-->
            <!--Eco Template Heading-->
           <div class="eco_headings">
            <h3><b>فهم التوحد</b>   </h3>
            <h6>نبذل قصارى جهدنا لخدمتكم</h6>
            <span><i class="icon-nature-2"></i></span>
        </div>
            <!--Eco blog-->
            <div class="eco_blog_section">
                <div class="row">

                   @foreach($pagesAutismes as $p)
                       <div class="col-md-4 col-sm-6 responsive-col-xs">
                            <!--Eco blog column-->
                           <div class="eco_blog_column ">
                                <!--Eco blog column picture-->
                                <figure>
                                    <div class="eco_thumb eco_hover_effect">
                                        <img src="{{asset('storage/MesImages'.'/'.$p->page_image)}}" alt="" />
                                        <div class="eco_hover_btn">
                                            <a class="mediem_btn_02" href="{{url('/page_autisme/' . $p->id )}}">قراءة المزيد</a>
                                        </div>
                                    </div>
                                </figure>
                                 <!--Eco blog column content-->
                                <div class="eco_blog_content">

                                    <div class="eco-event-title">
                                        <h5>{{$p->titre}}</h5>
                                    </div>
                                </div>
                           </div>
                       </div>
                   @endforeach
                  

                </div>
            </div>
            <!--Eco blog ends-->
        </div>
        <!--Eco blog content ends-->
    </section>
</div>
<!--Eco content ends-->


@endsection

@push('js')

@endpush

