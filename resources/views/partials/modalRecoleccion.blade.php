
<!-- Modal -->
<div class="modal fade" id="vexsoluciones_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vexsoluciones_modal">Solicitar recolección</h5>
        <button type="button" id="vexsoluciones_close_modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="vexsoluciones_modal modal-body">
          <form action="{{ route('solicitar') }}" method="post" id="form-1">
            @csrf
            <input type="hidden" name="guide_number" value="{{$orderdb['shipping_id']}}">
            <div class="form-group">
              <label for="exampleFormControlInput1">Fecha de recolección</label>
              <input type="date" class="form-control" id="exampleFormControlInput1" name="pickupdate">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Hora de recolección</label>
              <input type="time" class="form-control" id="exampleFormControlInput1" name="pickuphour">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Comentario adicional</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary mb-3">@lang('servientrega.buttons.save')</button>
        </form>
      <div class="modal-footer">
        <button id="vexsoluciones_cancel_modal" type="button" class="btn btn-secondary" data-dismiss="modal">@lang('servientrega.buttons.cancel')</button>
      </div>
    </div>
  </div>
</div>