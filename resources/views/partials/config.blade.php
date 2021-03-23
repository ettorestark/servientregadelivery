<section id="vexsoluciones_sixth_section">
    <aside class="vexsoluciones_aside">
        <h2>@lang('servientrega.formconfig.section')</h2>
        <p>@lang('servientrega.formconfig.subsection')</p>
    </aside>
    <article>
        <div class="vexsoluciones_card card">
            {{-- <h5 class="vexsoluciones_title">@lang('servientrega.formconfig.basic')</h5> --}}
            <div class="row paddin-top-md">
                <div class="tip full-width">
                    <label>@lang('servientrega.formconfig.accountinfo'):
                        &nbsp;&nbsp;&nbsp;&nbsp;<input required="required" name="SETT_SERVER" type="radio" value="Production" 
                        @if($settings->SETT_SERVER == "Production") checked="checked" @endif>
                    <label class="display-inline">Production</label>
                    <input required="required" name="SETT_SERVER" type="radio" value="Test" 
                            @if($settings->SETT_SERVER == "Test") checked="checked" @endif>
                            <label class="display-inline">Testing</label>

                    </label>
                </div>
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.user')</label>
                <div class="tip full-width" >
                    <input required="required" name="SETT_METHOD_TITLE" type="text">
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.password')</label>
                <div class="tip full-width" >
                    <input required="required" name="SETT_METHOD_TITLE" type="text">
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.code')</label>
                <div class="tip full-width" >
                    <input required="required" name="SETT_METHOD_TITLE" type="text">
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.NIT')</label>
                <div class="tip full-width" >
                    <input required="required" name="SETT_METHOD_TITLE" type="text">
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.city')</label>
                <div class="tip full-width" >
                    <input required="required" name="SETT_METHOD_TITLE" type="text">
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.pay')</label>
                <div class="tip full-width" >
                    <select class="form-control">
                        <option value="2" selected="selected">crédito</option>
                    </select>
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            <div class="row paddin-top-md">
                <label>@lang('servientrega.formconfig.product')</label>
                <div class="tip full-width" >
                    <select class="form-control">
                        <option value="2" selected="selected">crédito</option>
                    </select>
                </div>
                {{-- <em class="small  help ">@lang('servientrega.method.desc')</em> --}}
            </div>
            
            <div class="row paddin-top-md" data-hover="@lang('servientrega.enable.desc')">
                <label>@lang('servientrega.formconfig.logistic'):
                    &nbsp;&nbsp;&nbsp;&nbsp;<input required="required" name="SETT_SERVER" type="radio" value="Production" 
                    @if($settings->SETT_SERVER == "Production") checked="checked" @endif>
                <label class="display-inline">SI</label>
                <input required="required" name="SETT_SERVER" type="radio" value="Test" 
                        @if($settings->SETT_SERVER == "Test") checked="checked" @endif>
                        <label class="display-inline">NO</label>

                </label>
            </div>
            <div class="tip full-width">
                <label>@lang('servientrega.formconfig.guides'):
                    &nbsp;&nbsp;&nbsp;&nbsp;<input required="required" name="SETT_SERVER" type="radio" value="Production" 
                    @if($settings->SETT_SERVER == "Production") checked="checked" @endif>
                <label class="display-inline">SI</label>
                <input required="required" name="SETT_SERVER" type="radio" value="Test" 
                        @if($settings->SETT_SERVER == "Test") checked="checked" @endif>
                        <label class="display-inline">NO</label>

                </label>
            </div>
        </div>
        
    </article>
</section>