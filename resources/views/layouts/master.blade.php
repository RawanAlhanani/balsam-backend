<!DOCTYPE html>
<html dir="rtl" lang="ar">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />

     <title> 
        {{
	(isset($info) &&  $info->titre != null ) ? $info->titre : 
		(
			 (isset($activite) && $activite->titre != null) ? $activite->titre :
			 	 (
			 	 	 (isset($unePage) && $unePage->titre != null) ? $unePage->titre :
			 	 	 	(
			 	 	 		(isset($projet) &&  $projet->titre != null ) ? $projet->titre :
			 	 	 				(
			 	 	 					 (isset($aboutPrincipale) &&  $aboutPrincipale->titre != null ) ? $aboutPrincipale->titre :
			 	 	 					 	(
			 	 	 					 		(isset($about) &&  $about->titre != null ) ? $about->titre :
			 	 	 					 			(
			 	 	 					 				isset($pagesAutismes) ?  "فهم التوحد":
			 	 	 					 				(
			 	 	 					 					isset($projets) ?  "مشاريعنا":
			 	 	 					 						(
			 	 	 					 						   isset($infos) ?  "أخبارنا":
			 	 	 					 						   	(
			 	 	 					 						   		isset($activites) ?  "أنشطتنا":
			 	 	 					 						   		 (
			 	 	 					 						   		isset($partenaires) ?  "شركاؤنا": 	
			 	 	 					 							'الصفحة الرئيسية' 
			 	 	 					 								)
			 	 	 					 							)
			 	 	 					 						)
			 	 	 	 								)
			 	 	 	 							)
			 	 	 	 					)
			 	 	 	 			)   
			 	 	 	 		
			 	 	 	)
			 	 )
		)
}} 
    </title>
    <meta name="keywords" content="" />
    <meta name="description" content="جمعية بلسم لذوي التوحد">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    
    <!-- OpenGraph tags -->
      <meta property="og:title" content="
            {{
	(isset($info) &&  $info->titre != null ) ? $info->titre : 
		(
			 ( isset($activite) && $activite->titre != null) ? $activite->titre :
			 	 (
			 	 	 (isset($unePage) && $unePage->titre != null) ? $unePage->titre :
			 	 	 	(
			 	 	 		(isset($projet) &&  $projet->titre != null ) ? $projet->titre :
			 	 	 				(
			 	 	 					 (isset($aboutPrincipale) &&  $aboutPrincipale->titre != null ) ? $aboutPrincipale->titre :
			 	 	 					 	(
			 	 	 					 		(isset($about) &&  $about->titre != null ) ? $about->titre :
			 	 	 	 							'الصفحة الرئيسية' 
			 	 	 	 					)
			 	 	 	 			)   
			 	 	 	 		
			 	 	 	)
			 	 )
		)
}} 
        "/>

    <meta property="og:url" content=
	"https://balsam.ma{{
		isset($info) ? "/Information/".$info->id : 
			(isset($activite) ? "/uneActivite/".$activite->id : 
				(isset($unePage) ? "/page_autisme/".$unePage->id : 
					(isset($projet) ? "/projet/".$projet->id : 
						(isset($aboutPrincipale) ? "/about" : 
							(isset($about) ? "/aboutUs/".$about->id :  
								"")))))
	}}"/>

  	<meta property="og:type" content="website">
    <meta property="og:image" content="{{
        ( isset($info) && $info->image_info != null) ? asset('storage/MesImages'.'/'.$info->image_info) :
            ( 
                (isset($activite) && $activite->image_activite != null ) ? asset('storage/MesImages'.'/'.$activite->image_activite) : 
	                ( 
	                    (isset($unePage) && $unePage->page_image != null) ? asset('storage/MesImages'.'/'.$unePage->page_image) : 
	                    	(
	                    		(isset($projet) && $projet->projet_image != null) ? asset('storage/MesImages'.'/'.$projet->projet_image) : 
	                    			(
	                    				(isset($aboutPrincipale) && $aboutPrincipale->about_image != null) ? asset('storage/MesImages'.'/'.$aboutPrincipale->about_image) :
	                    					( 
	                    						(isset($about) && $about->about_image != null) ? asset('storage/MesImages'.'/'.$about->about_image) : 
	                    							asset('content/cache/content/upload/logo-650x380.png')
	                    					)
	                    			)
	                    	)
	                )
            )
    }} "/>
 
    <meta property="og:description" content="جمعية بلسم لذوي التوحد"/>
    <meta property="og:site_name" content=" جمعية بلسم لذوي التوحد" />
    <meta property="og:locale" content="ar_AR" />

    <link rel="shortcut icon" href="{{asset('content/cache/content/upload/Icon.ico')}}" type="image/x-icon">
<!--	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="favicon/apple-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/apple-icon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/apple-icon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/apple-icon-16x16.png">
	link rel="manifest" href="favicon/manifest.json" -->
	
	<meta name="msapplication-TileImage" content="favicon/android-icon-144x144.png">
    <link href="{{asset('content/view/themes/balsam/assests/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/slick-slider.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/jquery.bxslider.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/js/responsive-menu/component.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/svg-icons.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/typography.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/jquery.auto-complete.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/shortcodes.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/colors.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/style.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('content/view/themes/balsam/assests/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('content/view/themes/balsam/assests/css/rtl.css')}}"  >
</head>

<body>
    <style>
        .dropdown.ccd.phoneLang {
            position: absolute;
            top: -11px;
            margin: 0 12px;
        }
    </style>
<div class="eco_wrapper">

		 <!--eco Header starts-->
		@include('layouts.FooterHeader.partiel.header')
		 <!--Header ends-->

        @yield('content')

		 <!--Eco footer starts-->
		@include('layouts.FooterHeader.partiel.footer')

	</div>
	 <!--eco content wrapper ends-->

	<div id="preloader">
		 <div id="status"></div>
    </div>
</div>

<script src="{{asset('content/view/themes/balsam/assests/js/jquery.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/bootstrap-lab.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/bootstrap.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/responsive-menu/modernizr.custom.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/responsive-menu/jquery.dlmenu.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/jquery-filterable.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/masonry-gallery.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/jquery.auto-complete.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/countup.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/jquery.countdown.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/slick-slider.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/jquery.bxslider.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/owl.carousel.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/sliderpro/js/jquery.sliderPro.min.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/lightbox.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/youtube/YouTubePopUp.jquery.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/custom.js')}}"></script>
<script src="{{asset('content/view/themes/balsam/assests/js/client_side_validation.js')}}"></script>

@yield('js')

<script type="text/javascript">
    // derniers infos
    $(document).ready(function () {
        
        /*
        $(document).on('mouseover', '.pagesAutisme', function(){
            $('.lesPagesAutisme').empty();
            var contenu = "";
            $.ajax({
               type:'GET',
               url: "getTitresPagesAutisme",
               dataType:'json',
               success:function(data){
                for(var i=0; i< data.pages.length; i++){
                    contenu += '<li  class="  ">'+
                    '<a title="" href="{{URL('page_autisme')}}' + '/' + data.pages[i].id +'">'+data.pages[i].titre
                    '</a></li>';
                }
                        $('.lesPagesAutisme').append(contenu);
               }
            });
        });
        
        */

        $('.lastNews').empty();
        var elet = "";
        $.ajax({
               type:'GET',
               url: "/getLastNews",
               dataType:'json',
               success:function(data){
                for(var i=0; i< data.news.length; i++){
                elet += '<li>'+
                            '<div class="eco_recent_posts ">'+
                            '<figure>'+
                             '<div class="eco_thumb eco_hover_effect">'+
                                '<img src="'+ '{{ URL::asset('storage/MesImages' ) }}' + '/' + data.news[i].image_info +'" alt="" />'+
                                   '</div>'+
                                 '<div class="eco_post-content" style="padding : 0 !important;">'+
                                 '<p><a href="'+
                                 '{{URL('Information')}}/'+data.news[i].id+'">'+ 
                                 data.news[i].titre +
                                '</a></p>'+
                            '</div>'+
                        '</figure>'+
                        '</div></li>';
                                    }

                        $('.lastNews').append(elet);
               }
        });

    });
</script>

</body>

</html>
