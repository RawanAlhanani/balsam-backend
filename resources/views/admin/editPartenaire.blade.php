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
                        <label for="placeTextarea" class="cursor-pointer card-title">تغيير شريك</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditPartenaire')}}" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{$partenaire->id}}">
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">إسم الشريك</p>
                                            <input value="{{$partenaire->nomPartenaire}}" type="text" name="nomPartenaire" placeholder="إسم الشريك" class="form-control"/>
                                            @error('nomPartenaire')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <p class="droite">صورة</p>
                                            <input type="file" name="imagePartenaire" class="form-control"/>
                                            <img src="{{asset('storage/MesImages'.'/'.$partenaire->imagePartenaire)}}" alt="">
                                            @error('imagePartenaire')
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

