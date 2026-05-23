
@extends('layouts.master')
@section('title','Contact')

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


    <!--Eco Template section start-->
    <section>
        <!--Eco Template section content-->
        <div class="container">
            <!--Eco Template Heading-->
            <div class="eco_headings">
                <h3><b>مشاريع جمعية بلسم</b>   </h3>
                <h6>نبذل قصارى جهدنا لخدمتكم</h6>
                <span><i class="icon-nature-2"></i></span>
            </div>
            
            <div style="font-size: 15px; text-align: right;">
                @php
                    $paraphs = explode("---", $projetPrincipale->description) ;
                    $contenu = "";
                    foreach($paraphs as $p){
                        // les puces
                        $puces = explode("***", $p);
                        
                        if(count($puces) > 1 ){
                            foreach($puces as $cc){
                                $contenu .= "<li>" . $cc . "</li>" ;
                            }
                        }     // en gras sans retour
                        else if (strpos($p, '===') != false) {
                            $p = str_replace("===", "", $p);
                            $p = "<strong> " . $p . " </strong>" ;
                            $contenu .=  trim($p) ;
                        } // en gras avec retour
                        else if (strpos($p, '==') != false) {
                            $p =  str_replace("==", "", $p);
                            $p = '<strong>' . $p . '</strong>' ;
                            $contenu .=  $p . "<br /> <br />";
                        }
                        else{
                                $contenu .= $p . "<br /> <br />" ;
                        }
                                
                    }
                    echo $contenu;
                @endphp
            </div>
                                
            <!--Eco services-->
            <div class="eco_featured_causes">
                <div class="row">
                    <!--Eco services flip colums-->
                
                   @foreach($projets as $pr)
                    <div class="col-md-3 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="{{asset('storage/MesImages'.'/'.$pr->projet_image)}}" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <!--<h5><a href="{{url('/pleading')}}">المرافعة</a></h5>-->
                                        <p></p>
                                         <a href="{{route('unProjet', $pr->id)}}" class="ProjectsRead">{{$pr->titre}}</a>
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
    <!--Eco Template section ends-->


</div>
<!--Eco content ends-->




@endsection

@push('js')

@endpush
