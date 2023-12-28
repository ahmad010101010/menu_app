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
                        <a href="{{ route('item.create') }}" class="btn btn-primary float-end">Add Items</a>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>SubCategory Name</th>
                                <th>Price</th>

                                <th>Discount</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->subcategory->name }}</td>
                                <td>{{ $item->price }}</td>

                                <td>{{ $item->discount ?? '0' }} %</td>
                            </tr>
                            @empty
                                No Items Found
                            @endforelse
                         
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
@endsection