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
                                <h4 class="card-title">جميع الشركاء</h4>
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
                                                <th>إسم الشريك</th>
                                                <th>الصورة</th>
                                                <th>تغيير</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($partenaires as $item)
                                                <tr>
                                                    <td>{{$item->nomPartenaire}}</td>

                                                    <td><img src="{{asset('storage/MesImages'.'/'.$item->imagePartenaire)}}"></td>
                                                        <td class="Last">
                                                                                                              
                                                        <a href="{{route('EditPartenaire', $item->id)}}" class="btn btn-round btn-warning btn-sm">تعديل</a>
                                                        
                                                        <button id="{{$item->id}}" type="button" data-toggle="modal" data-target="#supprimerPartenaire" class="vouloirSupprPartenaire btn btn-round btn-danger btn-sm">حذف</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Image</th>
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


<!-- supprimer un partenaire -->
<div class="modal fade text-left" id="supprimerPartenaire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header" style="border-bottom: none !important;">
                                 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h5>هل تريد فعلا حذف هذا الشريك ؟</h5>
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

var id_p = "";

    $('.vouloirSupprPartenaire').on('click', function() {
        id_p = $(this).attr("id");
    });

    // supprimer un tuteur
     $('.doSupprimer').on('click', function() {
        $.ajax({
               type:'GET',
               url: "deletePartenaire/"+id_p,
               dataType:'json',
               success:function(data){

                if(data.Ok == 'Ok'){
                    $('#'+id_p).closest('tr').remove();
                }
               }
           });
    });

    })(window, document, jQuery);

    </script>

@append
