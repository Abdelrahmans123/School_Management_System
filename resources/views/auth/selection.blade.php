<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>3alamni</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/icon.png') }}" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link href="{{ URL::asset('assets/css/selection.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">



</head>

<body>

    <div class="wrapper">

        <section class="d-flex align-items-center page-section-ptb login"
            style="background-image: url('{{ asset('assets/images/sativa.png') }}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white card">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">Who are you</h3>
                            <div class="form-inline d-flex justify-content-evenly">
                                <a class="btn btn-default col-lg-3" title="Student"
                                    href="{{ route('login.show', 'student') }}">
                                    <img alt="user-img" width="100px;"
                                        src="{{ URL::asset('assets/images/student.png') }}" title="Student">
                                </a>
                                <a class="btn btn-default col-lg-3" title="Parent"
                                    href="{{ route('login.show', 'parent') }}">
                                    <img alt="user-img" width="100px;"
                                        src="{{ URL::asset('assets/images/parent.png') }}" title="Parent">
                                </a>
                                <a class="btn btn-default col-lg-3" title="Teacher"
                                    href="{{ route('login.show', 'teacher') }}">
                                    <img alt="user-img" width="100px;"
                                        src="{{ URL::asset('assets/images/teacher.png') }}" title="Teacher">
                                </a>
                                <a class="btn btn-default col-lg-3" title="Admin"
                                    href="{{ route('login.show', 'admin') }}">
                                    <img alt="user-img" width="100px;"
                                        src="{{ URL::asset('assets/images/admin.png') }}" title="Admin">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

</body>

</html>
