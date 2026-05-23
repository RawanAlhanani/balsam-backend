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
                <h3><b>أخبار جمعية بلسم</b>   </h3>
                <h6>نبذل قصارى جهدنا لخدمتكم</h6>
                <span><i class="icon-nature-2"></i></span>
            </div>
            <!--Eco services-->
            <div class="eco_featured_causes">
                <div class="row">
                    <!--Eco services flip colums-->
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/54-1-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="{{url('/news1')}}"> انطلاق أنشطة بلسم في مقرها الجديد  </a></h5>
                                        <p>انطلقت أنشطة جمعية بلسم لذوي التوحد
                                         في مقرها الجديد ب ...</p>
                                         <a href="{{url('/news1')}}" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/54-2-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="{{url('/news2')}}">انطلاق ورشات في موضوع "التغذية و التوحد"</a></h5>
                                        <p>
                                            مشاكل اللغة و التواصل و النطق و مخارج
                                             الحروف ... </p>
                                         <a href="{{url('/news2')}}" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/54-3-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="{{url('/news3')}}">انطلاق حصص تقويم النطق</a></h5>
                                        <p>
                                            تطرح تغذية الطفل التوحدي مشاكل عدة في نوعية
                                             محتويات الوجبات، إلى  ...</p>
                                         <a href="{{url('/news3')}}" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/ashampoo_snap_2020.06.23_15h12m47s_002_-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d9%82%d8%a7%d8%a8%d9%84%d8%a9.html">مقابلة لمدير مركز بلسم مع راديو فرش ضمن برنامج نقطة وصل</a></h5>
                                        <p>مقابلة لمدير مركز&nbsp;#بلسم&nbsp;للأطراف الصناعية وتقويم العظام مع&nbsp;راديو فرش Radio F...</p>
                                         <a href="%d9%85%d9%82%d8%a7%d8%a8%d9%84%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/98056519_959645234474780_3080725027184705536_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d8%b4%d8%b1%d9%88%d8%b9-%d9%85%d8%b5%d8%ba%d8%b1-%d9%8a%d8%b3%d8%aa%d9%87%d8%af%d9%81-12-%d9%85%d8%b5%d8%a7%d8%a8-%d8%a8%d8%aa%d8%b1.html">مشروع مصغر يستهدف 12 مصاب بتر</a></h5>
                                        <p>بدعم من جمعية "مرج دابق للأعمال الإنسانية"، أطلقت&nbsp;#منظمة_بلسم&nbsp;مشروع مصّغر يستهدف...</p>
                                         <a href="%d9%85%d8%b4%d8%b1%d9%88%d8%b9-%d9%85%d8%b5%d8%ba%d8%b1-%d9%8a%d8%b3%d8%aa%d9%87%d8%af%d9%81-12-%d9%85%d8%b5%d8%a7%d8%a8-%d8%a8%d8%aa%d8%b1.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/94402793_939411343164836_3126420137729589248_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="3340-%d9%85%d8%b3%d8%aa%d9%81%d9%8a%d8%af-%d9%85%d9%86-%d9%85%d9%86%d8%b8%d9%88%d9%85%d8%a9-%d8%a7%d9%84%d8%b9%d9%8a%d8%a7%d8%af%d8%a7%d8%aa-%d8%a7%d9%84%d9%85%d8%aa%d9%86%d9%82%d9%84%d8%a9.html">3340 مستفيد من منظومة العيادات المتنقلة</a></h5>
                                        <p>#انفوجرافيكخلال 30 يوم من عمل منظومة العيادات المتنقلة استفاد 3340 شخص من الخدمات المقدمة....</p>
                                         <a href="3340-%d9%85%d8%b3%d8%aa%d9%81%d9%8a%d8%af-%d9%85%d9%86-%d9%85%d9%86%d8%b8%d9%88%d9%85%d8%a9-%d8%a7%d9%84%d8%b9%d9%8a%d8%a7%d8%af%d8%a7%d8%aa-%d8%a7%d9%84%d9%85%d8%aa%d9%86%d9%82%d9%84%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/91024775_919901951782442_3267843528067121152_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d8%b4%d8%b1%d9%88%d8%b9-%d8%a7%d9%84%d8%b9%d9%8a%d8%a7%d8%af%d8%a7%d8%aa-%d8%a7%d9%84%d9%85%d8%aa%d9%86%d9%82%d9%84%d8%a9.html">مشروع العيادات المتنقلة</a></h5>
                                        <p>أطلقت&nbsp;#منظمة_بلسم&nbsp;بالتعاون مع جمعية "مرج دابق للأعمال الإنسانية" مشروع&nbsp;#الع...</p>
                                         <a href="%d9%85%d8%b4%d8%b1%d9%88%d8%b9-%d8%a7%d9%84%d8%b9%d9%8a%d8%a7%d8%af%d8%a7%d8%aa-%d8%a7%d9%84%d9%85%d8%aa%d9%86%d9%82%d9%84%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/25587-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%b4%d8%a7%d9%87%d8%af-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85..html">شاهد | مركز بلسم.. قصة نجاح</a></h5>
                                        <p>أكثر من 231 طرف صناعيأكثر من 156 جبيرة بلاستيكيةأكثر من 480 جلسة إستشارة عظميةأكثر من 486 ...</p>
                                         <a href="%d8%b4%d8%a7%d9%87%d8%af-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85..html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/84417851_882261288879842_8803451821604470784_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%b4%d8%a7%d9%87%d8%af-%d8%ab%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d8%a7%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b3%d9%88%d8%b3%d9%86.html">شاهد | قصة نجاح الطفلة "سوسن"</a></h5>
                                        <p>تخريج الطفلة "سوسن" بعد حصولها على طرف صناعي، وإنهاء كافة تدريباتها في مركز&nbsp;#بلسم&nbs...</p>
                                         <a href="%d8%b4%d8%a7%d9%87%d8%af-%d8%ab%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d8%a7%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b3%d9%88%d8%b3%d9%86.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/83241567_872382476534390_9172088933339627520_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%b4%d8%a7%d9%87%d8%af-%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%b3%d8%b9%d8%af.html">شاهد | قصة نجاح الطفل "سعد"</a></h5>
                                        <p>#شاهد&nbsp;|&nbsp;#قصة_نجاح
                                        أصبح "سعد" جاهزاً لمتابعة دراسته، وممارسة هواياته، واللعب مع ...</p>
                                         <a href="%d8%b4%d8%a7%d9%87%d8%af-%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%b3%d8%b9%d8%af.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/82344190_871782256594412_4886089194046226432_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%88%d8%b1%d8%b4%d8%a9-%d8%aa%d8%b5%d9%86%d9%8a%d8%b9-%d8%a7%d9%84%d8%a3%d8%b7%d8%b1%d8%a7%d9%81-%d8%a7%d9%84%d8%b5%d9%86%d8%a7%d8%b9%d9%8a%d8%a9-%d9%81%d9%8a-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85.html">ورشة تصنيع الأطراف الصناعية في مركز بلسم</a></h5>
                                        <p>تجهيز بعض الأطراف الصناعية ضمن ورشة التصنيع في مركز&nbsp;#بلسم، والتي ستقدم لثمانية مصابي ...</p>
                                         <a href="%d9%88%d8%b1%d8%b4%d8%a9-%d8%aa%d8%b5%d9%86%d9%8a%d8%b9-%d8%a7%d9%84%d8%a3%d8%b7%d8%b1%d8%a7%d9%81-%d8%a7%d9%84%d8%b5%d9%86%d8%a7%d8%b9%d9%8a%d8%a9-%d9%81%d9%8a-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/80528175_848618252244146_2496396818212978688_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b3%d9%88%d8%b3%d9%86.html">الطفلة "سوسن" تبدأ رحلة العلاج في مركز بلسم</a></h5>
                                        <p>الطفلة "سوسن" ذات الـ 6 سنوات، فقدت قدمها اليسرى بسبب قصف الطيران لمنزلهم في مدينة&nbsp;#إ...</p>
                                         <a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b3%d9%88%d8%b3%d9%86.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/81345513_848616182244353_5749432175216820224_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%b3%d8%b9%d8%af.html">الطفل "سعد" في مرحلة التقييم بمركز بلسم</a></h5>
                                        <p>الطفل "سعد" بترت قدمه اليسرى بسبب قصف الطيران لقريته، ولم يعد قادراً على الذهاب إلى المدرس...</p>
                                         <a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%b3%d8%b9%d8%af.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/80483086_848614512244520_6939039443630161920_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%b9%d9%85-%d8%ae%d8%b7%d8%a7%d8%a8-%d9%8a%d8%a8%d8%af%d8%a3-%d9%85%d8%b1%d8%ad%d9%84%d8%a9-%d8%a7%d9%84%d9%82%d9%8a%d8%a7%d8%b3.html">العم "خطاب" يبدأ مرحلة القياس وتجهيز الطرف الصناعي</a></h5>
                                        <p>العم "خطاب" تعرض لبتر طرف أيمن أعلى الركبة نتيجة قصف الطيران، لا يستطيع العمل وإعالة أسرته...</p>
                                         <a href="%d8%a7%d9%84%d8%b9%d9%85-%d8%ae%d8%b7%d8%a7%d8%a8-%d9%8a%d8%a8%d8%af%d8%a3-%d9%85%d8%b1%d8%ad%d9%84%d8%a9-%d8%a7%d9%84%d9%82%d9%8a%d8%a7%d8%b3.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/81023584_847756502330321_4727230147747381248_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%ab%d9%85%d8%a7%d9%86%d9%8a%d8%a9-%d9%85%d8%b5%d8%a7%d8%a8%d9%8a%d9%86-%d9%8a%d8%a8%d8%af%d8%a3%d9%88%d9%86.html">ثمانية مصابين يبدؤون رحلة العلاج مع بلسم</a></h5>
                                        <p>مصابون يبدؤون رحلة العلاج في مركز بلسم للأطراف الصناعية وتقويم العظام ضمن مشروع مصغّر يسته...</p>
                                         <a href="%d8%ab%d9%85%d8%a7%d9%86%d9%8a%d8%a9-%d9%85%d8%b5%d8%a7%d8%a8%d9%8a%d9%86-%d9%8a%d8%a8%d8%af%d8%a3%d9%88%d9%86.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/79311420_823507091421929_6039851172213293056_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%aa%d8%b1%d9%83%d9%8a%d8%a8-%d8%ac%d8%a8%d9%8a%d8%b1%d8%a9-%d8%a8%d9%84%d8%a7%d8%b3%d8%aa%d9%8a%d9%83%d9%8a%d8%a9-%d9%84%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b4%d9%8a%d9%85%d8%a7%d8%a1.html">جانب من أعمال مركز بلسم للأطرف الصناعية وتقويم العظام</a></h5>
                                        <p>الطفلة "شيماء" أثناء صيانة الجبائر البلاستيكية في مركز #بلسم للأطراف الصناعية وتقويم العظا...</p>
                                         <a href="%d8%aa%d8%b1%d9%83%d9%8a%d8%a8-%d8%ac%d8%a8%d9%8a%d8%b1%d8%a9-%d8%a8%d9%84%d8%a7%d8%b3%d8%aa%d9%8a%d9%83%d9%8a%d8%a9-%d9%84%d9%84%d8%b7%d9%81%d9%84%d8%a9-%d8%b4%d9%8a%d9%85%d8%a7%d8%a1.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/78185521_830178417421463_1413522188639666176_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a-%d8%a7%d9%84%d8%b9%d8%a7%d8%b4%d8%b1%d8%a9.html">دورة التدبير الإسعافي العاشرة</a></h5>
                                        <p>اختتمت&nbsp;#منطمة_بلسم&nbsp;دورة&nbsp;#التدبير_الإسعافي&nbsp;العاشرة، وتم توزيع شهادات حض...</p>
                                         <a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a-%d8%a7%d9%84%d8%b9%d8%a7%d8%b4%d8%b1%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/79385218_830172734088698_1437457461559689216_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a.html">دورة التدبير الإسعافي - لجنة حماية الطفل</a></h5>
                                        <p>أقامت #منطمة_بلسم دورة في #التدبير_الإسعافي لمجموعة من المتطوعين والمتطوعات بلجنة "حماية ا...</p>
                                         <a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/33432-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%81%d9%8a%d8%af%d9%8a%d9%88%d8%ba%d8%b1%d8%a7%d9%81%d9%8a%d9%83-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85-%d9%84%d9%84%d8%a3%d8%b7%d8%b1%d8%a7%d9%81-%d8%a7%d9%84%d8%b5%d9%86%d8%a7%d8%b9%d9%8a%d8%a9.html">فيديوغرافيك | مركز بلسم للأطراف الصناعية</a></h5>
                                        <p>تعرّف على مركز بلسم للأطراف الصناعية، متى أسس، الخدمات التي يقدمها، آلية التسجيل، وبعض إحص...</p>
                                         <a href="%d9%81%d9%8a%d8%af%d9%8a%d9%88%d8%ba%d8%b1%d8%a7%d9%81%d9%8a%d9%83-%d9%85%d8%b1%d9%83%d8%b2-%d8%a8%d9%84%d8%b3%d9%85-%d9%84%d9%84%d8%a3%d8%b7%d8%b1%d8%a7%d9%81-%d8%a7%d9%84%d8%b5%d9%86%d8%a7%d8%b9%d9%8a%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/71801400_780975459008426_1023568170666950656_o-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%aa%d8%af%d8%b1%d9%8a%d8%a8%d9%8a%d8%a9.html">دورة تدريبية | التخطيط الإستراتيجي الشخصي</a></h5>
                                        <p>بهدف رفع كفاءة العاملين، أقامت&nbsp;#بلسم&nbsp;دورة في "التخطيط الإستراتيجي الشخصي" للعامل...</p>
                                         <a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%aa%d8%af%d8%b1%d9%8a%d8%a8%d9%8a%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/71478842_780971819008790_4749371408532897792_o-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%aa%d8%af%d8%b1%d9%8a%d8%a8%d9%8a%d8%a9-%d8%a3%d8%b3%d8%a7%d8%b3%d9%8a%d8%a7%d8%aa-%d8%a7%d9%84%d8%a7%d8%b3%d8%b9%d8%a7%d9%81-%d8%a7%d9%84%d8%a3%d9%88%d9%84%d9%8a.html">دورة تدريبية | أساسيات الاسعاف الأولي</a></h5>
                                        <p>استضافت&nbsp;#منظمة_بلسم&nbsp;دورة أقامتها "لجنة حماية الطفل" بمدينة&nbsp;#ترمانين، بالتنس...</p>
                                         <a href="%d8%af%d9%88%d8%b1%d8%a9-%d8%aa%d8%af%d8%b1%d9%8a%d8%a8%d9%8a%d8%a9-%d8%a3%d8%b3%d8%a7%d8%b3%d9%8a%d8%a7%d8%aa-%d8%a7%d9%84%d8%a7%d8%b3%d8%b9%d8%a7%d9%81-%d8%a7%d9%84%d8%a3%d9%88%d9%84%d9%8a.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/4542-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%81%d9%8a%d8%af%d9%8a%d9%88%d8%ba%d8%b1%d8%a7%d9%81%d9%8a%d9%83.html">فيديوغرافيك | 17 مصاب يحصلون على أطراف صناعية ويبدؤون حياة جديدة</a></h5>
                                        <p>رغم توقف الدعم عن مركز&nbsp;#بلسم&nbsp;للأطراف الصناعية منذ بداية عام 2019، لازال المركز ي...</p>
                                         <a href="%d9%81%d9%8a%d8%af%d9%8a%d9%88%d8%ba%d8%b1%d8%a7%d9%81%d9%8a%d9%83.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/7822-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d9%84%d9%85-%d9%8a%d9%83%d9%86-%d9%84%d8%af%d9%8a-%d8%af%d8%a7%d9%81%d8%b9-%d9%84%d9%84%d8%ad%d9%8a%d8%a7%d8%a9-%d8%a3%d8%a8%d8%af%d8%a7-.-%d8%aa%d9%82%d9%88%d9%84-%d9%84%d9%8a%d9%84%d9%89.html">قصة نجاح | ليلى تخطو خطوتها الأولى بعد 23 سنة</a></h5>
                                        <p>"لم يكن لدي دافع للحياة أبداً." تقول ليلى.تعاني "ليلى" من تشوه خلقي رافقها منذ ولادتها، جع...</p>
                                         <a href="%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d9%84%d9%85-%d9%8a%d9%83%d9%86-%d9%84%d8%af%d9%8a-%d8%af%d8%a7%d9%81%d8%b9-%d9%84%d9%84%d8%ad%d9%8a%d8%a7%d8%a9-%d8%a3%d8%a8%d8%af%d8%a7-.-%d8%aa%d9%82%d9%88%d9%84-%d9%84%d9%8a%d9%84%d9%89.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/66674403_729082090864430_1360388920587583488_o-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a-%d9%84%d9%85%d8%b5%d8%a7%d8%a8%d9%8a-%d8%a7%d9%84%d8%ad%d8%b1%d8%a8.html">التدبير الإسعافي لمصابي الحرب</a></h5>
                                        <p>أقامت&nbsp;#منظمة_بلسم&nbsp;الدورة التدريبية الثامنة في "التدبير الإسعافي لمصابي الحرب" بح...</p>
                                         <a href="%d8%a7%d9%84%d8%aa%d8%af%d8%a8%d9%8a%d8%b1-%d8%a7%d9%84%d8%a5%d8%b3%d8%b9%d8%a7%d9%81%d9%8a-%d9%84%d9%85%d8%b5%d8%a7%d8%a8%d9%8a-%d8%a7%d9%84%d8%ad%d8%b1%d8%a8.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/25587-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d9%85%d8%a4%d8%ab%d8%b1%d8%a9.html">قصة نجاح مؤثرة</a></h5>
                                        <p>فقد طرفيه السفليين، استشهد ولده الأول واصيب الثاني، هجّر من بيته ومدينته.. لكنه لم يستسلم ...</p>
                                         <a href="%d9%82%d8%b5%d8%a9-%d9%86%d8%ac%d8%a7%d8%ad-%d9%85%d8%a4%d8%ab%d8%b1%d8%a9.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/5-1-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%aa%d9%88%d8%a3%d9%85-%d8%ab%d9%84%d8%a7%d8%ab%d9%8a-%d9%8a%d8%b9%d9%88%d8%af-%d8%a5%d9%84%d9%89-%d8%b3%d9%88%d8%b1%d9%8a%d8%a7-%d8%a8%d8%b9%d8%af-%d8%b1%d8%ad%d9%84%d8%a9-%d8%b9%d9%84%d8%a7%d8%ac-%d8%b7%d9%88%d9%8a%d9%84%d8%a9-%d9%81%d9%8a-%d8%aa%d8%b1%d9%83%d9%8a%d8%a7.html">توأم ثلاثي يعود إلى سوريا بعد رحلة علاج طويلة في تركيا</a></h5>
                                        <p>
                                            منظمة بلسم - Balsam Organization١٦ مايو&nbsp;&middot;&nbsp;
                                            ضمن...</p>
                                         <a href="%d8%aa%d9%88%d8%a3%d9%85-%d8%ab%d9%84%d8%a7%d8%ab%d9%8a-%d9%8a%d8%b9%d9%88%d8%af-%d8%a5%d9%84%d9%89-%d8%b3%d9%88%d8%b1%d9%8a%d8%a7-%d8%a8%d8%b9%d8%af-%d8%b1%d8%ad%d9%84%d8%a9-%d8%b9%d9%84%d8%a7%d8%ac-%d8%b7%d9%88%d9%8a%d9%84%d8%a9-%d9%81%d9%8a-%d8%aa%d8%b1%d9%83%d9%8a%d8%a7.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/3_1-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d9%85%d8%ad%d9%85%d9%88%d8%af-%d8%a8%d9%8a%d9%86-%d8%a3%d9%87%d9%84%d9%87-%d9%85%d8%ac%d8%af%d8%af%d8%a7.html">الطفل محمود بين أهله مجددا</a></h5>
                                        <p>
                                        بعد 18 يوم من العلاج والمتابعة، تم تخريج الطفل "محمود عثمان" وهو بصحة جيدة من ...</p>
                                         <a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d9%85%d8%ad%d9%85%d9%88%d8%af-%d8%a8%d9%8a%d9%86-%d8%a3%d9%87%d9%84%d9%87-%d9%85%d8%ac%d8%af%d8%af%d8%a7.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/img_1394-copy-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%ae%d8%a7%d9%84%d8%af-%d9%8a%d8%a8%d8%af%d8%a3-%d8%b1%d8%ad-%d8%b9%d9%84%d8%a7%d8%ac%d9%87-%d9%84%d8%aa%d8%b1%d9%83%d9%8a%d8%a8-%d8%b7%d8%b1%d9%81-%d8%b5%d9%86%d8%a7%d8%b9%d9%8a.html">الطفل "خالد" يبدأ رحلة علاجه مع بلسم</a></h5>
                                        <p>بسبب الصعوبة في إدخال بعض الحالات الإنسانية الباردة إلى تركيا, تم صباح اليوم التنسيق مع مع...</p>
                                         <a href="%d8%a7%d9%84%d8%b7%d9%81%d9%84-%d8%ae%d8%a7%d9%84%d8%af-%d9%8a%d8%a8%d8%af%d8%a3-%d8%b1%d8%ad-%d8%b9%d9%84%d8%a7%d8%ac%d9%87-%d9%84%d8%aa%d8%b1%d9%83%d9%8a%d8%a8-%d8%b7%d8%b1%d9%81-%d8%b5%d9%86%d8%a7%d8%b9%d9%8a.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/2-350x306.png" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d8%ab%d8%a7%d9%84-%d9%84%d8%b9%d9%86%d9%88%d8%a7%d9%86-%d8%ae%d8%a8%d8%b1-%d9%86%d8%b3%d8%ae-%d9%86%d8%b3%d8%ae.html">تسليم أدوية إلى مركز ترمانين الصحي</a></h5>
                                        <p>ضمن أنشطة بلسم في الداخل السوري, تم تسليم مركز ترمانين الصحي أدوية ومستهلكات طبية بتاريخ 1...</p>
                                         <a href="%d9%85%d8%ab%d8%a7%d9%84-%d9%84%d8%b9%d9%86%d9%88%d8%a7%d9%86-%d8%ae%d8%a8%d8%b1-%d9%86%d8%b3%d8%ae-%d9%86%d8%b3%d8%ae.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 responsive-devider-50">
                        <div class="eco_flip-container">
                            <div class="flipper feature-blog">
                                <div class="front">
                                    <figure>
                                        <div class="eco-thumb">
                                            <img src="content/cache/content/upload/news/1-1-350x306.jpg" alt="" />
                                        </div>
                                    </figure>
                                    <div class="feature_blog_caption">
                                        <h5><a href="%d9%85%d8%ab%d8%a7%d9%84-%d9%84%d8%b9%d9%86%d9%88%d8%a7%d9%86-%d8%ae%d8%a8%d8%b1-%d9%86%d8%b3%d8%ae.html">الإستجابة الطارئة للمدنيين النازحين من ريفي حلب وحماة</a></h5>
                                        <p>ضمن مشروع الإستجابة الطارئة قامت الفرق الميدانية في منظمة بلسم بتأمين بعض المستلزمات الشتو...</p>
                                         <a href="%d9%85%d8%ab%d8%a7%d9%84-%d9%84%d8%b9%d9%86%d9%88%d8%a7%d9%86-%d8%ae%d8%a8%d8%b1-%d9%86%d8%b3%d8%ae.html" class="ProjectsRead">قراءة المزيد</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                        -->
                    <!--Eco services flip colums ends-->
                </div>
            </div>
        <!--Eco Template section content ends-->
    </div></section>
</div>
<!--Eco content ends-->



@endsection

@push('js')

@endpush

