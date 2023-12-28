@extends('layouts.admin')
@section('content')
<div class="main-panel">
    <div class="content-wrapper" >

        <div class="card">
            <div class="card-header">

                @if (session('message'))

                <div class="alert alert-success">{{session('message')}}</div>

                @endif

                @if (session('danger'))

                <div class="alert alert-danger">{{session('danger')}}</div>

                @endif


            <h4>category
                <a href="{{route('category.create')}}" class="btn btn-primary float-end">Add category</a>
            </h4>
        </div>

        <div class="card-body">
            <table class="table table-borderd table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Discount</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{ $category->discount ?? '0' }} %</td>

                    </tr>
                    @empty
                        No Category Found
                    @endforelse
                 
                </tbody>
            </table>
        </div>
  
</div>
@endsection