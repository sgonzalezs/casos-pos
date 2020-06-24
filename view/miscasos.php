

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <h1 style="margin: 0 0 3% 35%; ">Mis Casos</h1>
              <div class="col-md-12">
                  <div class="box">

                     <!-- MODAL VER MAS CASO --->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ShowMoreMyCase" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title" id="titleAssgn"></h3>
                          </div>
                          <div class="modal-body">
                            <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Entorno:</h4>
                                    <h4 id="h_nitAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Programa:</h4>
                                    <h4 id="h_clienteAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Asignacion:</h4>
                                    <h4 id="h_fechAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-8">
                                    <h4 for="recipient-name" class="col-form-label">Asunto:</h4>
                                    <h4 id="h_asntAsg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-1" id="divNote" style="display: none;">
                                    <a href="#" id="ShowNote" data-toggle="modal" data-target="#ModalNota" title="Ver Nota">
                                      <br>
                                      <i class="fa fa-clipboard" style="font-size: 30px;"></i>
                                    </a>
                                  </div>
                                  <div class="col-md-1" id="divViewDocMyCase">
                                    <a href="#" id="aViewDocMyCase" target="_blank" title="Abrir documento adjunto">
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

                      <!----------------- FINALIZAR CASO MODAL ------------------------>
                      <div class="modal fade" id="ModalEndCasae" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="">
                                Documentar Solucion del Caso <b id="nCaseEnd" style="display: none"></b>
                              </h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                                <div class="row" >
                                  <div class="col-md-5">
                                    <label>Tema</label>
                                    <select class="form-control" id="slcTheme">
                                      
                                    </select>
                                  </div><br>
                                  <div class="col-md-12" style="margin-top: 10px;">
                                    <label>Descripcion</label>
                                    <textarea class="form-control" id="txaEndcase"></textarea>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-primary" id="btnEndCase">Terminar Caso</button>
                            </div>
                          </div>
                        </div>
                      </div>  


                    <!------------- CIERRE FINALIZAR CASO MODAL ----------------------->

                    <!----------------- NOTA REASIGNAR CASO MODAL ------------------------>
                      <div class="modal fade" id="ModalNoteRA" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="">Motivo de Reasignacion</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                                <div class="row" >
                                  <div class="col-md-12" style="margin-top: 10px;">
                                    <label>Descripcion</label>
                                    <textarea class="form-control" id="txaNoteRA"></textarea>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-primary" id="btnNoteRA">Solicitar reasignación</button>
                            </div>
                          </div>
                        </div>
                      </div>  
                    <!------------- CIERRE NOTA REASIGNAR CASO MODAL ----------------------->

                    <!--- TABLA USUARIOS ------------->
                    <aside style="margin-top: 20px; width: 100%;">
                      <table class="table table-bordered" id="tblUsers" style="width: 100%;">
                        <thead >
                          <tr>
                            <td style="width: 2%;">N-Caso</td>
                            <td style="width: 8%;">Nit</td>
                            <td style="width: 10%;">Cliente</td>
                            <td style="width: 20%;">Asunto</td>
                            <td style="width: 10%;">Asesor</td>
                            <td style="width: 10%;">Servicio</td>
                            <td style="width: 10%;"></td>
                          </tr>
                        </thead>
                        <tbody id="tbodyMyCases">
                          
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
</div>
