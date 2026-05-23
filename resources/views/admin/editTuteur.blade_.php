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
                        <h4 class="card-title">Modifier</h4>
                        <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <!--li><a data-action="close"><i class="ft-x"></i></a></li -->
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collapse show">
                        <div class="card-body">

                          <form method="post" action="{{route('PostEditTuteur')}}" >
@csrf
<input type="hidden" name="id" value="{{$enfant->id}}">
                            <div class="form-body">
                            <!-- Info enfant -->
                                <label>Info perso Enfant </label>
                                <div class="row">
                                    <!-- nom enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->nom_enfant}}" type="text" name="nom_enfant" placeholder="الاسم الشخصي للطفل" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- prenom enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->prenom_enfant}}" type="text" name="prenom_enfant" placeholder="الاسم العائلي للطفل" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- date naissance -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->date_naissance}}" type="date" name="date_naissance"  class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- photo enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">حمل صورة للطفل :</p>
                                            <input type="file" name="photo"  class="form-control-file" />
                                            <img src="/PhotoEnfant/{{$enfant->photo}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <label>Etat enfant </label>
                                <div class="row">
                                    <!-- etat enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <select  dir="rtl" class="form-control" name="statut"  required>
                                                <option disabled> - اختر حالة الطفل - </option>
                                                <option {{$enfant->statut == 1 ? "selected" : "" }} value="1">
                                                    توحد خفيف</option>
                                                <option {{$enfant->statut == 2 ? "selected" : "" }} value="2">
                                                     توحد متوسط </option>
                                                <option {{$enfant->statut == 3 ? "selected" : "" }} value="3">
                                                     توحد شديد </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- parole enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <select dir="rtl" class="form-control" name="parole">

                                                <option disabled>
                                                     - اختر كلام الطفل - </option>
                                                <option {{$enfant->parole == 1 ? "selected" : "" }} value="1">
                                                    غير متكلم</option>
                                                <option {{$enfant->parole == 2 ? "selected" : "" }} value="2">
                                                    يصدر بعض الأصوات</option>
                                                <option {{$enfant->parole == 3 ? "selected" : "" }} value="3">
                                                    يتكلم بعض الكلمات</option>
                                                <option {{$enfant->parole == 4 ? "selected" : "" }} value="4">
                                                    يتكلم</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <!-- specialite enfant -->
                                        <div class="form-group">
                                            <p class="droite">هل يتابع الطفل عند أحد التخصصات الطبية أو شبه الطبية؟</p>
                                          <div class="col-md-12">

                                            @foreach ($specialites as $item)  
                                                        <label>
    <input @if( is_array($mesDocs) && in_array($item->id, $mesDocs)  ) checked @endif
                                                                 type="checkbox" name="doctor[]" value="{{$item->id}}">

                                                            {{$item->specialite}}

                                                        </label>  
                                            @endforeach   

                                        </div>
                                        </div>

                                    </div>
                                </div>
                                <label>Etat enfant suite </label>
                                <div class="row">
                                    <!-- accompagnant enfant -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">هل للطفل مرافق :</p>
                                            <label>
                                                <input type="radio"  name="avs" value="1" {{$enfant->avs == 1 ? 'checked' : '' }} >
                                            نعم</label>
                                            <label>
                                                <input type="radio" name="avs" value="2" {{$enfant->avs == 2 ? 'checked' : '' }} >
                                            لا</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <!-- etude enfant -->
                                        <div class="form-group">
                                            <p class="droite">هل الطفل متمدرس :</p>
                                         
                                                <label><input type="radio" name="etude" {{$enfant->etude == 1 ? 'checked' : '' }} value="1">
                                                    نعم</label>
                                            
                                                <label><input type="radio" {{$enfant->avs == 2 ? 'checked' : '' }} name="etude" value="2">
                                                    لا</label>
                                           
                                        </div>
                                    </div>
                                </div>

                                

                                <label>Info perso tuteur </label>
                                <div class="row">
                                    <!-- nom tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->nom_tuteur}}" type="text" name="nom_tuteur" placeholder=" الاسم الشخصي " class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- prenom tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->prenom_tuteur}}" type="text" name="prenom_tuteur" placeholder="الاسم العائلي " class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- CIN tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->CIN}}" type="text" name="CIN" placeholder=" رقم البطاقة الوطنية " class="form-control"/>
                                        </div>
                                    </div>

                                     <!-- adresse tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->adresse}}" type="text" name="adresse" placeholder=" عنوان السكن" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- email tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->email_tuteur}}"  type="text" name="email_tuteur" placeholder="البريد الإلكتروني" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- region tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <select dir="rtl" class="form-control"  name="région" required>
                <option selected disabled>- اختر المنطقة -</option>

                                                @foreach ($regions as $item)
                <option value="{{$item->id}}" {{$enfant->Tuteur->region_id == $item->id ? 'selected' : '' }} >{{$item->nom_region}}</option>
                                                @endforeach 
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <!-- telephone tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->telephon}}" type="phone" name="telephon" placeholder=" رقم الهاتف" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- whatsapp tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">تاريخ الازدياد :</p>
                                            <input value="{{$enfant->Tuteur->whatsapp}}"  type="phone" name="whatsapp" placeholder="رقم الواتساب" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <!-- lien tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">القرابة</p>
                                            
                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 1 ? 'checked' : '' }} name="type_Tuteur" value="1" > أب </label>
                                        
                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 2 ? 'checked' : '' }} name="type_Tuteur" value="2"> أم  </label>

                                                <label><input type="radio" {{$enfant->Tuteur->type_Tuteur == 3 ? 'checked' : '' }} name="type_Tuteur" value="3"> آخر  </label>
                                            
                                        </div>
                                    </div>
                                     <!-- formation tuteur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="droite">هل خضعتم لأي تكوين حول التوحد :</p>
                                        
                                                <label><input type="radio" name="formation" value="1" checked> نعم  </label>
                                           
                                                <label><input type="radio" name="formation" value="2"> لا  </label>
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                                <label>Login </label>
                                <div class="row">
                                <!-- login -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input value="{{$enfant->Tuteur->nom_utilisateur}}" type="text" name="nom_utilisateur" placeholder=" اسم المستخدم " class="form-control"/>
                                        </div>
                                    </div>
                                     <!-- mot de passe -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input value="{{$enfant->Tuteur->mot_de_pass}}" name="mot_de_pass" placeholder="كلمة السر (8 أحرف كحد أدنى)" class="form-control"/>
                                        </div>
                                    </div>
                                    </div>

                                </div>
                            <div class="form-actions">
                              <div class="text-right">
                                <button type="submit" class="btn btn-primary">Modifier 
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

