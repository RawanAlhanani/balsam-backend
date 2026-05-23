@extends('admin.master')


@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Form wzard with step validation section start -->
            <section id="validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3><strong>   تعديل المعلومات عن المستخدم </strong></h3>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                                </div>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form method="post" action="{{route('PostEditTuteur')}}" class="steps-validation wizard-notification" enctype="multipart/form-data" >
                                        <input type="hidden" name="id" value="{{$enfant->id}}">
                                        <input type="hidden" name="id_tuteur" value="{{$enfant->tuteur->id}}">
                                        @csrf
                                        <!-- Step 1 -->
                                        <h6>معلومات شخصية عن الطفل التوحدي</h6>
                                        <fieldset>
                                            <div class="row">
                                                <!-- nom enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstName3">
                                                            الاسم الشخصي للطفل:
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->prenom_enfant}}" type="text" class="form-control required" id="firstName3"
                                                        name="nom_enfant" placeholder="الاسم الشخصي للطفل">
                                                    </div>
                                                </div>
                                                <!-- prenom enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastName3">
                                                            الاسم العائلي للطفل:
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->nom_enfant}}" type="text" class="form-control required"
                                                        placeholder="الاسم العائلي للطفل" id="lastName3" name="prenom_enfant">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- date naissance -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">تاريخ الازدياد :</label>
                                                        <input value="{{$enfant->date_naissance}}" type="date" name="date_naissance" class="form-control required" id="date3"/>
                                                    </div>
                                                </div>
                                                <!-- photo enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <p class="droite">حمل صورة للطفل :</p>
                                                        <input type="file" name="photo"  class="form-control-file" />
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Sexe enfant -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                            الجنس :
                                                            </label>
                                                            <div class="controls">
                                                                <div class="skin skin-square">
    <input type="radio" value="1" name="sexeEnfant" id="radio1" {{$enfant->sexeEnfant == 1 ? "checked" : "" }}>
                                                                    <label for="radio1"> أنثى</label>
                                                                </div>
                                                                <div class="skin skin-square">
    <input type="radio" value="2" name="sexeEnfant" id="radio2" {{$enfant->sexeEnfant == 2 ? "checked" : "" }}>
                                                                    <label for="radio2">ذكر </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <!-- la photo -->
                                                <div class="col-md-6">
                                                    <blockquote class="blockquote pl-1 border-left-red border-left-3 mt-1">
                                                        <div class="media-left pr-1">
                                                            <img style="width:100px!important; height: 100px !important" class="media-object img-xl" src="{{asset('storage/MesImages'.'/'.($enfant->photo != null ? $enfant->photo : 'Profile.png'))}}" alt="">
                                                        </div>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Step 2 -->
                                        <h6>معلومات عن وضعية الطفل التوحدي</h6>
                                        <fieldset>
                                            <div class="row">
                                                <!-- etat enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">
                                                            اختر حالة الطفل:
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <select  dir="rtl" class="form-control c-select required" name="statut"  required>
                                                            <option disabled> - اختر حالة الطفل - </option>
                                                            <option {{$enfant->statut == 1 ? "selected" : "" }} value="1">
                                                                توحد خفيف</option>
                                                            <option {{$enfant->statut == 2 ? "selected" : "" }} value="2">
                                                                توحد متوسط </option>
                                                            <option {{$enfant->statut == 3 ? "selected" : "" }} value="3">
                                                                توحد شديد </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Parole enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">
                                                            اختر كلام الطفل:
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <select dir="rtl" class="c-select form-control required" name="parole">
                                                            <option disabled>
                                                                - اختر كلام الطفل - </option>
                                                            <option {{$enfant->parole == 1 ? "selected" : "" }} value="1">
                                                                غير متكلم</option>
                                                            <option {{$enfant->parole == 2 ? "selected" : "" }} value="2">
                                                                يصدر بعض الأصوات</option>
                                                            <option {{$enfant->parole == 3 ? "selected" : "" }} value="3">
                                                                يتكلم بعض الكلمات</option>
                                                            <option {{$enfant->parole == 4 ? "selected" : "" }} value="4">
                                                                يتكلم</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- accompagnant enfant -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                هل للطفل مرافق :
                                                            </label>
                                                            <div class="controls">
                                                                <div class="skin skin-square">
                        <input type="radio" id="radio2"  name="avs" value="1" {{$enfant->avs == 1 ? "checked" : "" }}> 
                        <label for="radio2"> نعم</label>
                                                                </div>
                                                                <div class="skin skin-square">
                        <input type="radio"  name="avs" value="2" id="radio22" {{$enfant->avs == 2 ? "checked" : "" }}>
                                                                    <label for="radio22">لا </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <!-- etude enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="etude">
                                                            هل الطفل متمدرس :
                                                        </label>
                                                        <div class="controls">
                                                            <div class="skin skin-square">
                                                                <input type="radio" {{$enfant->etude == 1 ? 'checked' : '' }} name="etude" value="1">
                                                                <label for="radio2">نعم </label>
                                                            </div>
                                                            <div class="skin skin-square">
                                                                <input type="radio" name="etude" {{$enfant->etude == 2 ? 'checked' : '' }} value="2">
                                                                <label for="radio1"> لا</label>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <!-- specialite enfant -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>
                                                            هل يتابع الطفل عند أحد التخصصات الطبية أو شبه الطبية؟
                                                        </label>
                                                        @foreach ($specialites as $item)
                                                            <div class="col-md-6">
                                                                <label>
    <input @if( is_array($mesDocs) && in_array($item->id, $mesDocs)  ) checked @endif
                                                                 type="checkbox" name="doctor[]" value="{{$item->id}}">

                                                            {{$item->specialite}}

                                                        </label>  
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Step 3 -->
                                        <h6>معلومات عن ولي أمر الطفل</h6>
                                        <fieldset>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <!-- nom tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            الاسم العائلي :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->nom_tuteur}}" type="text" name="nom_tuteur" placeholder="الاسم العائلي " class="form-control required"/>
                                                    </div>
                                                     
                                                    <!-- CIN tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            رقم البطاقة الوطنية :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->CIN}}" type="text" name="CIN" placeholder=" رقم البطاقة الوطنية " class="form-control required"/>
                                                    </div>
                                                    <!-- email tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            البريد الإلكتروني :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->email_tuteur}}"  type="text" name="email_tuteur" placeholder="البريد الإلكتروني" class="form-control required"/>
                                                    </div>
                                                    <!-- telephone tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            رقم الهاتف :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->telephon}}" type="phone" name="telephon" placeholder=" رقم الهاتف" class="form-control required"/>
                                                    </div>
                                                    <!-- lien tuteur -->
                                                    <div class="form-group">
                                                        <label for="">القرابة  </label>
                                                        <div class="controls">
                                                            <div class="skin skin-square">
                                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 1 ? 'checked' : '' }} name="type_Tuteur" value="1" > أب </label>
                                                            </div>
                                                            <div class="skin skin-square">
                                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 2 ? 'checked' : '' }} name="type_Tuteur" value="2"> أم  </label>
                                                            </div>
                                                            <div class="skin skin-square">
                                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 3 ? 'checked' : '' }} name="type_Tuteur" value="3"> آخر  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- prenom tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                             الاسم الشخصي :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->prenom_tuteur}}" type="text" name="prenom_tuteur" placeholder=" الاسم الشخصي " class="form-control required"/>
                                                    </div>
                                                    <!-- adresse tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            عنوان السكن :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->adresse}}" type="text" name="adresse" placeholder=" عنوان السكن" class="form-control required"/>
                                                    </div>
                                                    <!-- region tuteur -->
                                                    <div class="form-group">
                                                        <label for="">
                                                            اختر المنطقة:
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <select dir="rtl" class="c-select form-control required"  name="region_id" required>
                                                            <option selected disabled>
                                                                - اختر المنطقة -</option>
                                                           @foreach ($regions as $item)
                <option value="{{$item->id}}" {{$enfant->Tuteur->region_id == $item->id ? 'selected' : '' }} >{{$item->nom_region}}</option>
                                                @endforeach 
                                                        </select>
                                                    </div>
                                                    <!-- whatsapp tuteur -->
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            رقم الواتساب :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->whatsapp}}"  type="tel" name="whatsapp" placeholder="رقم الواتساب" class="form-control required"/>
                                                    </div>
                                                     <!-- formation tuteur -->
                                                    <div class="form-group">
                                                        <label for="">
                                                            هل خضعتم لأي تكوين حول التوحد :
                                                        </label>
                                                        <div class="controls">
                                                            <div class="skin skin-square">
                                                               <label><input type="radio" name="formation" value="1" checked> نعم  </label>
                                                            </div>
                                                            <div class="skin skin-square">
                                                                <label><input type="radio" name="formation" value="2"> لا  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Step 4 -->
                                        <h6>إنشاء حساب</h6>
                                        <fieldset>
                                            <div class="row">
                                                <!-- login -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">
                                                            اسم المستخدم :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input dir="ltr" value="{{$enfant->Tuteur->nom_utilisateur}}" type="text" name="nom_utilisateur" placeholder=" اسم المستخدم " class="form-control required"/>
                                                    </div>
                                                </div>
                                                <!-- mot de passe -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">
                                                            كلمة السر :
                                                        <span class="danger">*</span>
                                                        </label>
                                                        <input value="{{$enfant->Tuteur->mot_de_pass}}" name="mot_de_pass" placeholder="كلمة السر " class="form-control"/>
                                                    </div>
                                                </div>


                                            </div>
                                            <ul class="pl-0 list-unstyled">
    <li class="mb-1" style="float: left;">
        <button type="submit" class="btn btn-primary btn-block">Modifier</button>
    </li> 
</ul>
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Form wzard with step validation section end -->
        </div>
    </div>
</div>


@endsection


@section('links')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/plugins/forms/wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/plugins/pickers/daterange/daterange.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/css-rtl/plugins/forms/switch.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <!-- END VENDOR CSS-->

@endsection

@section('scripts')

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('/backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.flash.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/backend/app-assets/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/backend/app-assets/vendors/js/extensions/jquery.steps.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/backend/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('/backend/app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}" type="text/javascript"></script>

    <script src="{{asset('/backend/app-assets/js/scripts/forms/wizard-steps.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/js/scripts/forms/validation/form-validation.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@append
