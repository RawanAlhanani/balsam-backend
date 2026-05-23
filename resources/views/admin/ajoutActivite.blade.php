@extends('admin.master')


@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">

            <section class="grid-row-label" id="grid-row-label">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <label for="placeTextarea" class="cursor-pointer card-title">إضافة نشاط</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostAddActivite')}}" enctype="multipart/form-data" >
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">عنوان النشاط</p>
                                            <input value="{{old('titre')}}" type="text" name="titre" placeholder="عنوان النشاط" class="form-control"/>
                                            @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                     <!-- Type activité -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">نوعية النشاط</p>
                                            <select  dir="rtl" class="form-control" name="type_activite_id"  required>
                                                <option selected="" disabled> -  اختر نوعية النشاط - </option>
                                                @foreach ($types as $v): ?>
                                                    <option  value="{{$v->id}}">{{$v->nomActivite}}</option>
                                                @endforeach ?>
                                            </select>
                                        </div>
                                         @error('type_activite_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <!-- Date activite -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ النشاط</p>
                                            <input value="{{old('date_activite')}}" type="date" name="date_activite" placeholder="عنوان النشاط" class="form-control"/>
                                            @error('date_activite')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">صورة</p>
                                            <input type="file" name="image_activite" class="form-control"/>
                                            @error('image_activite')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Rendre activite => info -->
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                            تريد أيضا إضافة هذا النشاط إلى الأخبار؟
                                                            </label>
                                                            <div class="controls">
                                                                <div class="skin skin-square">
                                                                    <input type="radio" value="1" name="ajoutAuxInfos" id="radio1" checked>
                                                                    <label for="radio1">نعم</label>
                                                                </div>
                                                                <div class="skin skin-square">
                                                                    <input type="radio" value="2" name="ajoutAuxInfos" id="radio2">
                                                                    <label for="radio2">لا</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>

                                <div class="row">
                                   <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="card">
                <div class="card-header">
                  <p class="droite">تفاصيل النشاط</p>
                </div>
                
                <div style="float:left;">
                    <p style="direction: ltr;     float: left;" >  Retour a la ligne   :       --- </p> 
                    </div>
                    <div style="float:left;">
                    <p style="direction: ltr;     float: left;">  Mot en gras    :    ---  Mot === ---    </p>
                    </div>
                    <div style="float:left;">
                    <p style="direction: ltr;     float: left;"> Mot en gras + retour a la ligne    :    --- Mot == ---    </p>
                    </div>
                    <div style="float:left;">
                    <p style="direction: ltr;     float: left;"> Puces    :    ---  p1 *** p1 *** p3 ---    </p>
                </div>
                
                <div class="card-block">
                     
                  <div class="card-body">

                    <fieldset class="form-group">
                      <textarea style="font-size:15px; line-height:2;" class="form-control" name="description" id="placeTextarea" rows="15" placeholder="تفاصيل النشاط">{{old('description')}}</textarea>
                      @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                    </fieldset>

                  </div>
                </div>
              </div>
                                    </div>
                                   
                                </div>
                                
                        
                            <div class="form-actions">
                              <div class="text-right">
                                <button type="submit" class="btn btn-primary">إضافة  
                                    <i class="ft-thumbs-up position-right"></i>
                                </button>
                              </div>
                            </div>

                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

        </div>
    </div>
</div>


@endsection

