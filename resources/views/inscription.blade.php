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
    <section>
        <div class="container">
            <div class="eco_contact_form">
                <div class="row">
                    <div class="col-md-8 no-padding col-sm-12 responsive-991-width">
                        <form action="{{route('PostInscription')}}" enctype="multipart/form-data" method="post" id="form">

                            <!-- la bare bleu  -->
                            <div class="progress-names">
                                <div class="progress-wrap progress" data-progress-percent="55">
                                    <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                </div>
                            </div>

                            <div class="your-submit-message">
                                <h4 class="eco_sm_titles">معلومات شخصية عن الطفل التوحدي</h4>
                                <div>
                                    <div class="row">

                                <!-- nom enfant -->
                                        <div class="form-group col-md-6">
                            <input type="text" value="{{ old('nom_enfant') }}" name="nom_enfant" placeholder="الاسم العائلي للطفل" class="@error('nom_enfant') is-invalid @enderror form-control"/>

                                @error('nom_enfant')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                <!-- prenom enfant -->
                                        <div class="form-group col-md-6">
                            <input type="text" name="prenom_enfant" placeholder="الاسم الشخصي للطفل" class="form-control" value="{{ old('prenom_enfant') }}"/>

                            @error('prenom_enfant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                        </div>

                                <!-- date naissance -->
                                        <div class="form-group col-md-6">
                                            <p class="droite">تاريخ الازدياد :</p>
                            <input type="date" name="date_naissance"  class="form-control" value="{{ old('date_naissance') }}"/>

                            @error('date_naissance')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                        </div>

                                <!-- photo -->

                                        <div class="form-group col-md-6">
                                            <p class="droite">حمل صورة للطفل :</p>
                            <input type="file" name="photo" class="form-control-file" />
                                        </div>

                                <!-- sexe enfant -->
                                        <div class="form-group col-md-6">
                                            <p class="droite">الجنس :</p>
                                                <div class="col-md-3">
                                                    <label for="fille">
                            <input id="fille" class="form-control" type="radio" name="sexeEnfant" value="1" {{ (old("sexeEnfant") == "1" ? "checked":"") }}> أنثى  </label>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="garcon"><input class="form-control"  id="garcon" type="radio" name="sexeEnfant" value="2" {{ (old("sexeEnfant") == "2" ? "checked":"") }}> ذكر  </label>
                                                </div>

                            @error('sexeEnfant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- la bare bleu  -->
                            <div class="progress-names">
                                <div class="progress-wrap progress" data-progress-percent="40">
                                    <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                </div>
                            </div>

                            <div class="your-submit-message">
                                <h4 class="eco_sm_titles">معلومات عن وضعية الطفل التوحدي</h4>
                                <div>
                                    <div class="row">
                                <!-- etat enfant -->
                                        <div class="form-group col-md-6">
                    <select  dir="rtl" class="form-control" name="statut"  required>
                        <option selected disabled> - اختر حالة الطفل - </option>
                        <option value="1" {{ (old("statut") == 1 ? "selected":"") }}>
                            توحد خفيف</option>
                        <option value="2" {{ (old("statut") == 2 ? "selected":"") }}>
                             توحد متوسط </option>
                        <option value="3" {{ (old("statut") == 3 ? "selected":"") }}>
                             توحد شديد </option>
                      </select>

                    @error('statut')
                        <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                    @enderror
                                        </div>

                                        <br><br>
                            <!-- parole enfant -->
                                        <div class="form-group col-md-6">
                    <select dir="rtl" class="form-control" name="parole">
                        <option selected disabled>
                             - اختر كلام الطفل - </option>
                        <option value="1" {{ (old("parole") == 1 ? "selected":"") }}>
                            غير متكلم</option>
                        <option value="2" {{ (old("parole") == 2 ? "selected":"") }}>
                            يصدر بعض الأصوات</option>
                        <option value="3" {{ (old("parole") == 3 ? "selected":"") }}>
                            يتكلم بعض الكلمات</option>
                        <option value="4" {{ (old("parole") == 4 ? "selected":"") }}>
                            يتكلم</option>
                    </select>
                    @error('parole')
                        <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                    @enderror
                                        </div>

                                        <br><br><br>
                                 <!-- Specialites enfant -->
                                        <div class="form-group col-md-12">
                                            <p class="droite">هل يتابع الطفل عند أحد التخصصات الطبية أو شبه الطبية؟</p>
                                            <br>
                                            <div class="" >
                        @foreach ($specialites as $item)
                             <div class="col-md-3">
                                <label>
        <input type="checkbox" name="doctor[]" value="{{$item->id}}" @if( is_array(old('doctor')) && in_array($item->id, old('doctor'))) checked @endif>
        {{$item->specialite}}
                                </label>
                            </div>
                        @endforeach


                                            </div>

                                        </div>


                                        <br><br><br>

                                    <!-- accompagnant enfant -->
                                        <div class="form-group col-md-6">
                                                <p class="droite">هل للطفل مرافق :</p>
                                                <div class="col-md-3">
                                                <label>
                                                    <input type="radio" name="avs" value="1" {{ (old("avs") == 1 ? "checked":"") }}> 
                                                نعم  </label>
                                            </div>
                                            <div class="col-md-3">
                                                <label>
                                                    <input type="radio" name="avs" value="2" {{ (old("avs") == 2 ? "checked":"") }}>
                                                لا  </label>
                                            </div>

                                                @error('avs')
                        <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                    @enderror

                                        </div>

                                        <!-- etude enfant -->
                                        <div class="form-group col-md-6">
                                            <p class="droite">هل الطفل متمدرس :</p>
                                            <div class="col-md-3">
    <label><input type="radio" name="etude" value="1" {{ (old("etude") == 1 ? "checked":"") }}>
                                                    نعم</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label><input type="radio" name="etude" value="2" {{ (old("etude") == 2 ? "checked":"") }}>
                                                    لا</label>
                                            </div>
                    @error('etude')
                        <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                    @enderror

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- la bare bleu  -->
                            <div class="progress-names">
                                <div class="progress-wrap progress" data-progress-percent="60">
                                    <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                </div>
                            </div>

                            <div class="your-submit-message">
                                <h4 class="eco_sm_titles">معلومات عن ولي أمر الطفل</h4>
                                <div>
                                    <div class="row">
                                        <!-- nom tuteur -->
                                        <div class="form-group col-md-6">
                                            <input type="text" name="nom_tuteur" placeholder="الاسم العائلي " class="form-control" value="{{ old('nom_tuteur')  }}" />
                                            @error('nom_tuteur')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <!-- prenom tuteur -->
                                        <div class="form-group col-md-6">
                                            <input type="text" name="prenom_tuteur" placeholder=" الاسم الشخصي " class="form-control" value="{{ old('prenom_tuteur')  }}" />
                                            @error('prenom_tuteur')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- CIN tuteur -->
                                        <div class="form-group col-md-6">
                                            <input type="text" name="CIN" placeholder=" رقم البطاقة الوطنية " class="form-control" value="{{ old('CIN')  }}" />
                                            @error('CIN')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- adresse tuteur -->

                                        <div class="form-group col-md-6">
                                            <input type="text" name="adresse" placeholder=" عنوان السكن" class="form-control" value="{{ old('adresse')  }}"/>
                                            @error('adresse')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- email tuteur -->
                                        <div class="form-group col-md-6">
                                            <input dir="ltr" type="mail" name="email_tuteur" required="" placeholder="البريد الإلكتروني" class="form-control" 
                                            value="{{ old('email_tuteur')  }}"/>
                                            @error('email_tuteur')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- region tuteur -->
                                        <div class="form-group col-md-6">

                                            <select dir="rtl" class="form-control"  name="region">
                                                <option selected disabled>- اختر المنطقة -</option>
                                                @foreach ($regions as $item)
                <option value="{{$item->id}}" {{(old('region') == $item->id ? 'selected' : '') }} >{{$item->nom_region}}</option>
                                                @endforeach 
                                               
                                            </select>
                                            @error('région')
                                            <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <!-- telephone tuteur -->
                                        <div class="form-group col-md-6">
                                            <input type="number" name="telephon" placeholder=" رقم الهاتف" class="form-control" value="{{ old('telephon')  }}"/>
                                            @error('telephon')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- whatsup tuteur -->
                                        <div class="form-group col-md-6">
                                            <input type="number" name="whatsapp" placeholder="رقم الواتساب" class="form-control" value="{{ old('whatsapp') }}"/>
                                            @error('whatsapp')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- type tuteur -->
                                        <div class="form-group col-md-6">
                                            <p class="droite">نوع القرابة</p>
                                            <div class="col-md-3">
                                                <label><input type="radio" name="type_Tuteur" value="1" {{ (old("type_Tuteur") == 1 ? "checked":"") }}> أب </label>
                                            </div>
                                            <div class="col-md-3">
                                                <label><input type="radio" name="type_Tuteur" value="2" {{ (old("type_Tuteur") == 2 ? "checked":"") }}> أم </label>
                                            </div>
                                            <div class="col-md-3">
                                                <label><input type="radio" name="type_Tuteur" value="3" {{ (old("type_Tuteur") == 3 ? "checked":"") }}> آخر </label>
                                            </div>
                                            @error('type_tuteur')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- formation tuteur -->
                                        <div class="form-group col-md-6">
                                            <p class="droite">هل خضعتم لأي تكوين حول التوحد :</p>
                                            <div class="col-md-3">
                                                <label><input type="radio" name="formation" value="1" {{ (old("formation") == "1" ? "checked":"") }}> نعم </label>
                                            </div>

                                            <div class="col-md-3">
                                <label><input cla type="radio" name="formation" value="2" {{ (old("formation") == 2 ? "checked":"") }}> لا </label>
                                            </div>
                                        @error('formation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- la bare bleu  -->
                            <div class="progress-names">
                                <div class="progress-wrap progress" data-progress-percent="80">
                                    <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                </div>
                            </div>


                            <div class="your-submit-message">
                                <h4 class="eco_sm_titles">إنشاء حساب</h4>
                                <div>
                                    <div class="row">
                                        <!-- login -->
                                        <div class="form-group col-md-6">
                                            <input type="text" dir="ltr" name="nom_utilisateur" placeholder=" اسم المستخدم " class="form-control" value="{{ old('nom_utilisateur') }}"/>

                                            @error('nom_utilisateur')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                         <!-- mot de passe -->
                                        <div class="form-group col-md-6">
                                            <input type="password" dir="ltr" name="mot_de_pass" placeholder="كلمة السر (8 أحرف كحد أدنى)" class="form-control" value="{{ old('mot_de_pass') }}"/>

                                            @error('mot_de_pass')
                                            <div class="alert alert-danger" style="margin-top: 20px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- la bare bleu  -->
                            <div class="progress-names">
                                <div class="progress-wrap progress" data-progress-percent="100">
                                    <div class="progress-bar progress " style="width:النصف الأول%;"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn-small xsmall-btn">أرسل</button>
                            <br><br>

                            @csrf
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </section>
</div>
<!--Eco content ends-->

@endsection

@section('js')


  <script>
        $(document).ready(function () {
        $('#form').validate({ 
            rules: {
                nom_enfant: {required: true},
                prenom_enfant: {required: true},
                nom_tuteur:{required: true},
                prenom_tuteur:{required: true},
                CIN : {required : true},
                adresse : {required : true},
                region : {required : true},
                email_tuteur : {email : true},
                telephon : {required : true},
                whatsapp : {required : true},
                nom_utilisateur : {required : true},
                mot_de_pass : {required :true},
                // Message Enfant
                nom_enfant : {required : true},
                prenom_enfant : {required : true},
                date_naissance : {required : true},
                sexeEnfant : {required : true},
        //    "photo"=>"required",
                statut : {required: true},
                parole : {required : true},
                avs : {required : true},
                etude : {required : true},
                type_Tuteur : {required : true},
                formation : {required : true}
            },
//البريد الإلكتروني إلزامي !
            messages: {
                    nom_tuteur : "  الاسم الشخصي إلزامي ! ",
                    prenom_tuteur : "الاسم العائلي إلزامي !",
                    CIN : "رقم البطاقة الوطنية إلزامي !",
                    adresse : "عنوان السكن إلزامي !",
                    region : "المنطقة إلزامية !",
                    email_tuteur : "البريد الإلكتروني غير صحيح.",
                    telephon : "رقم الهاتف إلزامي !",
                    whatsapp : "رقم الواتساب إلزامي !",
                    nom_utilisateur : "اسم المستخدم إلزامي !",
                    mot_de_pass : "كلمة السر إلزامية !",
                // Message Enfant
                    nom_enfant : " الاسم الشخصي للطفل إلزامي !",
                    prenom_enfant : " الاسم العائلي للطفل إلزامي !",
                    date_naissance : " تاريخ الازدياد إلزامي !",
                    photo : "   صورة الطفل إلزامية !",
                    statut : "   حالة الطفل إلزامية !",
                    parole : "    إلزامي !",
                    sexeEnfant : "    إلزامي !",
                    formation : "    إلزامي !",
                    whatsapp : "    إلزامي !",
                    avs : "    إلزامي !",
                    etude : "    إلزامي !",
                    type_Tuteur : "    إلزامي !",
                    formation : "    إلزامي !"
                },

              errorElement: 'span',
              errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                error.addClass('alert');
                error.addClass('alert-danger');
                element.closest('.form-group').append(error);
              },
              highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
              }
        });
    });
    </script> 
    @endsection
