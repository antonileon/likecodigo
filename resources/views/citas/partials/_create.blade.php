<div class="modal" id="registrar-cita" tabindex="-1" role="dialog" aria-labelledby="registrar-cita" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-clock"></i> Registrar cita</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content">
          <form action="" name="formRegistrarCita" id="formRegistrarCita" method="POST" autocomplete="off">
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="paciente_id">Paciente <b style="color:red;">*</b></label>
                  <select class="js-select2 form-select" id="paciente_id" name="paciente_id" style="width: 100%;" data-container="#registrar-cita" data-placeholder="Choose one..">
                    <option></option>
                    <option value="1">HTML</option>
                    <option value="2">CSS</option>
                    <option value="3">JavaScript</option>
                    <option value="4">PHP</option>
                    <option value="5">MySQL</option>
                    <option value="6">Ruby</option>
                    <option value="7">Angular</option>
                    <option value="8">React</option>
                    <option value="9">Vue.js</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="js-select2 form-select" id="example-select2-modal" name="example-select2-modal" style="width: 100%;" data-container="#registrar-cita" data-placeholder="Choose one..">
                          <option></option>
                          <option value="1">HTML</option>
                          <option value="2">CSS</option>
                          <option value="3">JavaScript</option>
                          <option value="4">PHP</option>
                          <option value="5">MySQL</option>
                          <option value="6">Ruby</option>
                          <option value="7">Angular</option>
                          <option value="8">React</option>
                          <option value="9">Vue.js</option>
                        </select>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full text-end bg-body">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="button" class="btn btn-alt-primary" id="SubmitRegistrarEspecialidad">
            <i class="fa fa-check opacity-50 me-1"></i> Guardar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>