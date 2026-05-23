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
                        <label for="placeTextarea" class="cursor-pointer card-title">تغيير صفحة</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditPageAutisme')}}" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{$PageAutisme->id}}">
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">عنوان الصفحة</p>
                                            <input value="{{$PageAutisme->titre}}" type="text" name="titre" placeholder="عنوان الصفحة" class="form-control"/>
                                            @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p class="droite">صورة</p>
                                            <input type="file" name="page_image" class="form-control"/>
                                            <img src="{{asset('storage/MesImages'.'/'.$PageAutisme->page_image)}}" style="width:380px;" alt="">

                                            @error('page_image')
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
                                      <span class="input-group-text">محتوى الصفحة</span>
                                    </div>
                                
                                    <textarea style="font-size:15px; line-height:2;"  name="description" class="form-control"  id="description" rows="15" placeholder="محتوى الخبر">{{$PageAutisme->description}}</textarea>

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

