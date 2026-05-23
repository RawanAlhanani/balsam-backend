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
                        <label for="placeTextarea" class="cursor-pointer card-title">إضافة خبر</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostAddInf')}}" enctype="multipart/form-data" >
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">عنوان الخبر</p>
                                            <input value="{{old('titre')}}" type="text" name="titre" placeholder="عنوان الخبر" class="form-control"/>
                                            @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                     <!-- Image -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">صورة</p>
                                            <input type="file" name="image_info" class="form-control"/>
                                            @error('image_info')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                   <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="card">
                <div class="card-header">
                  <p class="droite">محتوى الخبر</p>
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

