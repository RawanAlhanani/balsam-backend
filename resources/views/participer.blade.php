<! DOCTYPE html>
<html dir="rtl" lang="ar">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
 <meta charset="utf-8" />
 <link rel="shortcut icon" href="{{asset('content/cache/content/upload/Icon.ico')}}" type="image/x-icon">
<link href="{{asset('content/view/themes/balsam/assests/css/bootstrap.min.css')}}" rel="stylesheet">
	<title>  جمعية بلسم لذوي التوحد  |  Association BALSAM Pour Autistes  </title>

<style> 
 * { font-family: DejaVu Sans, sans-serif; }
</style>	
</head>

<body dir="rtl">

<header>

                <!--Header top row logo-->
                <div class="kode_eco_logo">
                    <a href="{{url('/')}}"><img width="200" src="{{asset('content/view/themes/balsam/assests/images/logo.png')}}" alt=""/></a>
                </div>
            </header>

<div style="margin:20px; clear:both;">
	<div style="font-size: 20px; text-align: right;">إسم ولي الأمر :
<br>
{{ $tuteur->nom_tuteur . " " . $tuteur->prenom_tuteur}}</div>


		<div style="font-size: 18px; text-align: center; direction: rtl; margin-top: 10px"  >إلى السيد </div>
		<div style="font-size: 20px; text-align: center; direction: rtl; margin-top: 10px"  >رئيس جمعية بلسم</div>
		
		<div style="font-size: 20px; text-align: right; direction: rtl; margin-top: 40px"  >   الموضوع  : طلب الاستفادة من نشاط </div>
		
		<div style="font-size: 20px; text-align: center; direction: rtl; margin-top: 40px"  >  <b>{{$activite->titre}}</b> </div>
		
<div style="font-size: 14px; margin-top: 30px; text-align: right; direction: rtl; width:100%;">
أنا الموقع(ة) أسفل، أرغب في استفادة ابني من هذا النشاط  المنظم بجمعيتكم، كما تجدون رفقته نسخة من بطاقة التعريف الوطنية و نسخة  من الملف الطبي لتشخيص التوحد لإبني
 {{$enfant->nom_enfant. " " . $enfant->prenom_enfant}}
  </div>

		<div style="margin-top: 60px; font-size: 20px;text-align: center;">إمضاء ولي الأمر:</div>


</div>

<input type="hidden" id="id_tuteur" name="id_tuteur">
<input type="hidden" id="id_activite" name="id_activite">



  <!--  <a href="{{route('generation', ['id_activite' => $activite->id, 'id_tuteur' => $tuteur->id])}}" class="imprimer btn btn-primary">طباعة</a> 

    <a href="{{route('home')}}" class="imprimer btn btn-primary">رجوع</a>  -->
    
    <script src="{{asset('content/view/themes/balsam/assests/js/jquery.js')}}"></script>

    <script type="text/javascript">

    	$( document ).ready(function() {

    		 $('body').append('<a href="{{route('generation', ['id_activite' => $activite->id, 'id_tuteur' => $tuteur->id])}}" class="imprimer btn btn-primary">طباعة</a><a href="{{route('home')}}" class="imprimer btn btn-primary">رجوع</a>  ');
        });

    </script>

</body>
</html>