

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <h1 style="margin: 0 0 3% 35%; ">Reasignacion de Casos</h1>
              <div class="col-md-12 col-sm-12 col-xl-12 col-xs-12">
                  <div class="box" >

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
                                  <div class="col-md-3">
                                    <h4 for="recipient-name" class="col-form-label">Entorno:</h4>
                                    <h4 id="h_envAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-3">
                                    <h4 for="recipient-name" class="col-form-label">Programa:</h4>
                                    <h4 id="h_softAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-3">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Registro:</h4>
                                    <h4 id="h_fechAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-3">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Asignacion:</h4>
                                    <h4 id="h_fech_Asg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-8">
                                    <h4 for="recipient-name" class="col-form-label">Asunto:</h4>
                                    <h4 id="h_asntAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-2" id="divNote" style="display: none;">
                                    <a href="#" id="ShowNote" data-toggle="modal" data-target="#ModalNota" title="Ver Nota">
                                      <br />
                                      <i class="fa fa-clipboard" style="font-size: 30px;"></i>
                                    </a>
                                  </div>
                                  <div class="col-md-2" id="divViewDocAssign">
                                    <a href="#" id="aViewDocAssign" target="_blank" title="Abrir documento adjunto">
                                      <br />
                                      <i class="fa fa-folder iconFolder" style="font-size: 25px;" aria-hidden="true"></i>
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
                    <div class="modal fade" id="ModalNotaFin" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <h4 id="h4_Theme" style="font-weight: bold;"></h4>
                                    <h4 id="descSolution"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Fecha de ingreso</label>
                                    <h4 id="h4fIng"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Fecha de finalización</label>
                                    <h4 id="h4fin"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Tiempo de duracion</label>
                                    <h4 id="h4Time"></h4>
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

                    <!-------------------REASIGNAR CASO MODAL ------------------------>
                    <div class="modal fade" id="modalReAssign" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="">Reasignar Caso</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-5">
                                    <h4>Servicio</h4>
                                    <select class="form-control" id="slcserviceReAssign">
                                      <option value="">Seleccione --</option>
                                      <?= $slcServreAssign; ?>
                                    </select>
                                  </div>
                                  <div class="col-md-5">
                                    <h4>Nuevo Asignado</h4>
                                    <select class="form-control" id="slcTecReAssign">
                                    </select>
                                    <h4 id="h4_reAssign"></h4>
                                  </div>
                                  <div class="col-md-12">
                                    <br>
                                    <label>Motivo Reasignacion</label>
                                    <p id="p_MotRA"></p>
                                  </div>
                              </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-primary" id="btn_reAssign" >Asignar</button>
                            </div>
                          </div>
                        </div>
                      </div>  
                    <!------------- REASIGNAR CASO FIN MODAL ----------------------->


                    <!-------------------CAMBIAR ASESOR MODAL ------------------------>
                    <div class="modal fade" id="modalUpdateAssesor" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="titleUpdtAssesor"></h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-5">
                                    <h4>Ejecutivo Actual</h4>
                                    <h4 id="h4_oldAssesor">Otro</h4>
                                  </div>
                                  <div class="col-md-5">
                                    <h4>Nuevo Ejecutivo</h4>
                                    <select class="form-control" id="slcNewAssesor">
                                    </select>
                                  </div>
                              </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-primary" id="btn_UpdtAssesor" >Cambiar</button>
                            </div>
                          </div>
                        </div>
                      </div>  
                    <!------------- CAMBIAR ASESOR FIN MODAL ----------------------->


                    <!--- TABLA USUARIOS ------------->
                    <aside id="asideTable" style="margin-top: 20px;">

                      <table class="table table-bordered table-hover table-striped" id="tblUsers" style="width: 100%;">
                        <thead >
                          <button class="btn btn-secondary" name="btnFilter" style="float: right; margin: 0 5px 5px 0;">
                            <i class='fa fa-filter' aria-hidden='true'></i>
                          </button>
                          <tr>
                            <td style="width: 2%;">N-</td>
                            <td style="width: 18%;">Cliente</td>
                            <td style="width: 20%;">Asunto</td>
                            <td style="width: 10%;">Asesor</td>
                            <td style="width: 12%;">Asignado</td>
                            <td style="width: 10%;">Servicio</td>
                            <td style="width: 10%;">Estado</td>
                            <td style="width: 8%;">Acciones</td>
                          </tr>
                        </thead>
                        <tbody id="tbodyCases">
                        	<?= $tblAsignados;?>
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
