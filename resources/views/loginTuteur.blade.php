@extends('layouts.master')

@section('content')


<!--Eco Template Banner-->
<div class="eco_banner eco_inner_page_banner">
    <!--Eco Template Banner img-->
    <div class="eco_headings">
        
    </div>

</div>
<!--Eco Template Banner ends-->

<!--Eco Template content-->
<div class="content">

@if(Session::has('msg1'))
  <p class="alert alert-danger" style="width:50%; margin: auto;">
        {{  Session::get('msg1')  }}
    </p>
@endif

       <!--Eco Template section start-->
       <section class="eco_services_environment">
        <!--Eco Template section content start-->
        <div class="container">

            <!--Eco Template Heading-->
            <div class="eco_headings" style="margin-top:-10px;">
                <h3><b>تسجيل الدخول </b>   </h3>

                <span><i class="icon-nature-2"></i></span>
            </div>
            <!--Eco services-->
            <div class="eco_featured_causes">
                <div class="row">
                   <!--Eco services flip colums start-->
                      <div class="sendMail">
                       <form method="post" action="{{route('postLogin')}}">
                        @csrf
                           <div class="col-md-12">
                            <div style="text-align:center; font-size: 16px"><span>اسم المستخدم</span></div>
                            
                               <input type="text" dir="ltr" name="login" placeholder="اسم المستخدم" class="form-control"/>
                           </div>
                           <br>
                           <div class="col-md-12">
                            <div style="text-align:center; font-size: 16px"><span>كلمة المرور</span></div>
                               <input type="password" dir="ltr" name="mdp"  placeholder="كلمة المرور" class="form-control"/>
                           </div>
                           <br>

                          <!--      <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" name="check" value=" تذكرني" >
                                        تذكرني
                                    </label>
                                    <div class="aboutus">
                                        <label style="float: left">
                                            <a href="{{url('/#')}}" > هل نسيت كلمة السر؟</a>
                                        </label>
                                    </div>
                                </div>
                            -->
                           <br><br>
                           <div class="col-md-12">
                                <div class="sendMail" >
                                    <button type="submit" class="btn-small xsmall-btn" > تسجيل الدخول</button>
                                </div>
                            </div>
                           <br>


                                <div class="col-md-12">
                                    <div class="aboutus" style="text-align: center">
                                        <p class="" >جديد في الموقع؟
                                        <a href="{{url('/inscription')}}"><strong style="color: #f05477;">أنشئ حساب</strong></a>
                                        </p>
                                    </div>
                                </div>



                       </form>
                    </div>
                   <!--Eco services flip colums ends-->
                </div>
            </div>
        </div>
        <!--Eco Template section content ends-->
   </section>
}
</div>
<!--Eco content ends-->
<style>
    .sendMail {
    display: table;
    margin: auto;
    width: 40%;
    }

    .sendMail button{
    display: table;
    margin: auto;
    width: 70%;
    }

    .col-md-12 .sendMail .aboutus{
    display: table;
    margin: auto;
    width: 200%;
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


