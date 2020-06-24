

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <h1 style="margin: 0 0 3% 35%; ">Mis Asignados</h1>
              <div class="col-md-12 col-sm-12 col-xl-12 col-xs-12">
                  <div class="box">

                    <!-------------------VER NOTA MODAL ------------------------>
                  <!--   <div class="modal fade" id="ModalNota" tabindex="-1" role="dialog" aria-hidden="true">
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
                      </div>   -->
                    <!------------- CIERRE VER NOTA MODAL ----------------------->
                    <!-- MODAL VER MAS CASO --->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ShowMoreMyAssgned" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title" id="titleMyAssgn"></h3>
                          </div>
                          <div class="modal-body">
                            <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Nit:</h4>
                                    <h4 id="h_nitMyAssg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Cliente:</h4>
                                    <h4 id="h_clienteMyAssg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Registro:</h4>
                                    <h4 id="h_fechMyAssg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-10">
                                    <h4 for="recipient-name" class="col-form-label">Asunto:</h4>
                                    <h4 id="h_asntMyAssg" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-2" id="divViewDocMyAssign">
                                    <a href="#" id="aViewDoc_MyAssign" target="_blank" title="Abrir documento adjunto">
                                      <i class="fa fa-folder iconFolder" style="font-size: 25px;" aria-hidden="true"></i>
                                    </a>
                                  </div>
                                  <div class="col-md-12">
                                    <h4 for="recipient-name" class="col-form-label">Descripcion:</h4>
                                    <h4 id="h_descMyAssg" class="h4Cases"></h4>
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
                    <!--------------CIERRE MODAL VER MAS CASO--------------------->


                    <!--- TABLA USUARIOS ------------->
                    <aside style="margin-top: 20px; width: 100%;">
                      <table class="table table-bordered" id="tblUsers" style="width: 100%;">
                        <thead >
                          <tr>
                            <td style="width: 2%;">N-Caso</td>
                            <td style="width: 10%;">Nit</td>
                            <td style="width: 20%;">Cliente</td>
                            <td style="width: 20%;">Asunto</td>
                            <td style="width: 10%;">Fecha de Asignacion</td>
                            <td style="width: 10%;">Estado</td>
                            <td style="width: 15%;">Asignado</td>
                            <td style="width: 13%;"></td>
                          </tr>
                        </thead>
                        <tbody id="tbodyCases">
                        	<?= $listMyAssigned;?>
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
