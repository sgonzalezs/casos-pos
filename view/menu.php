

	 <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">

                    <!-- AGREGAR CASO -->
                    <div class="box-header with-border">
                          <button class="btn btn-success" id="btnagregar" data-toggle="modal" data-target="#NewcaseModal">
                            <i class="fa fa-plus-circle"></i>&nbsp Agregar Caso
                          </button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!----CIERRE AGREGAR -------->

                    <!-- MODAL AGREGAR CASO --->

                    <!--- TABLA USUARIOS ------------->
                    <aside style="margin-top: 20px;">
                      <table class="table table-bordered" id="tblUsers">
                        <thead>
                          <tr>
                            <td style="width: 10%;">Nit</td>
                            <td style="width: 10%;">Cliente</td>
                            <td style="width: 10%;">Fecha registro</td>
                            <td style="width: 20%;">Asunto</td>
                            <td style="width: 8%;">Asesor</td>
                            <td style="width: 12%;"></td>
                          </tr>
                        </thead>
                        <tbody id="tbodyCases">
                        </tbody>
                      </table>
                    </aside>
                  </div>
              </div>
          </div>
      </section>
    </div>
	