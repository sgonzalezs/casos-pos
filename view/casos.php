
	  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <h1 style="margin: auto 0 0 45%;">Casos</h1>
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <?php 
                    if($_SESSION["Rol"]==1){ ?>
                    <!-- AGREGAR CASO -->
                    <div class="box-header with-border">
                          <button class="btn btn-success" onclick="" id="btnagregar" data-toggle="modal" data-target="#NewcaseModal">
                            <i class="fa fa-plus-circle"></i>&nbsp Agregar Caso
                          </button>
                    </div>
                    <!----CIERRE AGREGAR -------->
                    <?php } ?>  
                    <!-- MODAL AGREGAR CASO --->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="NewcaseModal" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title">Registrar nuevo Caso</h3>
                          </div>
                          <div class="modal-body">
                            <form class="container-fluid" id="formCase" method="POST" enctype="multipart/form-data">
                              <div class="row" id="divNewCase">
                                  <div class="col-md-3">
                                    <label for="recipient-name" class="col-form-label"><span style="color: red">*</span> Nit:</label>
                                    <input type="text" class="form-control" list="listClients" id="txt_nitCase" name="txt_nitCase" onchange="ListClient();">
                                    <datalist id="listClients">
                                     <?= $clients; ?>
                                   </datalist>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Cliente:</label>
                                    <input type="text" class="form-control" id="txt_clientCase" name="txt_clientCase">
                                  </div>
                                  <div class="col-md-5">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Asunto:</label>
                                    <input type="text" class="form-control" id="txt_AsntCase" name="txt_AsntCase">
                                  </div>
                                   <div class="col-md-12">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Descripción:</label>
                                    <textarea class="form-control" id="txa_DescCase" name="txa_DescCase"></textarea>
                                  </div>
                                  <div class="col-md-12">
                                    <label class="col-form-label">Adjuntar archivo</label>
                                    <input type="file" class="btn btn-default" id="file_Case" name="file_Case">
                                  </div>
                                  <div class="col-md-4">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Entorno:</label>
                                    <select class="form-control" id="slc_EnvCase" onchange="SlcEnv();">
                                    	<option value="">Seleccione --</option>
                                    	<?= $optionEnv;?>
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Programa:</label>
                                    <select class="form-control" id="slc_SoftCase" name="slc_SoftCase">
                                    	
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="message-text" class="col-form-label"><span style="color: red">*</span> Asesor:</label>
                                    <select class="form-control" id="slc_AcCase" name="slc_AcCase">
                                      <option value="">Seleccione --</option>
                                      <?= $listAc;?> 
                                    </select>
                                  </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" id="btnSaveCase" onclick="CleanDataCase();" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" onclick="SaveCase();" class="btn btn-primary">Guardar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!----CIERRE MODAL -------------->

                     <!-- MODAL VER MAS CASO --->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ShowMoreCase" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title" id="titleCase"></h3>
                          </div>
                          <div class="modal-body">
                            <form class="container-fluid">
                              <div class="row" >
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Nit:</h4>
                                    <h4 id="h_nit" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Cliente:</h4>
                                    <h4 id="h_cliente" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-4">
                                    <h4 for="recipient-name" class="col-form-label">Fecha de Registro:</h4>
                                    <h4 id="h_fech" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-10">
                                    <h4 for="recipient-name" class="col-form-label">Asunto:</h4>
                                    <h4 id="h_asnt" class="h4Cases"></h4>
                                  </div>
                                  <div class="col-md-2" id="divViewDoc">
                                    <a href="#" id="aViewDoc" target="_blank" title="Abrir documento adjunto">
                                      <i class="fa fa-folder iconFolder" style="font-size: 25px;" aria-hidden="true"></i>
                                    </a>
                                  </div>
                                  <div class="col-md-12">
                                    <h4 for="recipient-name" class="col-form-label">Descripcion:</h4>
                                    <h4 id="h_desc" class="h4Cases"></h4>
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

                    <!------------------ MODAL ASIGNAR ------------------------->

                      <div class="modal fade" id="ModalAsignar" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title" id="h4Assign"></h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                                <div class="row" >
                                    <div class="col-md-5">
                                      <h4 class="col-form-label">*Servicio:</h4>
                                      <select id="slcServiceCase" name="slcServiceCase" class="form-control">
                                        <option value="">Seleccione --</option>
                                        <?= $slcServ; ?>
                                      </select>
                                    </div>
                                    <div class="col-md-5">
                                      <h4 class="col-form-label">*Asignado:</h4>
                                      <select id="slcTecCase" name="slcTecCase" class="form-control" style="display: none;">
                                        <option value="">Seleccione --</option>
                                        <?= $userCase;?>
                                      </select>
                                      <h4 id="h4_Assgn"></h4>
                                    </div>
                                    <div class="col-md-12">
                                      <h4 class="col-form-label">Agregar Nota:</h4>
                                      <textarea class="form-control" id="txaNoteCase" name="txaNoteCase"></textarea>
                                    </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="CleanComponentsAssign();">Cerrar</button>
                              <button type="button" id="btnSaveAssign" name="btnSaveAssign" class="btn btn-primary">Asignar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    <!-------------------CIERRE MODAL ASIGNAR ---------------------->

                    <!------------------------- MODAL VER DOCUMENTO --------------------------->
    
<!--                     <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ViewDocument" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img id="documentCase" src="" width="100%" height="auto" />
                          </div>
                          <div class="modal-footer">
                            <button type="button"class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <---------------------- CIERRE MODAL DOCUMENTO ------------------------> 

                    <!--- TABLA USUARIOS ------------->
                    <aside style="margin-top: 20px; width: 100%;">
                      <table class="table table-bordered" id="tblUsers" style="width: 100%;">
                        <thead>
                          <tr>
                            <td style="width: 2%;">N-Caso</td>
                            <td style="width: 8%;">Nit</td>
                            <td style="width: 10%;">Cliente</td>
                            <td style="width: 10%;">Fecha registro</td>
                            <td style="width: 20%;">Asunto</td>
                            <td style="width: 8%;">Asesor</td>
                            <td style="width: 12%;"></td>
                          </tr>
                        </thead>
                        <tbody id="tbodyCases">
                          <?= $tablecases; ?>
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
