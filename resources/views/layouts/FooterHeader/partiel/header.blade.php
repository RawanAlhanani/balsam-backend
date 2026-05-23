<header>
    <!--Header-->
    <div class="kode_eco_navigations">
        <!--container-->
        <div class="container">
            <!--Header top row-->
            <div class="kode_eco-top_bar">
                <!--Header top row logo-->
                <div class="kode_eco_logo">
                    <a href="{{url('/')}}"><img src="{{asset("content/view/themes/balsam/assests/images/logo.png")}}" alt=""/></a>
                </div>
                
                <style>
                    .navigation > ul > li > a {
                    
                            padding: 25px 20px 26px !important;
                    }
                </style>

                <!--Header nav row-->
                <div class="kode_navigaion_bar">
                    <!--Responsive Menu Start-->
                    <div id="kode-responsive-navigation" class="dl-menuwrapper">
                        <button class="dl-trigger">Menu </button>
                        <ul id="" class="dl-menu"  >
                            <li  class="activeA p-331 active"><a title="" href="{{url('/')}}">الرئيسية </a></li>

                            <li  class=" p-3112  ">
                                <a title="" href="{{url('/about')}}">من نحن </a>
                             
                            </li>
                            
                            <li>
                                <a title="" class="" href="{{url('/autisme')}}">فهم التوحد </a> </li>
                     
                           
                            
                            <li  class="  ">
                                <a title="" href="{{url('/projets')}}" >مشاريعنا </a>
                        
                            </li>
                            <li  class="  "><a title="" href="{{url('/nosInfos')}}">أخبارنا </a>
                            </li>
                            
                            <li> 
                                <a title="" href="{{url('/nosActivites')}}">أنشطتنا</a>
                            </li>
                            
                            <li  class="  ">
                                <a title="" href="{{url('/nosPhotos')}}">صورنا</a>
                            </li>
                            
                            <li  class="  ">
                                <a title="" href="{{url('/partenaires')}}">شركاؤنا </a>
                            </li>
                            <li>
                                 @if(Session::has('nom_tuteur') && Session::has('prenom_tuteur'))
                                <a title="" href="{{url('/se_connecter')}}">
                                    <span style="color:#f05074;">
                                    {{Session::get('nom_tuteur') }}  
                                     {{ Session::get('prenom_tuteur') }}
                                    </span>
                                </a>

                                <ul class="children sub-menu" y="2" >
                                    <li  class="  "><a title="" href="{{route('modifierProfile', Session::get('tuteur_id'))}}"> حسابي  </a></li>
                                    <li  class="  "><a title="" href="{{url('/se_deconnecter')}}">خروج</a></li>
                                </ul>
                            @else
                                <a title="" href="{{url('/se_connecter')}}"> حسابي  </a>
                            @endif
                            </li>
                        </ul>
                        
                    </div>
                    <!--Responsive Menu END-->

                    <!-- Kode navigation starts -->
                    <nav class="navigation" id="trans-nav">
                        <ul id="" class="nav-menu"  >
                            <li  class="activeA p-331  active"><a title="" href="{{url('/')}}">الرئيسية </a></li>
                            <li  class=" p-3112  "> <a title="" href="{{url('/about')}}">من نحن </a></li>
                            
                            <li>
                                <a title="" class="" href="{{url('/autisme')}}">فهم التوحد </a>
                               
                            </li>
                            
                            <li>
                                <a title="" href="{{url('/projets')}}">مشاريعنا </a>
  
                            </li>
                            <li  class=" p-3133  "><a title="" href="{{url('/nosInfos')}}">أخبارنا </a></li>
                            

                        <li><a title="" href="{{url('/nosActivites')}}">أنشطتنا</a></li>
                        
                        <li  class="  "> <a title="" href="{{url('/nosPhotos')}}">صورنا</a>  </li>
                        
                            <li><a title="" href="{{url('/partenaires')}}">شركاؤنا  </a></li>    
                       
                            <li>
                            @if(Session::has('nom_tuteur') && Session::has('prenom_tuteur'))
                                <a title="" href="{{url('/se_connecter')}}">
                                    <span style="color:#f05074;">
                                    {{Session::get('nom_tuteur') }} <br> 
                                     {{ Session::get('prenom_tuteur') }}
                                    
                                    </span>
                                </a>

                                <ul class="children sub-menu" y="2" >
                                    <li  class="  "><a title="" href="{{route('modifierProfile', Session::get('tuteur_id'))}}"> حسابي  </a></li>
                                    <li  class="  "><a title="" href="{{url('/se_deconnecter')}}">خروج</a></li>
                                </ul>
                            @else
                                <a title="" href="{{url('/se_connecter')}}"> حسابي  </a>
                            @endif
                                
                            </li>
                         </ul>
                    </nav>

                </div>
            </div>
            <!--Header top row ends-->

            <!--Header nav row ends-->
        </div>
    </div>
</header>
