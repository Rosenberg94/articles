@extends('layouts.master')
@include('sections.mainnav')
@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class=" card col-md-8 mt-3 bg-grey">
            <h2 class="text-center mt-3 mb-3">Create category</h2>
            <form action="{{ route("category_create") }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Category name</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
