@extends('layouts.master')
@section('title','Home')

@push('css')

@endpush

@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('content/view/themes/balsam/assests/sliderpro/css/slider-pro.min.css')}}" media="screen"/>

            <div style="clear: both;" ></div>

        <div style="    direction: ltr;" id="example1" class="slider-pro">
		    <div class="sp-slides">
		        @foreach($images as $img)
            	<div class="sp-slide">
				    <img class="sp-image" src="{{asset('content/view/themes/balsam/assests/sliderpro/css/images/blank.gif')}}"
					data-src="{{asset('storage/MesImages'.'/'.$img->nomImage)}}"
					data-retina="{{asset('storage/MesImages'.'/'.$img->nomImage)}}"/>
                </div>
                @endforeach

		    </div>

		    <div class="sp-thumbnails">
			    <div class="sp-thumbnail">
				    <div class="sp-thumbnail-title">
                        <img src="{{asset('content/upload/new-slider-25-6-2018/01.png')}}" />
                    </div>
			    </div>
                <div class="sp-thumbnail">
				    <div class="sp-thumbnail-title">
                        <img src="{{asset('content/upload/new-slider-25-6-2018/02.png')}}" />
                    </div>
			    </div>
                <div class="sp-thumbnail">
				    <div class="sp-thumbnail-title">
                        <img src="{{asset('content/upload/new-slider-25-6-2018/03.png')}}" />
                    </div>
			    </div>
                <div class="sp-thumbnail">
				    <div class="sp-thumbnail-title">
                        <img src="{{asset('content/upload/new-slider-25-6-2018/04.png')}}" />
                    </div>
			    </div>
            </div>
        </div>

        <div style="clear: both;" ></div>
    <style>
        .sp-thumbnail {
        width: 100%;
        }
        .sp-thumbnail-title img {
        width: 80px;
        display: table;
        margin: auto;
        }

        .sp-thumbnail-title {
        padding: 10px;
        }
        .sp-bottom-thumbnails.sp-has-pointer .sp-selected-thumbnail:before {
        display: none;
        }
        .sp-bottom-thumbnails.sp-has-pointer .sp-selected-thumbnail:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        left: 50%;
        top: 0;
        margin-left: -20px;
        border-bottom: 15px solid #fff;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        }
    </style>
    <style>
        .mb20 {
        margin-bottom: 20px;
        }
    </style>

        <link rel="stylesheet" type="text/css" href="content/view/themes/balsam/assests/youtube/YouTubePopUp.css">

    <!--Eco Template content start-->
		<div class="content">
		    
			 <!--Eco Template section start-->
			<section class="eco_services_environment">
				<!--Eco Template section content-->
				 <div class="container">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <ol class="carousel-indicators">
                            @php
                                $nbrs = count($aboutuses);
                                $i = 0;
                            @endphp
                            
                            @for($j = 0; $j < $nbrs ; $j++)
                                <li data-target="#carouselExampleControls" data-slide-to="{{$j}}" class="{{$j == 0 ? 'active' : ''}}"></li>
                            @endfor
                        </ol>
                        @php
                            $ii = 0;
                        @endphp
                    @foreach($aboutuses as $ab)    
                        <div class="carousel-item {{ (++$ii) == 1 ? 'active' : '' }}">
                           <!--Eco Template Heading-->
        					 <div class="eco_headings">
        						 <h3><b>جمعية بلسم لذوي التوحد</b>   </h3>
        						 <h6>من نحن</h6>
        						 <span><i class="icon-nature-2"></i></span>
        					 </div>
        					 <!--Eco services-->
        					<div class="eco_services">
        						<div class="row">
        							<div class="col-md-6 col-sm-6 col-xs-12">
        								<div class="aboutus">
                                              
                                              <div style="font-size: 15px;">
                                    @php
                                        $paraphs = explode("---", $ab->description) ;
                                       
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
                                              
                                            <a href="{{url('/about')}}" class="aread">قراءة المزيد</a>
   								        </div>
        							</div>
        							 <!--Eco Template section content center img-->
							        <div class="col-md-6 col-sm-6 col-xs-12 hidden-sm-down">
                                        <figure>
                                            <div class="thumb-widthout-layer"><img style="height:90%;" src="{{asset('storage/MesImages'.'/'.$ab->about_image)}}" alt="" />
                                            </div>
                                        </figure>
                                    </div>
        						</div>
        					</div>
                        </div>
                    @endforeach
                        
                    </div>
                    <!--
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                  -->
                    </div>


				 </div>
				 
				 
				 
				<!--Eco Template section content ends-->
			</section>
			 <!--Eco Template section ends-->


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
					 <!--Eco services-->
					 <div class="eco_featured_causes">
						 <div class="row">
                             <!--Eco services flip colums-->
                        @foreach($projetsPrincipale as $pr)
                            <div class="col-md-3 col-sm-6 responsive-devider-50">
								 <div class="eco_flip-container">
									 <div class="flipper feature-blog">
										 <div class="front">
											 <figure>
												 <div class="eco-thumb">
													 <img src="{{asset('storage/MesImages'.'/'.$pr->projet_image)}}" alt="" style="height:220px;" />
												 </div>
											 </figure>
											 <div class="feature_blog_caption">
												 <p></p>
												  <a href="{{url('/projet')."/".$pr->id}}" class="ProjectsRead">{{$pr->titre}}</a>
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
                </div>
            </section>
             <!--Eco Template section ends-->
             <!--Eco section start-->
			<section>
				<!--Eco blog content-->
				<div class="container">
					 <!--Eco Template Heading-->
					 <div class="eco_headings">
						 <h3><b>أحدث الأخبار</b>  </h3>

                     </div>

					 <!--Eco blog-->
					 <div class="eco_blog_section">
						 <div class="row">
					@php
						$nbr = 0;
					@endphp

					@foreach($news as $inf)

						@if($nbr % 2 == 0)
                            <div class="col-md-4 col-sm-6 responsive-col-xs">
								 <!--Eco blog column-->
								<div class="eco_blog_column ">
									 <!--Eco blog column picture-->
									 <figure>
										 <div class="eco_thumb eco_hover_effect">
											 <img src="{{asset('storage/MesImages'.'/'.$inf->image_info)}}" alt="" />
											 <div class="eco_hover_btn">
												<a class="mediem_btn_02" href="{{route('uneInf', $inf->id)}}">قراءة المزيد</a>
											 </div>
										 </div>
									 </figure>
									  <!--Eco blog column content-->
									 <div class="eco_blog_content">

										 <div class="eco-event-title">
											<h5>{{$inf->titre}}</h5>
										 </div>
                                        <div class="aboutus">
                                            <p style="text-align: justify;">
                                          {{ \Illuminate\Support\Str::limit($inf->description, 150, $end='...') }}
                                             </p>
                                        </div>
									 </div>
								</div>
							</div>
						@else
                             <div class="col-md-4 col-sm-6 responsive-col-xs">
								 <!--Eco blog column-->
								 <div class="eco_blog_column blog-picture-down">
									 <!--Eco blog column picture-->
									  <!--Eco blog column content-->
									 <div class="eco_blog_content">

										 <div class="eco-event-title">
											 <h5>{{$inf->titre}}</h5>
										</div>
                                        <div class="aboutus">
                                            <p style="text-align: justify;">
                                             {{ \Illuminate\Support\Str::limit($inf->description, 150, $end='...') }}</p>
                                        </div>

									 </div>
									  <figure>
										 <div class="eco_thumb eco_hover_effect">
											 <img src="{{asset('storage/MesImages'.'/'.$inf->image_info)}}" alt="" />
											 <div class="eco_hover_btn">
												 <a class="mediem_btn_02" href="{{route('uneInf', $inf->id)}}">قراءة المزيد</a>
											 </div>
										 </div>
									 </figure>

								 </div>
							 </div>

						@endif

						@php $nbr++ ; @endphp

					@endforeach
						 </div>
					 </div>
                     <!--Eco blog ends-->

				</div>
				<!--Eco blog content ends-->
            </section>
              <!--Eco section ends-->

			 <!--Eco Template section start-->
			<div class="eco_filing_form">
				 <!--Eco container-->
				<div class="container">
					<!--
                    <!--Eco donation form->
					 <div class="eco_donation_form">

							 <div class="col-md-12 col-sm-12 responsive-col-xs">
								 <!--Eco Process of count up->
								 <div class="eco_process_of_counter">
									 <ul class="eco_counter">
										 <li class="left-side">
											 <div class="eco_count_up">
												 <span><img style="    width: auto;  height: 50px; margin-top: -23px;" src="content/view/themes/balsam/assests/images/png1.png" /></span>
												 <h3 dir="ltr"><span>+</span><span class="counter-up">0 </span> </h3>
												 <p>مستفيد من التكوين </p>
											 </div>
										 </li>
										 <li class="right-side">
											 <div class="eco_count_up">
												 <span><img style="    width: auto;  height: 50px; margin-top: -23px;" src="content/view/themes/balsam/assests/images/png2.png" /></span>
												 <h3 dir="ltr"><span>+</span><span class="counter-up">10 </span> </h3>
												 <p>مستفيد من المركز المتخصص</p>
											 </div>
										 </li>
										 <li class="left-side">
											 <div class="eco_count_up">
												 <span><img style="    width: auto;  height: 50px; margin-top: -23px;" src="content/view/themes/balsam/assests/images/png3.png" /></span>
												 <h3 dir="ltr"><span>+</span><span class="counter-up">20 </span> </h3>
												 <p>مستفيدي المركز في القنيطرة</p>
											 </div>
										 </li>

										 <li class="right-side">
											 <div class="eco_count_up no-margin-bottom">
												 <span><img style="    width: auto;  height: 50px; margin-top: -23px;" src="content/view/themes/balsam/assests/images/png4.png" /></span>
												 <h3 dir="ltr"><span>+</span><span class="counter-up">1820 </span> </h3>
												 <p>مستفيدي المركز في المغرب</p>
                                                 <br /><br />
											 </div>
										 </li>

									 </ul>
								 </div>
								 <!--Eco Process of count up ends->
							 </div>
					    </div>
				        </div>
			        </div>
				    <!--Eco donation form ends->
					-->
			    </div>
			    <!--Eco container ends-->

			    <!--Eco Video section start-->
			    <div class="eco_video_section">
				    <!--Eco Video content start-->
				    <div class="container">
				        <!--eco content video start-->
					    <div class="eco_video_content">
						 <a class="bla-1 video-icon-button" href="https://www.youtube.com/channel/UCQbDMLX0jQlPYAGWWn5n3sQ" ><i class="fa-1x icon icon-play"></i></a>
						 <h3>جمعية بلسم لذوي التوحد </h3>

						 <a class="bla-1 watch-now-button" href="https://www.youtube.com/channel/UCQbDMLX0jQlPYAGWWn5n3sQ"  > شاهد الآن  <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					    </div>
				        <!--eco content video ends-->
				    </div>
				    <!--Eco Video content ends-->
			    </div>
			    <!--Eco Video section ends-->

			 <!--Eco Template section ends-->

		    </div>
    <!--Eco Template content ends-->



    <!--Eco Template section start-->
            <section class="eco_services_environment">
				 <!--Eco Template section content start-->
				<div class="container">
					 <!--Eco Template Heading start-->
					 <div class="eco_headings">
						 <h3><b>معرض الصور</b>   </h3>
						 <h6> بعض صورنا</h6>
						 <span><i class="icon-nature-2"></i></span>
                     </div>
                     <!--Eco Template Heading ends-->

					 <!--Eco services start-->
					 <div class="eco_featured_causes">
                         <!--Eco services flip colums start-->
						 <div class="row">
@foreach($imagesexpos as $img)
							<div class="col-md-3 col-sm-6 responsive-devider-50 mb20">
                                <a class="example-image-link" href="{{asset('storage/MesImages'.'/'.$img->nomImage)}}" data-lightbox="example-set" data-title="انقر فوق النصف الأيمن من الصورة للانتقال إلى الصورة التالية.">
                                  <img class="example-image" src="{{asset('storage/MesImages'.'/'.$img->nomImage)}}" alt=""/>
                                </a>
                           </div>
@endforeach
<div style="text-align:center;margin:auto;">
<a href="{{route('lesPhotos')}}" class="aread" >المزيد من الصور</a>
</div>
                         </div>
                         <!--Eco services flip colums ends-->
                     </div>
                     <!--Eco services start-->

				 <!--Eco Template section content ends-->
                </div>
            </section>
    <!--Eco Template section ends-->


    <!--Eco Template section start-->
            <section class="eco_services_environment">
				 <!--Eco Template section content start-->
				 <div class="container">
					<!--Eco Template Heading-->
					<div class="eco_headings">
						<h3><b>للتبرع لجمعية بلسم :</b>   </h3>
						<span><i class="icon-nature-2"></i></span>
					</div>
					<!--Eco services-->
					<div class="eco_featured_causes">
						<div class="row">
						   <!--Eco services flip colums start-->
							  <div class="sendMail col-md-8 col-sm-6">
							   <img  src="content/upload/who-are-we/BANK.png" alt="" class="rounded"/>
							   </a>
						   </div>
						   <!--Eco services flip colums ends-->
						</div>
					</div>
				</div>
                 <!--Eco Template section content ends-->
            </section>
    <!--Eco Template section ends-->

    <style>
        .sendMail {
        display: table;
        margin: auto;
        }
        input.senInput {
        min-width: 250px;
        }
        .sendMail input.hidden {
        width: 88px;
        height: 39px;
        border: none;
        background: #0d5377;
        color: #fff;
        margin-right: -19px;
        z-index: 9999999;
        position: relative;
        }
    </style>


@endsection

@push('js')

@endpush

