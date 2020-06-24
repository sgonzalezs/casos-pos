
  <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">

                    <!-- AGREGAR USUARIO -->
                    <div class="box-header with-border">
                          <button class="btn btn-success" id="btnagregar" data-toggle="modal" data-target="#modalNewUser">
                            <i class="fa fa-plus-circle"></i>&nbsp Agregar Usuario
                          </button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!----CIERRE AGREGAR -------->

                    <!-- MODAL AGREGAR USUARIO --->
                    <div class="modal fade" tabindex="-1" role="dialog" id="modalNewUser" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content" style="border-radius: 5px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CleanData();">
                              <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                            </button>
                            <h3 class="modal-title">Registrar nuevo usuario</h3>
                          </div>
                          <div class="modal-body" >
                            <form class="container-fluid">
                              <div id="divNewUser">
                                  <div class="col-md-6">
                                    <label for="recipient-name" class="col-form-label">Usuario:</label>
                                    <input type="text" class="form-control" id="txt_userId" placeholder="Usuario">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="message-text" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="txt_nameUser" name="" placeholder="Nombres">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="message-text" class="col-form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="txt_lastnameUser" name="" placeholder="Apellidos">
                                  </div>
                                   <div class="col-md-6">
                                    <label for="message-text" class="col-form-label">Seleccionar Rol:</label>
                                    <select class="form-control" id="slc_RolUser">
                                      <option value="">Seleccione --</option>
                                      <?= $optionRol;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Correo:</label>
                                    <input type="text" class="form-control" id="txt_emailUser" name="" placeholder="user@mail.com">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="message-text" class="col-form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="txt_passUser" name="" placeholder="******">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="message-text" class="col-form-label">Repetir Contraseña:</label>
                                    <input type="password" class="form-control" id="txt_repassUser" name="" placeholder="******">
                                  </div>
                                 
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" onclick="CleanData();" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" onclick="SaveUser();" class="btn btn-primary">Guardar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!----CIERRE MODAL -------------->

                     <!-- MODAL AGREGAR USUARIO --->
                    <div class="modal fade" id="modalChangeAssesor" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title">Cambiar usuario para los casos</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                                <div class="row" >
                                    <div class="col-md-6">
                                      <h4 class="col-form-label">Cambiar usuario:</h4>
                                      <select id="slcNewUser" name="slcNewUser" class="form-control">
                                        <option value="">Seleccione --</option>

                                      </select>
                                    </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                              <button type="button" id="btnChangeUser" name="btnSaveAssign" class="btn btn-primary">Cambiar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!----CIERRE MODAL -------------->

                     <!-- MODAL AGREGAR USUARIO --->
                    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                              </button>
                              <h4 class="modal-title">Editar informacion</h4>
                            </div>
                            <div class="modal-body">
                              <form class="container-fluid">
                                <div class="row" >
                                    <div class="col-md-6">
                                      <h4 class="col-form-label">Cambiar usuario:</h4>
                                      <select id="" name="" class="form-control">
                                        <option value="">Seleccione --</option>

                                      </select>
                                    </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
                              <button type="button" id="" name="" class="btn btn-primary">Cambiar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!----CIERRE MODAL -------------->

                    <!--- TABLA USUARIOS ------------->
                    <aside style="margin-top: 20px; width: 100%;">
                      <table class="table table-bordered" id="tblUsers" style="width: 100%;">
                        <thead>
                          <tr>
                            <!-- <td class="col-md-1">Id Usuario</td> -->
                            <td class="col-md-2">Nombre</td>
                            <td class="col-md-2">Apellidos</td>
                            <td class="col-md-2">Correo</td>
                            <td class="col-md-2">Rol</td>
                            <td class="col-md-2"></td>
                          </tr>
                        </thead>
                        <tbody id="dataUsers">
                          <?= $tableUsers;?>
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
