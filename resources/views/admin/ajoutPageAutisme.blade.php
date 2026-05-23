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
                        <label for="placeTextarea" class="cursor-pointer card-title">إضافة صفحة جديدة</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostAddPageAutisme')}}" enctype="multipart/form-data" >
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">عنوان الصفحة</p>
                                            <input value="{{old('titre')}}" type="text" name="titre" placeholder="عنوان الصفحة" class="form-control"/>
                                            @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Image -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p class="droite">صورة</p>
                                            <input type="file" name="page_image" class="form-control"/>
                                            @error('page_image')
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
                  <p class="droite">المحتوى</p>
                </div>
                
                 <p style="direction: ltr;">  Retour a la ligne   :       --- </p> 
                 <p style="direction: ltr;"> Mot en gras    :    ---  Mot === ---    </p>
                 <p style="direction: ltr;"> Mot en gras + retour a la ligne    :    ---  Mot == ---    </p>
                 <p style="direction: ltr;"> Puces    :    ---  p1 *** p1 *** p3 ---    </p>
                <div class="card-block">
                  <div class="card-body">
                    <fieldset class="form-group">
                      <textarea style="font-size:15px; line-height:2;" class="form-control" name="description" id="placeTextarea" rows="15" placeholder="محتوى الصفحة">{{old('description')}}</textarea>
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

