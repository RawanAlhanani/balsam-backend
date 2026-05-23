@extends('admin.master')


@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <!-- File export table -->
            <section id="file-export">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">أولياء الأمور و أبناؤهم </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show table-responsive">
                                <div class="card-body card-dashboard">
                                    <table class="table table-striped table-bordered dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>الاسم العائلي </th>
                                                <th>الاسم الشخصي</th>
                                               
                                                <th>الهاتف</th>
                                                <th>الواتساب</th>
                                            <th>   تكوين  </th> 
                                            <th>رقم البطاقة الوطنية</th>
                                            <th>  العنوان </th>
                                            <th> المنطقة </th>
                                            
                                             <th>نسب الطفل </th>
                                                <th>اسم الطفل </th>
                                                <th> تاريخ الازدياد </th>
                                                <th> جنس الطفل </th>
                                                <th> حالة التوحد </th>
                                                <th> كلام الطفل </th>
                                                <th> التخصصات المتبعة </th>
                                                <th> المرافق </th>
                                                <th> متمدرس </th>
                                                <th>الصورة</th>
                                                <th>تغيير</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enfants as $item)
                                                <tr>
                                                    <td>{{$item->Tuteur->nom_tuteur}}</td>
                                                    <td>{{$item->Tuteur->prenom_tuteur}}</td>
                                                    <td>{{$item->Tuteur->telephon}}</td>
                                                    <td>{{$item->Tuteur->whatsapp}}</td>
                                                    
                                                    <td>{{ $item->Tuteur->formation == 1 ?    'نعم'  :   'لا'  }}</td>
                    <td>{{$item->Tuteur->CIN}}</td>
                    <td>{{$item->Tuteur->adresse}}</td>
                    <td>{{$item->Tuteur->Region->nom_region}}</td>
                    <td>{{$item->nom_enfant}}</td>  
                    <td>{{$item->prenom_enfant}}</td> 
                    <td>{{$item->date_naissance}}</td> 
                    <td> {{$item->sexeEnfant == 2 ? 'ذكر'  : 'أنثى'}} </td>
                     <td>{{ $item->statut == 1 ?  'توحد خفيف'  :  $item->statut =2  ? ' توحد متوسط  ' : 'توحد شديد' }} </td>
                     
                     <td> {{ $item->parole == 1 ?    'غير متكلم'  :  $item->parole ==2   ? 'يصدر بعض الأصوات'  : $item->parole == 3  ? 'يتكلم بعض الكلمات'  : ' يتكلم' }}  </td>
                    <td>  
                        @foreach($item->doctor_enfants as $doc)
                          <span>{{ $doc->doctor->specialite }}</span> 
                          <br>
                        @endforeach
                    </td> 
                  
                    <td>{{ $item->avs == 1 ?  'نعم' : 'لا'  }}</td>
                    <td>{{ $item->etude == 1 ?  'نعم' : 'لا'  }}</td>
                  
                    <td><img width="90" src="{{asset('storage/MesImages/' . ($item->photo == null ? 'Profile.png' : $item->photo ) )}}"></td>

                                                    <td class="Last">
                                                        <button id="{{$item->id}}" type="button" class="voirDetailsTuteur btn btn-round btn-primary btn-sm" data-toggle="modal" data-target="#onshow"
                                                        >تفاصيل</button>
                                                       
                                                        <a href="{{route('Edit', $item->id)}}" class="btn btn-round btn-warning btn-sm">تعديل</a>
                                                        
                                                        <button id="{{$item->id}}_{{$item->tuteur->id}}" type="button" data-toggle="modal" data-target="#supprimerTuteur" class="vouloirSupprTuteur btn btn-round btn-danger btn-sm">حذف</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Nom Tuteur</th>
                                            <th>Prenom Tuteur</th>        
                                            <th>Telephon</th>
                                            <th>Whatsapp</th>
                                            <th>Formation</th>
                                            <th>CIN</th>
                                            <th>Adresse</th>
                                            <th>Region</th>
                                            <th>Nom enfant</th>
                                            <th>Prenom enfant</th>
                                            <th>Date naissance</th>
                                            <th>Sexe</th>
                                            <th>Etat autisme</th>
                                            <th>Parole</th>
                                            <th>Specialites</th>
                                            <th>Accompagnant</th>
                                            <th>Etude</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- File export table -->
        </div>
    </div>
</div>


<!-- Voir details tuteur -->
<div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin: 1.75rem 200px 0 20px !important;">
                              <div class="modal-content" style="width:180% !important;">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel21">معلومات عن ولي الأمروالطفل</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  <form>

                                  <h5>الطفل (ة)</h5>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                    <div class="form-group row">
                                        <!-- nom enfant-->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">الإسم العائلي</span>
                                            </div>
                                            <input type="text" readonly="" id="nom_enfant" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Prenom enfant -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">الإسم الشخصي</span>
                                            </div>
                                            <input type="text" id="prenom_enfant" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- Sexe enfant   -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">جنس الطفل</span>
                                            </div>
                                            <input type="text" id="sexeEnfant" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>

                                        </fieldset>
                                        </div>

                                        <!-- Date naissane -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">تاريخ الميلاد</span>
                                            </div>
                                            <input type="text" readonly="" id="date_naissance" name="date_naissance" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <!-- Photo enfant -->
                                    
                                    <fieldset>
                                      <div class="input-group input-group-sm" style="margin-right:80px;">
                                        <img id="photo" src="" width="100px">
                                      </div>
                                    </fieldset>
                                    
                                </div>
                                        
                            </div>

                                    <div class="form-group row">
                                        <!-- Etude -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">متمدرس</span>
                                            </div>
                                            <input type="text" readonly="" id="etude" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Etat autisme enfant -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">حالة التوحد</span>
                                            </div>
                                            <input type="text" id="statut" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Parole -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">التكلم</span>
                                            </div>
                                            <input type="text" readonly="" id="parole" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        
                                        <!-- Accompagnant -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">مرافق</span>
                                            </div>
                                            <input type="text" id="avs" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Specialites -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend" style="margin-left: 10px;">
                                              <span class="input-group-text" id="sizing-addon3">تخصصات متبعة</span>
                                            </div>
                                            <div id="doctors">
                        
                                            </div>
                                        </fieldset>
                                        </div>
                                    </div>
                                    <!-- ------------------  -->
                                     <hr>
                                     <h5>ولي الأمر</h5>
                                    <div class="form-group row">
                                        <!--nom Tuteur -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">الإسم العائلي</span>
                                            </div>
                                            <input type="text" readonly="" id="nom_tuteur" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- prenom tuteur -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">الإسم الشخصي</span>
                                            </div>
                                            <input type="text" id="prenom_tuteur" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- type_tuteur -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">القرابة</span>
                                            </div>
                                            <input type="text" readonly="" id="type_Tuteur" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- CIN -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">ر.ب.و</span>
                                            </div>
                                            <input type="text" readonly="" id="CIN" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- formation -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">تكوين</span>
                                            </div>
                                            <input type="text" id="formation" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- telephone -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">الهاتف</span>
                                            </div>
                                            <input type="text" readonly="" id="telephon" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Whatsapp -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">WA</span>
                                            </div>
                                            <input type="text" id="whatsapp" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">البريد الإلكتروني</span>
                                            </div>
                                            <input type="text" id="email_tuteur" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- adresse -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">العنوان</span>
                                            </div>
                                            <input type="text" readonly="" id="adresse" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- region -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">المنطقة</span>
                                            </div>
                                            <input type="text" id="region_id" name="region_id" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- Login -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Login</span>
                                            </div>
                                            <input type="text" readonly="" id="nom_utilisateur" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- mot de passe -->
                                        <div class="col-md-4">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Mot de passe</span>
                                            </div>
                                            <input type="text" id="mot_de_pass" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>

                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>

<!-- supprimer un tuteur -->
<div class="modal fade text-left" id="supprimerTuteur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header" style="border-bottom: none !important;">
                                 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>هل تريد فعلا حذف جميع معلومات ولي الأمر؟</h5>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                                  <button id="" type="button" class="doSupprimer btn btn-outline-primary" data-dismiss="modal">تأكيد</button>
                                </div>
                              </div>
                            </div>
                          </div>

@endsection

@section('links')

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
    <script src="{{asset('/backend/app-assets/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('/backend/app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <script type="text/javascript">
        var elet = "";
       // voir details tuteurs 
    (function(window, document, $) {
    'use strict';

       $('.voirDetailsTuteur').on('click', function() {
        var id = $(this).attr("id");
    //    $('#onshow').on('show.bs.modal', function() {
            $.ajax({
               type:'GET',
               url: "getDetailsTuteur/"+id,
               dataType:'json',
            //   data:{"id":id},
               success:function(data){
                 //   $('.modal-title').text(data.enfant.tuteur.nom_tuteur + ' ' + data.enfant.tuteur.prenom_tuteur );

                     $('.modal #nom_enfant').val(data.enfant.nom_enfant);   
                     $('.modal #prenom_enfant').val(data.enfant.prenom_enfant);     
                     $('.modal #photo').attr('src', '{{ URL::asset('storage/MesImages' ) }}' + '/' + (data.enfant.photo != null ? data.enfant.photo : 'Profile.png')) ;   
                     $('.modal #sexeEnfant').val(data.enfant.sexeEnfant== 2 ?"ذكر  " : "أنثى  ");   
                     $('.modal #date_naissance').val(data.enfant.date_naissance);   
                     $('.modal #etude').val(data.enfant.etude == 1 ? "متمدرس"  : "غير متمدرس");   
                     $('.modal #statut').val(data.enfant.statut == 1 ? "توحد خفيف"  : data.enfant.statut == 2 ? "توحد متوسط " : "توحد شديد ");   
                     $('.modal #parole').val(data.enfant.parole == 1 ? "غير متكلم" : data.enfant.parole == 2 ? "يصدر بعض الأصوات" : data.enfant.parole == 3 ? "يتكلم بعض الكلمات" : "يتكلم");   
                     $('.modal #avs').val(data.enfant.avs == 1 ? "نعم" : "لا");  
                     // specialites 
                     $('.modal #doctors').append(""); 
                     var docs = data.docs;
                     
                     for (var i = 0; i< docs.length ; i++) {
                         elet += '<div id="doctors" class="d-inline-block custom-control custom-radio mr-1">'+
                         '<input type="radio" checked disabled class="custom-control-input bg-success" name="'+docs[i]+'" id="colorRadio2">'+
                        '<label class="custom-control-label" for="colorRadio2">'+docs[i]+'</label></div>';
                     }

                     $('.modal #doctors').empty(); 
                     $('.modal #doctors').append(elet);                       
                     // tuteur
                    $('.modal #nom_tuteur').val(data.enfant.tuteur.nom_tuteur);   
                     $('.modal #prenom_tuteur').val(data.enfant.tuteur.prenom_tuteur);   
                     $('.modal #type_Tuteur').val(data.enfant.tuteur.type_Tuteur == 1 ? " أب " : data.enfant.tuteur.type_Tuteur == 2 ? " أم  " : " آخر  ");   
                     $('.modal #CIN').val(data.enfant.tuteur.CIN);   
                     $('.modal #formation').val(data.enfant.tuteur.formation == 1 ? "نعم" :   "  لا"   );   
                     $('.modal #telephon').val(data.enfant.tuteur.telephon);   
                     $('.modal #whatsapp').val(data.enfant.tuteur.whatsapp);   
                     $('.modal #email_tuteur').val(data.enfant.tuteur.email_tuteur);   
                     $('.modal #adresse').val(data.enfant.tuteur.adresse);   
                     $('.modal #region_id').val(data.enfant.tuteur.region.nom_region);   
                     $('.modal #nom_utilisateur').val(data.enfant.tuteur.nom_utilisateur);   
                     $('.modal #mot_de_pass').val(data.enfant.tuteur.mot_de_pass);  
                       
               },
               error:function(data){
                //alert(JSON.serilize(data));
               }
           });
     //    });
    });

        // onHidden event
//    $('#onhiddenbtn').on('click', function() {
        $('#onshow').on('hidden.bs.modal', function() {
            //alert('onHidden event fired.');
            $('.modal #doctors').append(""); 
            elet = "";
        });
//    });

var id_tuteur = "";

    $('.vouloirSupprTuteur').on('click', function() {
        id_tuteur = $(this).attr("id");
    });

    // supprimer un tuteur
     $('.doSupprimer').on('click', function() {

        $.ajax({
               type:'GET',
               url: "deleteTuteur/"+id_tuteur,
               dataType:'json',
               success:function(data){

                if(data.Ok == 'Ok'){
                    $('#'+id_tuteur).closest('tr').remove();
                }
               }

           });

    });

    })(window, document, jQuery);

    </script>

@append
