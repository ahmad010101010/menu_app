@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card">
                <div class="card-header">

                    @if (session('message'))

                    <div class="alert alert-success">{{session('message')}}</div>

                    @endif

                    @if (session('danger'))

                    <div class="alert alert-danger">{{session('danger')}}</div>

                    @endif


                    <h4>product
                        <a href="{{ route('subcategory.create') }}" class="btn btn-primary float-end">Add SubCategory</a>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SubCategory Name</th>
                                <th>Category</th>
                                <th>Discount</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subctegories as $subctegory)
                            <tr>
                                <td>{{ $subctegory->id }}</td>
                                <td>{{ $subctegory->name }}</td>
                                <td>{{ $subctegory->category->name }}</td>
                                <td>{{ $subctegory->discount ?? '0' }} %</td>

                            </tr>
                            @empty
                             No SubCategory Found   
                            @endforelse
                           
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
@endsection