@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div>
                        <form action="{{route('sending-sms')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                        please import file...
                        <textarea name="pasted_numbers" id="pasted_numbers" cols="30" rows="10" placeholder="Enter your numbers">

                        </textarea>
                        <input type="file" name="excel_data">
                        <button type="submit">Upload</button>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
