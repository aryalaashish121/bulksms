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
                            <form action="{{ route('send-sms') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                please import file...
                                <textarea name="pasted_numbers" id="pasted_numbers" cols="30" rows="10" placeholder="Enter your numbers">

                                </textarea>
                                {{-- <input type="text" name="group_id" value="1"> --}}
                                <input type="file" name="excel_data">
                                <button type="submit">send</button>
                            </form>
                        </div>
                        <div>

                            <table class="table">
                                <thead>
                                    <tr>
                                    @forelse ($headings as $key =>$heading)
                                        @foreach ($heading as $headingvalue)
                                        @for ($count=0;$count!=$rows;$count++)
                                        <th scope="col">{{$headingvalue[$count]}}</th>
                                        @endfor
                                        @endforeach
                                    @empty
                                    @endforelse
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        @forelse ($data as $key =>$heading)
                                        @foreach ($heading as $headingvalue)
                                        <tr>
                                        <td scope="col">{{$headingvalue['name']}}</td>
                                        <td scope="col">{{$headingvalue['phone']}}</td>
                               
                                    </tr>
                                        @endforeach
                                    @empty
                                    @endforelse
                              
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
