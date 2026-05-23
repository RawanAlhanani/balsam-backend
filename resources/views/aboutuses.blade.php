@extends('layouts.master')
@section('title','About')

@push('css')

@endpush

@section('content')


<div class="eco_banner eco_inner_page_banner">
    <!--Eco Template Banner img-->
    <div class="eco_headings">
    </div>
</div>
    <!--Eco Template Banner ends-->

<!--Eco Template content start-->
<div class="content">
    <section>
        <div class="eco_blog_detail">

            <div class="container">
                
                <div class="eco_headings">
                    <h3><b>من نحن</b>   </h3>
                    <h6>نبذل قصارى جهدنا لخدمتكم</h6>
                    <span><i class="icon-nature-2"></i></span>
                </div>
                
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12 responsive-991-width">
                        <!--Eco Template section start-->
                        <div class="eco_blog_detail_post">
                            <figure>
                                 <img class="img-responsive cimage" src="{{asset('storage/MesImages'.'/'.$aboutPrincipale->about_image)}}" alt="Photo">
                            </figure>
                            <div class="eco_blog_detail_content">
                                
                                <div style="font-size: 15px;">
                                    @php
                                        $paraphs = explode("---", $aboutPrincipale->description) ;
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

                                <div class="eco_featured_causes">
                                    <div class="row justify-content-md-center">
                                        <!--Eco services flip colums-->
                                        
                                    @foreach($abouts as $ab)
                                        <div class="col-md-3 col-sm-6 responsive-devider-50">
                                            <div class="eco_flip-container">
                                                <div class="flipper feature-blog">
                                                    <div class="front">
                                                        <figure>
                                                            <div class="eco-thumb">
                                                                <img src="{{asset('storage/MesImages'.'/'.$ab->about_image)}}" alt="" />
                                                            </div>
                                                        </figure>
                                                        <div class="feature_blog_caption">
                                                            <p></p>
                                                             <a href="{{route('anAbout', [ 'id'=>$ab->id]) }}" class="ProjectsRead">{{$ab->titre}}</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                        <!--Eco services flip colums ends-->
                                    </div>
                                </div>

                                <div class="eco_share-tag" style="width:40%; margin-top: 60px;">
                                    <span> شارك المحتوى</span>
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://balsam.ma/about"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
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
<!--Eco Template content ends-->


@endsection

@push('js')

@endpush
