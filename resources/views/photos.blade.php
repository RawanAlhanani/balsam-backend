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
                <h3><b>معرض صور جمعية بلْسم</b>   </h3>
                <span><i class="icon-nature-2"></i></span>
            </div>
            <!--Eco services-->
           <div class="eco_featured_causes">
                         <!--Eco services flip colums start-->
						 <div class="row">
            @foreach($photosexpos as $img)
				<div class="col-md-3 col-sm-6 responsive-devider-50 mb20">
                    <a class="example-image-link" href="{{asset('storage/MesImages'.'/'.$img->nomImage)}}" data-lightbox="example-set" data-title="انقر فوق النصف الأيمن من الصورة للانتقال إلى الصورة التالية.">
                      <img class="example-image" src="{{asset('storage/MesImages'.'/'.$img->nomImage)}}" alt=""/>
                    </a>
               </div>
            @endforeach
                         </div>
                         <!--Eco services flip colums ends-->
                     </div>
        <!--Eco Template section content ends-->
    </div></section>
</div>
<!--Eco content ends-->



@endsection

@push('js')

@endpush

