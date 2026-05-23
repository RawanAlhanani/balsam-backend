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
                                <h4 class="card-title">جميع الأنشطة</h4>
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
                                                <th>عنوان النشاط</th>
                                                <th>نوعية النشاط</th>
                                                <th>تغيير</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activites as $item)
                                                <tr>
                                                    <td>{{$item->titre}}</td>
                                                    <td>{{$item->TypeActivite->nomActivite}}</td>
                                                 
                                                        <td class="Last">
                                                        
                                                       <a href="{{route('getParticipants', $item->id)}}" class="btn btn-round btn-info btn-sm">المشاركون</a>   
                                                            
                                                        <button id="{{$item->id}}" type="button" class="voirDetailsActivite btn btn-round btn-primary btn-sm" data-toggle="modal" data-target="#onshow"
                                                        >تفاصيل</button>
                                                       
                                                        <a href="{{route('EditAct', $item->id)}}" class="btn btn-round btn-warning btn-sm">تعديل</a>
                                                        
                                                        <button id="{{$item->id}}" type="button" data-toggle="modal" data-target="#supprimerActivite" class="vouloirSupprActivite btn btn-round btn-danger btn-sm">حذف</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Type</th>
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


<!-- Voir details Activite -->
<div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin: 1.75rem 200px 0 20px !important;">
                              <div class="modal-content" style="width:180% !important;">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel21">تفاصيل النشاط</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  
                                  <form>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                    <div class="form-group row">
                                        <!-- titre-->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">عنوان النشاط</span>
                                            </div>
                                            <input type="text" readonly="" id="titre" class="form-control" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                        <!-- Type activite -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">نوعية النشاط</span>
                                            </div>
                                            <input type="text" id="typeActivite" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>
                                        </fieldset>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- Date activite  -->
                                        <div class="col-md-6">
                                        <fieldset>
                                          <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="sizing-addon3">تاريخ النشاط</span>
                                            </div>
                                            <input type="text" id="date_activite" readonly="" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3" readonly="">
                                          </div>

                                        </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                <!-- Photo enfant -->
                                    
                                    <fieldset>
                                      <div class="input-group input-group-sm" style="margin-right:80px;">
                                        <img id="image_activite" src="" width="200px">
                                      </div>
                                    </fieldset>
                                    
                                </div>
                                    </div>
                                </div>
                                
                                        
                            </div>   

                            <div class="form-group row">
                                <!-- Description -->
                                <div class="col-md-12">
                                <fieldset>
                                  <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">محتوى النشاط</span>
                                    </div>
                                
                                    <textarea style="font-size:15px; line-height:2;" readonly="" class="form-control"  id="description" rows="10" placeholder="محتوى النشاط"></textarea>

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

<!-- supprimer une activite -->
<div class="modal fade text-left" id="supprimerActivite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header" style="border-bottom: none !important;">
                                 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>هل تريد فعلا حذف هذا النشاط ؟</h5>
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

       $('.voirDetailsActivite').on('click', function() {
        var id = $(this).attr("id");
    //    $('#onshow').on('show.bs.modal', function() {
            $.ajax({
               type:'GET',
               url: "getDetailsActivite/"+id,
               dataType:'json',
               success:function(data){

                     $('.modal #titre').val(data.activite.titre);   
                     $('.modal #typeActivite').val(data.activite.typeactivite.nomActivite);     
                     $('.modal #date_activite').val(data.activite.date_activite);     
                     $('.modal #image_activite').attr('src', '{{ URL::asset('storage/MesImages' ) }}' + '/' + data.activite.image_activite);   
                     $('.modal #description').text(data.activite.description);      
               },
               error:function(data){
               }
           });
    });

var id_activite = "";

    $('.vouloirSupprActivite').on('click', function() {
        id_activite = $(this).attr("id");
    });

    // supprimer un tuteur
     $('.doSupprimer').on('click', function() {
        $.ajax({
               type:'GET',
               url: "deleteActivite/"+id_activite,
               dataType:'json',
               success:function(data){

                if(data.Ok == 'Ok'){
                    $('#'+id_activite).closest('tr').remove();
                }
               }
           });
    });

    })(window, document, jQuery);

    </script>

@append
