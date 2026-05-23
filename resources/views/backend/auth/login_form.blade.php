<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>جمعية بلسم لذوي التوحد</title>

    <!-- Bootstrap -->
    <link href="/backend/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/backend/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/backend/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/backend/gentelella/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/backend/gentelella/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{route('Traitement')}}" method="POST">
              @csrf
                <h1>تسجيل الدخول</h1>
              <div>
                <input type="text" name="email" class="form-control" placeholder="البريد الالكتروني" required="" style="text-align: right" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required="" style="text-align: right"/>
              </div>
              <div>
                <button type="submit" class="btn-small xsmall-btn">سجل الدخول</button>

                <a class="reset_pass" href="#">فقدت كلمة المرور الخاصة بك؟</a>

              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                    <a href="#signup" class="to_regitser"> إنشاء حساب </a>

                    جديد في الموقع؟

                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>  رئيس جمعية بلسم<img src="/backend/gentelella/production/images/favicon.png"></h1>
                  <p> 2021 ©
                      </p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>إنشاء حساب </h1>
              <div>
                <input type="text" class="form-control" placeholder="اسم المستخدم" required="" style="text-align: right"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="البريد الالكتروني" required="" style="text-align: right"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="كلمة المرور" required="" style="text-align: right"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">أرسل</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                    <a href="#signin" class="to_register">  إنشاء حساب </a>
                    جديد في الموقع؟

                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>  رئيس جمعية بلسم<img src="/backend/gentelella/production/images/favicon.png"></h1>
                  <p>  © 2021 جميع الحقوق محفوظة   </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
