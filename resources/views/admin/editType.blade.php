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
                        <label for="placeTextarea" class="cursor-pointer card-title">تغيير نوع نشاط</label>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditType')}}">
                            <input type="hidden" name="id" value="{{$type->id}}">
@csrf
                            <div class="form-body">
                                <div class="row">
                                    <!-- titre -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">نوع نشاط</p>
                                            <input value="{{$type->nomActivite}}" type="text" name="nomActivite" placeholder="نوع نشاط" class="form-control"/>
                                            @error('nomActivite')
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

