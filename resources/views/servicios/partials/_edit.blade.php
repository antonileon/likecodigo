<div class="modal fade" id="editar-servicio" tabindex="-1" role="dialog" aria-labelledby="editar-servicio" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-tooth"></i> Editar servicio</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">
          <form action="" name="formEditarServicio" id="formEditarServicio" method="POST" autocomplete="off">
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputServicio">Servicio <b style="color:red;">*</b></label>
                  <input type="text" name="servicio" id="inputServicio" placeholder="Servicio" class="form-control" autofocus="autofocus">
                  <input type="hidden" name="inputSlug" id="inputSlugServicio">
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="d-flex">
                    <label for="inputPrecio" class="block-title">Precio <b style="color:red;">*</b></label>
                    <div class="form-check form-switch form-check-inline">
                      <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="example-switch-inline1">
                      <label class="form-check-label" for="example-switch-inline1">Costo gratuito</label>
                    </div>
                  </div>
                  <input type="text" name="precio" id="inputPrecio" placeholder="Precio" class="form-control" autofocus="autofocus" onkeyup="format(precio)" onchange="format(precio)">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full block-content-sm text-end border-top">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="button" class="btn btn-alt-primary" id="SubmitEditarServicio">
            <i class="fa fa-check opacity-50 me-1"></i> Actualizar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>