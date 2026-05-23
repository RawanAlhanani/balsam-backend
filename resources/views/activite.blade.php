@extends('layouts.master')
@section('title','News2')

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
                <div class="eco_headings">
                <h3><b>{{$activite->titre}}</b>   </h3>
            </div>
                
                <div class="row">

                    <div class="col-md-9 col-sm-12 col-xs-12 responsive-991-width">
                        <!--Eco Template section-->
                        <div class="eco_blog_detail_post">
                            <figure>
                                     <img class="img-responsive cimage" src="{{asset('storage/MesImages'.'/'.$activite->image_activite)}}" alt="Photo">
                            </figure>
                            <div class="eco_blog_detail_content">
                                
                                <div class="eco_share-tag" style="width:35%;">
                                
                                        
                                        <a href="#" class="ProjectsRead" style="background: #f05c7d; pointer:none;">    
                                                        {{$activite->TypeActivite->nomActivite}}
                                        </a>
                                        <p></p>
                                        <p><strong>   تاريخ النشاط  : {{$activite->date_activite}}</strong>   </p>
                                
                                </div> 
                                
                               <div style="font-size: 15px;">
                                    @php
                                        $paraphs = explode("---", $activite->description) ;
                                       
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
                                
                              
                                
                                
                                
                               
                              
                                    <a href="{{route('Participation', ['activite_id'=>$activite->id, 'tuteur_id' =>Session::has('tuteur_id') ? Session::get('tuteur_id') : '']) }}" class="ProjectsRead">إضغط للمشاركة في نشاط    <span style="color:#f05074; font-size:18px;">{{$activite->titre}}</span> </a>

                                <div class="eco_share-tag" style="width:35%;">
                                    <span> شارك المحتوى</span>
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://balsam.ma/uneActivite/{{$activite->id}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div> 
                            </div>
                        </div>
                        <!--Eco Template section ends-->
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12 responsive-991-width">

                        <div class="margin-buttom_50 responsive-column responsive-devider-50">
                            <div class="widget_post_content">
                                <h5 class="eco_sm_titles">أحدث الأنشطة</h5>
                                <!--Eco archives column posts-->

                                <ul class="eco_widget_list_style">

                                 @foreach($derniersActivites as $dernier)
                                    <li><a href="{{route('uneAct', $dernier->id)}}">{{$dernier->titre}}</a></li>
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

