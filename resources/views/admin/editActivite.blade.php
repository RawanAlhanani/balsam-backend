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
                        <label for="placeTextarea" class="cursor-pointer card-title">تغيير نشاط</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditAct')}}" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{$activite->id}}">
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">عنوان النشاط</p>
                                            <input value="{{$activite->titre}}" type="text" name="titre" placeholder="عنوان النشاط" class="form-control"/>
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
                                                <option disabled> -  اختر نوعية النشاط - </option>
                                                @foreach ($types as $v): ?>
                                                    <option {{$activite->typeactivite->id == $v->id ? "selected" : ""}}  value="{{$v->id}}">{{$v->nomActivite}}</option>
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
                                            <input value="{{$activite->date_activite}}" type="date" name="date_activite" placeholder="عنوان النشاط" class="form-control"/>
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
                                            <img src="{{asset('storage/MesImages'.'/'.$activite->image_activite)}}" style="width:380px;" alt="">
                                            @error('image_activite')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <!-- Description -->
                                <div class="col-md-12">
                                <fieldset>
                                  <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">تفاصيل النشاط</span>
                                    </div>
                                
                                    <textarea style="font-size:15px; line-height:2;" name="description" class="form-control"  id="description" rows="15" placeholder="تفاصيل النشاط">{{$activite->description}}</textarea>

                                  </div>
                                </fieldset>
                                </div>
                               
                            </div>
                                
                        
                            <div class="form-actions">
                              <div class="text-right">
                                <button type="submit" class="btn btn-primary">تغيير 
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

