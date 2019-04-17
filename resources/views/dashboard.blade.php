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
@endpush
