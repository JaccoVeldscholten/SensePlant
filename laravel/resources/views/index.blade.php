@extends('layout.default')
@extends('snippets.navigation')

@section('title')
    Sense Plant
@endsection

@section('stylesheets')
    <link href="{{ asset('/css/default.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="container-fluid col-12 col-sm-6">
        <div class="jumbotron">
            <div class="col-sm-8 mx-auto">
                <h1>Sense Plant</h1>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vulputate felis id gravida gravida. Mauris euismod tempor lobortis. Morbi semper at ante eget gravida.</p>
                <p>In vitae sapien risus. Mauris pretium interdum laoreet. Cras aliquam, nunc vel finibus pulvinar, odio mauris pretium elit, ac tristique</p>
                <br>
                <p>
                    <a class="btn btn-primary" href="{{ url('/dashboard') }}" role="button">Bekijk het dashboard »</a>
                </p>
            </div>
        </div>
    </div>
@endsection

