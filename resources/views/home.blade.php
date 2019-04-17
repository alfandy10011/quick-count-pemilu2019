@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-5">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($data->qr_code))!!} ">
                        </div>
                        <div class="col-md-4">
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td>{{$data->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="POST" action="{{route('upload.image')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Upload Image</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                            <a href="{{route('python')}}" class="btn btn-primary">Capture photo</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
