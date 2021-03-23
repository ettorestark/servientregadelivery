
<!-- Modal -->
<div class="modal fade" id="vexsoluciones_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vexsoluciones_modal">@lang('servientrega.preparationform.modal.title')</h5>
        <button type="button" id="vexsoluciones_close_modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="vexsoluciones_modal modal-body">
        <form method="POST" action="{{ route('products.save') }}" >
          @csrf
          <input type="hidden" name="id_producto" id="id_producto">
          <input type="hidden" name="id_meta" id="id_meta">
          <div class="row paddin-top-md">
              <div>
                <div style="width: 100px; float: left">
                    <a class="image-ratio image-ratio--square image-ratio--square--100 image-ratio--interactive" href="#" id="modal-image">
                    </a></div>
                <div class="text-left"  style="padding-left:20px; width: 300px; float: left">
                    <div> <a href="#"><b id="title-modal"></b></a><br></div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row paddin-top-md mb-0 mt-2">
                <div class="tip full-width" data-hover="@lang('servientrega.preparationform.enable.desc')">
                    <label class="text-left pl-4"> <input type="checkbox" name="available_for_servientrega" id="available_for_servientrega"> @lang('servientrega.preparationform.enable.label') </label>
                </div>
                <em class="small help text-left pl-4">@lang('servientrega.preparationform.enable.desc')</em>
            </div>
            
            <div class="row paddin-top-md mb-0 mt-2">
              <label for="staticEmail" class="col-sm-2 col-form-label">Alto</label>
              <div class="col-sm-8" style="flex-flow: nowrap;display: inline-flex;">
                <input type="text" class="form-control-plaintext" id="alto" name="alto" required>
                <div class="input-group-prepend">
                  <div class="input-group-text" style="font-size: 1.6rem;">cm</div>
                </div>
              </div>
            </div>
            <div class="row paddin-top-md mb-0 mt-2">
              <label for="staticEmail" class="col-sm-2 col-form-label">Largo</label>
              <div class="col-sm-8" style="flex-flow: nowrap;display: inline-flex;">
                <input type="text" class="form-control-plaintext" id="largo" name="largo" required>
                <div class="input-group-prepend">
                  <div class="input-group-text" style="font-size: 1.6rem;">cm</div>
                </div>
              </div>
            </div>
            <div class="row paddin-top-md mb-4 mt-2">
              <label for="staticEmail" class="col-sm-2 col-form-label">Ancho</label>
              <div class="col-sm-8" style="flex-flow: nowrap;display: inline-flex;">
                <input type="text" class="form-control-plaintext" id="ancho" name="ancho" required>
                <div class="input-group-prepend">
                  <div class="input-group-text" style="font-size: 1.6rem;">cm</div>
                </div>
              </div>
            </div>
            

            <button type="submit" class="btn btn-primary">@lang('servientrega.buttons.save')</button>
          </div>
        </form>
      <div class="modal-footer">
        <button id="vexsoluciones_cancel_modal" type="button" class="btn btn-secondary" data-dismiss="modal">@lang('servientrega.buttons.cancel')</button>
      </div>
    </div>
  </div>
</div>