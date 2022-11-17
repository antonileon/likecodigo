<div class="modal fade" id="editar-especialidad" tabindex="-1" role="dialog" aria-labelledby="editar-especialidad" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-stethoscope"></i> Editar especialidad</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">
          <form action="" name="formEditarEspecialidad" id="formEditarEspecialidad" method="POST" autocomplete="off">
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="especialidad">Especialidad <b style="color:red;">*</b></label>
                  <input type="hidden" name="inputSlugEspecialidad" id="inputSlugEspecialidad">
                  <input type="text" name="especialidad" id="inputEspecialidad" placeholder="Especialidad" class="form-control" autofocus="autofocus">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full block-content-sm text-end border-top">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="button" class="btn btn-alt-primary" id="SubmitEditarEspecialidad">
            <i class="fa fa-check opacity-50 me-1"></i> Actualizar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>