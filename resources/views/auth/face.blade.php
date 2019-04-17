@extends('layouts.app')

@section('content')
<div class="container">
        <div class='options' style="text-align: center;">
            <video id="video" width="50%" autoplay></video>
            <canvas id="canvas" width="400" height="400" style="display:none;"></canvas>
            <br>
            <button id="snap" class="btn btn-primary">
                    Capture
            </button>
            <br><br>
            <label class="feedback"></label>
        </div>
@endsection
@push('script')
<script src="https://www.vsltech.co.in/facerec/js/ie-emulation-modes-warning.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    if (navigator.mediaDevices && 
            navigator.mediaDevices.getUserMedia){
    navigator.mediaDevices.getUserMedia({video: true}).then(
        function (stream) {
            video.src = video.srcObject=stream;
            video.play();
    });
    }
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    var button = $('#snap')
    button.click(function(){
    button.addClass('loading')
    context.drawImage(video, 0, 0, 400, 400);
    var dataURL = canvas.toDataURL();
    $.ajax({
        type: "POST",
        url: "{{route('upload_image')}}",
        data: {
            imgBase64: dataURL
        },
        success: function(response){
            $('.feedback').html(response.message);
        }
    })
})
</script>
@endpush
