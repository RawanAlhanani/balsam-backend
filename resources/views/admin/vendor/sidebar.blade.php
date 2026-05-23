
<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">المسجلين في الموقع</span></a>
          <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('tuteurs')}}" data-i18n="nav.dash.crypto"> أولياء الأمور وأبناؤهم</a>
            </li>
          </ul>
        </li>
        <!-- activites -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">الأنشطة</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{route('activites')}}" data-i18n="nav.dash.crypto">جميع الأنشطة</a>
            </li>
            <li><a class="menu-item" href="{{route('addActivite')}}" data-i18n="nav.dash.crypto">إضافة نشاط</a>
            </li>
          </ul>
        </li>
        <!-- infos -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">الأخبار</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('infos')}}" data-i18n="nav.dash.crypto">جميع الأخبار</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addInf')}}" data-i18n="nav.dash.crypto">إضافة خبر</a>
            </li>
          </ul>
        </li>

        <!-- partenaires -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">الشركاء</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('partenaires')}}" data-i18n="nav.dash.crypto">جميع الشركاء</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addPartenaire')}}" data-i18n="nav.dash.crypto">إضافة شريك</a>
            </li>
          </ul>
        </li>
        
        <!-- images principales -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">الصورة الرئيسية</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('imagesprincipales')}}" data-i18n="nav.dash.crypto">جميع الصور الرئيسية</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addImagesPrincipales')}}" data-i18n="nav.dash.crypto">إضافة صور رئيسية</a>
            </li>
          </ul>
        </li>
        
         <!-- images expo -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">معرض الصور</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('imagesexpos')}}" data-i18n="nav.dash.crypto">جميع الصور </a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addImageExpo')}}" data-i18n="nav.dash.crypto">إضافة صور </a>
            </li>
          </ul>
        </li>
        
        <!-- pages autisme -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">صفحات التوحد</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('pagesautisme')}}" data-i18n="nav.dash.crypto">جميع الصفحات</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addPageAutisme')}}" data-i18n="nav.dash.crypto">إضافة صفحة</a>
            </li>
          </ul>
        </li>
        
         <!-- pages من نحن -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">من نحن</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('aboutuses')}}" data-i18n="nav.dash.crypto">جميع الصفحات</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addAboutUs')}}" data-i18n="nav.dash.crypto">إضافة صفحة</a>
            </li>
          </ul>
        </li>
        
        <!-- pages مشاريعنا  -->
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">مشاريعنا</span></a>
          <ul class="menu-content">
            <li class=""><a class="menu-item" href="{{route('projets')}}" data-i18n="nav.dash.crypto">جميع الصفحات</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addProjet')}}" data-i18n="nav.dash.crypto">إضافة صفحة</a>
            </li>
          </ul>
        </li>

        
        <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">إعدادات</span></a>
          <ul class="menu-content">

            <!-- types activites -->
            <li class=""><a class="menu-item" href="{{route('types')}}" data-i18n="nav.dash.crypto">جميع أنواع الأنشطة</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addType')}}" data-i18n="nav.dash.crypto">إضافة نوع نشاط</a>
            </li>

            <!-- regions -->
            <li class=""><a class="menu-item" href="{{route('regions')}}" data-i18n="nav.dash.crypto">جميع المناطق</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addRegion')}}" data-i18n="nav.dash.crypto">إضافة منطقة</a>
            </li>

            <!-- specialites -->
            <li class=""><a class="menu-item" href="{{route('doctors')}}" data-i18n="nav.dash.crypto">جميع الإختصاصات</a>
            </li>
            <li class=""><a class="menu-item" href="{{route('addDoctor')}}" data-i18n="nav.dash.crypto">إضافة اختصاص</a>
            </li>
          </ul>
        </li>

       
      </ul>
    </div>
</div>
