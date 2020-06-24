

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <h1 style="margin: 0 0 3% 35%; ">Historial</h1>
              <div class="col-md-12 col-sm-12 col-xl-12 col-xs-12">
                  <div class="box">

                     <!-- MODAL VER MAS CASO --->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ShowMoreAssign" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title" id="titleAssgn"></h3>
                          </div>
                          <div class="modal-body">
                            <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Entorno:</h4>
                                    <h4 id="h_envAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Programa:</h4>
                                    <h4 id="h_softAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Registro:</h4>
                                    <h4 id="h_fechAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-10">
                                    <h4 for="recipient-name" class="col-form-label">Asunto:</h4>
                                    <h4 id="h_asntAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-2" id="divNote" style="display: none;">
                                    <a href="#" id="ShowNote" data-toggle="modal" data-target="#ModalNota" title="Ver Nota">
                                      <br>
                                      <i class="fa fa-clipboard" style="font-size: 30px;"></i>
                                    </a>
                                  </div>
                                  <div class="col-md-12">
                                    <h4 for="recipient-name" class="col-form-label">Descripcion:</h4>
                                    <h4 id="h_descAsg" class="h4Cases"></h4>
                                  </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--------------CIERRE MODAL VER MAS CASO--------------------->

                    <!-------------------VER NOTA MODAL ------------------------>
                    <div class="modal fade" id="ModalNota" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="">Nota</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-12">
                                    <h4 id="descNote"></h4>
                                  </div>
                              </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>  


                    <!------------- CIERRE VER NOTA MODAL ----------------------->

                    <!-------------------VER NOTA DESCRIPCION FIN MODAL ------------------------>
                    <div class="modal fade" id="ModalNotaFinMyAsg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="">Solucion del Caso</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-12" style="padding-bottom: 5%; border-bottom: 1px solid black;">
                                    <h4 id="h3Theme" style="font-weight: bold;"></h4>
                                    <h4 id="descSolutionAsg"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Fecha de ingreso</label>
                                    <h4 id="h4fIngAsg"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Fecha de finalización</label>
                                    <h4 id="h4finAsg"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Tiempo de duracion</label>
                                    <h4 id="h4TimeAsg"></h4>
                                  </div>
                              </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>  
                    <!------------- CIERRE VER NOTA DESCRIPCION FIN MODAL ----------------------->


                    <!--- TABLA HISTORIAL ------------->
                    <aside style="margin-top: 20px; width: 100%;">
                      <table class="table table-bordered" id="tblUsers" style="width: 100%;">
                        <thead >
                          <tr>
                            <td style="width: 23%;">Cliente</td>
                            <td style="width: 19%;">Asunto</td>
                            <td style="width: 15%;">Asesor</td>
                            <td style="width: 18%;">Asignado</td>
                            <td style="width: 15%;">Fecha Terminado</td>
                            <td style="width: 15%;"></td>
                          </tr>
                        </thead>
                        <tbody id="tbodyHistory">
                        	<?= $tableHistory;?>
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
