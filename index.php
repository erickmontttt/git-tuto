<!DOCTYPE html>
<html>


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <meta property="og:site_name" content="NetShoes"/>
        <meta property="og:image" content="i.imgur.com/yPTmHnX.png"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="<3 #DGchks">
        <meta name="author" content="dgchks">
        <meta property="og:type" content="website"/>

        <link rel="shortcut icon" type="image/x-icon" href="Trilogy.jpg" />


        <title>Checker BB</title>

        
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>
<script src="ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script>
            var audio = new Audio('blp.mp3');
            $(document).ready(function () {
var i = 1;
                $('#iniciarchk').attr('disabled', null);
                $('#iniciarchk').click(function () {
                    audio.play();
                $('#sansImg').hide();
                $('#sansFala').hide();
                    $('#iniciarchk').attr('disabled', 'disabled');
                    var line = $('#lista_ccs').val().replace(',', '').split('\n');
                    line = line.filter( function( item, index, inputArray ) {
                    return inputArray.indexOf(item) == index;
                    });
                                        var total = line.length;
                    var ap = 0;
                    var rp = 0;
                                //var key = $('#key').val().replace(',', '').split('\n');
                    var testadu = 0;
                    var st = 'Aguardando...';
                    $('#status_ccs').html("Iniciado.");
                    $('#total_ccs').html(total);
                    $("#lista_ccs").val(line.join("\n"));
$('#lista_ccs').attr('disabled', 'disabled');
$('#pararchk').attr('disabled', null);
                    line.forEach(function (value){
                        if (value == "") {
                            removelinha();
                            return;

                        }
                        var ajaxCall = $.ajax({
                            url: 'api.php',
                            type: 'GET',
                            data: 'lista=' + value,
                            success: function (data) {
                                var status = data.includes("Aprovada");
                                if (status) {
                                    removelinha();
                                    $('#status_ccs').html("Aprovada.");
                                 document.getElementById("aprovadas").innerHTML += data + "<br>";
                                                                    testadu = testadu + 1;
                                    ap = ap + 1;
                                    audio.play();
                                }else{
                            
                                    removelinha();
                                    $('#status_ccs').html("Reprovada.");
                                     document.getElementById("reprovadas").innerHTML += data + "<br>";
                                                                        testadu = testadu + 1;
                                    rp = rp + 1;
                                }
                                var fila = parseInt(ap) + parseInt(rp);
                            $('#lives_ccs').html(ap);
                                $('#dies_ccs').html(rp);
                                $('#testado_ccs').html(fila);

                                if (fila == total) {
                                   $('#iniciarchk').attr('disabled', null);
                                    $('#pararchk').attr('disabled', 'disabled');
                                    $('#lista_ccs').attr('disabled', null);
                                    audio.play();
                                    document.getElementById("status_ccs").innerHTML = "Finalizado. ";
                                }
                            }
                        });
                        $('#pararchk').click(function () {
                            ajaxCall.abort();
                            $('#iniciarchk').attr('disabled', null);
                            $('#pararchk').attr('disabled', 'disabled');
                            $('#lista_ccs').attr('disabled', null);
                             var st = 'Pausado...';
                            $('#status_ccs').html(st);
                        });
                });
                });

        });
          function removelinha() {
          var lines = $("#lista_ccs").val().split('\n');
          lines.splice(0, 1);
          $("#lista_ccs").val(lines.join("\n"));
      }

                    function limpar() {
    document.getElementById("lista_ccs").value = "";

}


            </script>

<style class="cp-pen-styles">
  

  body {
  padding: 40px;
  background: #FFFFF;
  font-family: 'Roboto Condensed', "Helvetica Neue",Helvetica,Arial,sans-serif;

/*#FFFFF*/
}

</style>
                
                <div class="content">
                    <div class="container-fluid">


                       <div class="row">

                            <div class="col-xl-3">
                                <div class="card-box">

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <i style="font-size:400%" class="mdi mdi-progress-upload text-primary"></i>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0" style="color: #00B19D" id="lives_ccs">0</h2>
                                            <p class="text-muted m-b-10">Aprovadas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card-box">

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <i style="font-size:400%" class="mdi mdi-progress-upload text-primary"></i>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0" style="color: #EF5350" id="dies_ccs">0</h2>
                                            <p class="text-muted m-b-10">Reprovadas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3">
                                <div class="card-box">

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <i style="font-size:400%" class="mdi mdi-progress-upload text-primary"></i>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0" style="color: #FFAA00" id="testado_ccs">0</h2>
                                            <p class="text-muted m-b-10">Testadas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card-box">

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <i style="font-size:400%" class="mdi mdi-progress-upload text-primary"></i>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0" style="color: #3BAFDA" id="total_ccs">0</h2>
                                            <p class="text-muted m-b-10">Total</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                       

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-30">Lista de Cartões:</h4>
                                     <textarea class="form-control" id="lista_ccs"  rows="3" style="font-size: 100%; height: 117px; width:100%;resize:none;" rows="8"></textarea>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-30">Status: <span id="status_ccs">Parado.</span></h4>
                                    <button id="iniciarchk" class="btn btn-block btn-sm btn-success waves-effect waves-light">Testar</button>
                                    <button id="pararchk" type="button" class="btn btn-block btn-xs btn-danger waves-effect waves-light">Pausar</button>

                                </div>
                            </div>
                        </div>
<!--                                                <form>
  <label for="fname">Key de produção <b>(Mercado Pago)</b></label>
  <input class="form-control" type="text" id="key" name="key">
</form>!-->
                            <div class="col-xl-12">
                                <div class="card-box">

                                    <h4 class="header-title mt-0 m-b-30">Resultados</h4>

                                    <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#aprovadastb" role="tab"><span class="hidden-sm-up"><i class=""></i></span> <span class="hidden-xs-down">Aprovadas</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reprovadastb" role="tab"><span class="hidden-sm-up"><i class=""></i></span> <span class="hidden-xs-down">Reprovadas</span></a> </li>
                                    </ul>
                           <div class="tab-content padding-vertical-20">
                                <div class="tab-pane active" id="aprovadastb" role="tabpanel" aria-expanded="true">
                                   <div class="margin-bottom-50">
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>Status</th>
                                <th>Cartão</th>
                                <th>Bin</th>
                                <th>Vbv</th>
                                <th>Debitou</th>
                                <th>Retorno</th>
                                <th>Copyright</th>
                            </tr>
                            </thead>
                            <tbody id="aprovadas">
                            </tbody>
                        </table>
                    </div>
                                </div>
                                <div class="tab-pane" id="reprovadastb" role="tabpanel" aria-expanded="false">
                         <div class="margin-bottom-50">
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th>Status</th>
                                <th>Cartão</th>
                                <th>Bin</th>
                                <th>Retorno</th>
                                <th>Copyright</th>
                            </tr>
                            </thead>
                            <tbody id="reprovadas">
                            </tbody>
                        </table>
                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


       
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

 
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <script src="assets/pages/jquery.dashboard.js"></script>

                <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <div class="footer-copyright text-center py-3">
      <a href="">Trilogy#4242</a>
    </div>


  </footer>

</html>
  

