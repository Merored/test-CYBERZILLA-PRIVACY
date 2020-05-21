@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <router-view name="tasksIndex"></router-view>
                <router-view></router-view>
            </div>
        </div>
    </div>
</div>
@endsection
