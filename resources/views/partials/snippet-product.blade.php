
<style>
    fieldset.shipping-servientrega-delivery{
        margin-bottom: 0px;
        border: 3px solid #12924B;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    fieldset.shipping-servientrega-delivery legend{
        font-size: 17px;
        font-weight: 600;
        padding-right: 6px;
    }
</style>

<fieldset class="shipping-servientrega-delivery">
    <legend style="display: flex; align-items: center; justify-content: center;"><img src= "{{ asset('img/logo.png') }}" width="140"> {{ $settings->getMethodTitle() }}</legend>
    <div class="shipping-servientrega-delivery-body">
       
        <div class="shipping-servientrega-delivery-info">
        {{ __('servientrega.storefront.template.products.available') }} {{ $settings->getMethodTitle() }} <b>{{  $settings->getAllowScheduled() ? __('servientrega.storefront.template.products.choosewhen') : "" }}</b>
        </div>
    </div>
</fieldset>