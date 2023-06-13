<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> REPORTE DE ACTIVIDADES</title>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    html, body {
    width: 95%;
    height: 100%;
    margin-top: 15px;
    }
    img
    {
    width: 160px;
    height: 55px;
    }
    .titulo{
    font-size: 14px;
    margin-left: 15px;
    font-family: Arial, sans-serif;

    }
   .titulo2{
    font-size: 13px;
    margin-left: 15px;
    font-family: Arial, sans-serif;
    margin-top: 20px;
    /*background-color:#0380FF;*/

    }
    .subtitulo{
    font-size: 19px;
    margin:19px;
    }



.resumen-amd {
    border: white 10px solid;
    margin-left:10px;
    }
    .resumen-amd th{
    font-size: 10px;
    }
    .resumen-amd td{
    font-size: 10px;
    }

    hr {
    height: 20px;
    width: 100%;
    /*background-color:#0380FF;*/
    background-color: #000000;
    }
    td{
    padding-left:15px;
    }
    .resumen1{
    margin-left:10px;
    }
    .resumen1 th{
    font-size: 11px;
    }
    .resumen1 td{
    font-size: 11px;
    }
    .resumen{
    margin-left:10px;
    }
    .resumen th{
    font-size: 10px;
    }
    .resumen td{
    font-size: 9px;
    }
    P{
    font-size: 11px;
    margin-left: 10px;
    }
    .footer {
    text-align: center;
    justify-content: center;
    margin:auto;
    /*background-color: #F1C40F;*/
    position: fixed;
    width: 95%;
    height: 100px;
    bottom:0;
    margin-bottom:10px;
    margin-left:10px;
    }
    .lateral{
    height: 50px;
    /*background-color: blue; */
    }

   .firma{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;
  }
  .pie{
    font-size: 10px;
    margin-left: 5px;
    text-align: center;
    justify-content: center;

  }
  .contenido{
    text-align: center;
    justify-content: center;
    margin-left:20px;
  }



</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
       <header>
            <section class="content container-fluid">
                <div class="row text-center justify-content">
                    <div class="col-md-12">
                            <div class="float-left">
                            <img src="{{  asset('images/logo.png') }}">
                            </div>
                    </div>
                    <div class="col-md-12">
                            <div class="text-center justify-content">
                                    <h2 class="titulo2">PROANZOATEGUI<br>
                                    G-20016716-5<br>
                                    <h4>
                                    ACTIVIDADES<br></h4>
                                </h2>

                                   

                            </div>
                    </div>




                </div>
            </section>
        </header>
        <main>

         <!-- Inicio de tabla con todas las AYUDAS SOCIALES -->
        
            <table class="table table-bordered table-sm resumen">
                                      <thead class="thead">
                                          <tr>
                                            <th>ID</th>
                                        
                                            <th>Nombre De La Actividad</th>
                                            <th>Fecha</th>
                                            <th>Costo</th>
                                            <th>Status</th>
                                            <th>Cantidad</th>
                                            <th>Proyecto</th>
                                            <th>Responsable</th>
                                            <th>Direccion</th>
                                            <th>Imagen</th>
      
                                          </tr>
                                      </thead>
                                      <tbody>
                                      
                                      @foreach ($actividades as $actividade)
                                        <tr>
                                            <td>{{ $actividade->id }}</td>
                                            
											<td>{{ $actividade->nombre }}</td>
                                            <td>{{ $actividade->created_at}}</td>
											<td>{{ number_format($actividade->costo, 2, ',', '.') }}</td>
											<td>{{ $actividade->status }}</td>
											<td>{{ $actividade->cantidad }}</td>
											
											<td>{!! $actividade->proyecto->nombre !!}
                                            <br><b>Descripcion: </b>{!! $actividade->descripcion !!}
                                            </td>
											<td>{{ $actividade->responsable->nombre }}</td>
											<td>{{ $actividade->direccione->descripcion }}</td>
                                            <td><img src="{{ asset ($actividade->imagen) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt=""></td>
											
                                        </tr>
                                    @endforeach

                                      </tbody>
                                  </table>




                                  <!-- Resumen Estadistico -->
                                  <table class="table table-bordered table-sm resumen">
                                    <thead class="thead">
                                        <tr>
                                            <th style="text-align: center" colspan="5">RESUMEN ACTIVIDADES</th>
    
                                        </tr>
                                        <tr>
                                            
                                            <th style="text-align: center">SIN EMPEZAR</th>
                                            <th style="text-align: center">EN PROGRESO</th>
                                            <th style="text-align: center">LISTO</th>
                                            <th style="text-align: center">ARCHIVADO</th>
                                            <th style="text-align: center">TOTAL ACTIVIDADES</th>
                                            <th style="text-align: center">COSTO BS</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <tr>
                                           
                                             <td style="text-align: center">
                                                {{ $datos['sin_empezar'] }}
                                             </td>
                                             <td style="text-align: center">
                                                {{ $datos['en_progreso'] }}
                                              
                                            </td>
                                             <td style="text-align: center"> {{ $datos['listo'] }}</td>
                                             <td style="text-align: center"> {{ $datos['archivado'] }}</td>
                                             <td style="text-align: center">{{ $datos['total_proyecto'] }}</td>
                                             <td style="text-align: center">{{ number_format($datos['costo'], 2, ',', '.') }}</td>
                                            
                                            </tr>

                                            
                                   
                                    </tbody>
                                </table>

                                

                                 <!-- Resumen Filtrado  -->
                                 <table class="table table-bordered table-sm resumen">
                                    <thead class="thead">
                                        <tr>
                                            <th style="text-align: center" colspan="5">FILTRADO POR</th>
    
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">Responsable</th>
                                            <th style="text-align: center">Estatus</th>
                                            <th style="text-align: center">Direccion</th>
                                            <th style="text-align: center">Proyecto</th>
                                            <th style="text-align: center">Inicio</th>
                                            <th style="text-align: center">Fin</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <tr>
                                            
                                             <td style="text-align: center">{{ $datos['nombre_responsable'] }}</td>
                                             <td style="text-align: center">{{ $datos['estatus'] }}</td>
                                             <td style="text-align: center"> {{ $datos['nombre_direccion'] }}</td>
                                             <td style="text-align: center"> {{ $datos['nombre_proyecto'] }}</td>
                                             <td style="text-align: center"> {{ $datos['inicio'] }}</td>
                                             <td style="text-align: center">{{ $datos['fin'] }}</td>

                                            </tr>

                                    </tbody>
                                </table>

                                

                              
       


        
                                </main>
        
                                <br>  <br>
        <footer class="footer">
             

              <div class="pie"></div>

            </footer>
  </body>
</html>