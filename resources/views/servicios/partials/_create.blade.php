<div class="modal fade" id="registrar-servicio" tabindex="-1" role="dialog" aria-labelledby="registrar-servicio" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"><i class="nav-main-link-icon fa-solid fa-tooth"></i> Registrar servicio</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">
          <form action="" name="formRegistrarServicio" id="formRegistrarServicio" method="POST" autocomplete="off">
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="servicio">Servicio <b style="color:red;">*</b></label>
                  <input type="text" name="servicio" id="servicio" placeholder="Servicio" class="form-control" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="d-flex">
                    <label for="precio" class="block-title">Precio <b style="color:red;">*</b></label>
                    <div class="form-check form-switch form-check-inline">
                      <input class="form-check-input" type="checkbox" value="" id="example-switch-inline1" name="example-switch-inline1">
                      <label class="form-check-label" for="example-switch-inline1">Costo gratuito</label>
                    </div>
                  </div>
                  <input type="text" name="precio" id="precio" placeholder="Precio" class="form-control" autofocus="autofocus" onkeyup="format(precio)" onchange="format(precio)">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full block-content-sm text-end border-top">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="button" class="btn btn-alt-primary" id="SubmitRegistrarServicio">
            <i class="fa fa-check opacity-50 me-1"></i> Guardar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;   
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    var isNumber = (key >= 48 && key <= 57);
    var isSpecial = (key == 8 || key == 13 || key == 0 ||  key == 46);
    if(isNumber || isSpecial){
      return filter(tempValue);
    }
    return false;    
}
function filter(__val__){
  var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
  return (preg.test(__val__) === true);
}

function format(input) {
  var num = input.value.replace(/\./g,"");
  if(!isNaN(num)){
    num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
    num = num.split("").reverse().join("").replace(/^[\.]/,"");
    input.value = num;
  } else { 
    input.value = input.value.replace(/[^\d\.]*/g,"");
  }
}
</script>