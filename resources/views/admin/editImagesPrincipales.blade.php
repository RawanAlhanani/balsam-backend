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
                        <label for="placeTextarea" class="cursor-pointer card-title">تغيير صورة رئيسية</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditImagesPrincipales')}}" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{$image->id}}">
@csrf
                            <div class="form-body">
                                <div class="row">
                                   

                                    <!-- Image -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p class="droite">الصورة</p>
                                            <input type="file" name="nomImage" class="form-control"/>
                                            <img width="250" src="{{asset('storage/MesImages'.'/'.$image->nomImage)}}" />
                                            @error('nomImage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
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

