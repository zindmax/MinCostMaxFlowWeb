@extends("layouts")
@section("head")
    @include("_head")
@endsection
@section("content")
    <div id='canvas'></div>
    <script type="text/javascript" src="{{asset('js/test.js')}}"></script>
@endsection
