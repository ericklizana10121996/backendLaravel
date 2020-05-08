<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="stylesheet" href="{{asset('/css.css')}}"> -->
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height" style="background-color:#f2f2f2;">
            <div class="content-fluid p-5" style="background-color:#fff;">
                <div class="row">
                    <h3 ><strong>{{$titulo}}</strong></h3>
                    <div class="col-md-12">
                        <form action="/api/colaboradores/{{$colaborador->id}}"  method="post">
                            @csrf                            
                            @if ($boton == 'Actualizar')
                                {{ method_field('PUT') }}
                            @endif

                            <div class="form-group">
                                <label class="col-lg-12 control-label">DNI <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" value="{{ $colaborador->dni }}" class="form-control" name="dni" id="dni" placeholder="Documento">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12 control-label">Nombres <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" value="{{ $colaborador->nombre }}"  class="form-control" name="nombre" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12 control-label">Apellidos <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                  <input type="text" value="{{ $colaborador->apellidos }}"  class="form-control" name="apellidos" >
                               </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12 control-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                  <input type="date" class="form-control" value="{{ $colaborador->fechaNacimiento }}"  name="fechaNacimiento" >
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn {{$color}} btn-roundend" type="submit">{{$boton}}</button>
                            </div>
                        </form>
                    </div>
                </div>
              
            </div>
        </div>
    </body>
</html>
