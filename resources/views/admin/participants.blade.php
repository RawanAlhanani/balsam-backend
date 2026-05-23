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
                                <h4 class="card-title">المشاركون في نشاط : {{$activite->titre }}</h4>
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
                    @foreach ($participants as $item)
                        <tr>
                    <td>{{$item->tuteur->nom_tuteur}}</td>
                    <td>{{$item->Tuteur->prenom_tuteur}}</td>
                    <td>{{$item->Tuteur->telephon}}</td>
                    <td>{{$item->Tuteur->whatsapp}}</td>
                    <td>{{ $item->Tuteur->formation == 1 ?    'نعم'  :   'لا'  }}</td>
                    <td>{{$item->Tuteur->CIN}}</td>
                    <td>{{$item->Tuteur->adresse}}</td>
                    <td>{{$item->Tuteur->Region->nom_region}}</td>
                    <td>{{$item->Tuteur->enfants[0]->nom_enfant}}</td>  
                    <td>{{$item->Tuteur->enfants[0]->prenom_enfant}}</td> 
                    <td>{{$item->Tuteur->enfants[0]->date_naissance}}</td> 
                    <td> {{$item->Tuteur->enfants[0]->sexeEnfant == 1 ? 'ذكر'  : 'أنثى'}} </td>
                     <td>{{ $item->Tuteur->enfants[0]->statut == 1 ?  'توحد خفيف'  :  $item->Tuteur->enfants[0]->statut =2  ? ' توحد متوسط  ' : 'توحد شديد' }} </td>
                     
                     <td> {{ $item->Tuteur->enfants[0]->parole == 1 ?    'غير متكلم'  :       $item->Tuteur->enfants[0]->parole ==2   ? 'يصدر بعض الأصوات'  : $item->Tuteur->enfants[0]->parole == 3  ? 'يتكلم بعض الكلمات'  : ' يتكلم' }}  </td>
                    <td>  
                        @foreach($item->Tuteur->enfants[0]->doctor_enfants as $doc)
                          <span>{{ $doc->doctor->specialite }}</span> 
                          <br>
                        @endforeach
                    </td> 
                  
                    <td>{{ $item->Tuteur->enfants[0]->avs == 1 ?  'نعم' : 'لا'  }}</td>
                    <td>{{ $item->Tuteur->enfants[0]->etude == 1 ?  'نعم' : 'لا'  }}</td>
                  
                    <td><img width="90" src="{{asset('storage/MesImages/' . $item->Tuteur->enfants[0]->photo)}}"></td>

                                                    <td class="Last">
                                               <button id="{{$item->activite_id}}_{{$item->tuteur_id}}" type="button" data-toggle="modal" data-target="#supprimerParticipant" class="vouloirSupprParticipant btn btn-round btn-danger btn-sm">حذف</button>
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



<!-- supprimer un participant -->
<div class="modal fade text-left" id="supprimerParticipant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header" style="border-bottom: none !important;">
                                 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>هل تريد فعلا حذف هذا المشارك ؟</h5>
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

    (function(window, document, $) {
    'use strict';

var id_tuteur = "";

    $('.vouloirSupprParticipant').on('click', function() {
        id_tuteur = $(this).attr("id");
    });

    // supprimer un tuteur
     $('.doSupprimer').on('click', function() {

        $.ajax({
               type:'GET',
               url: "/admin/deleteParticipant/"+id_tuteur,
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
