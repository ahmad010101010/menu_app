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


                    <h4>menu
                        <a href="{{ route('menu.create') }}" class="btn btn-primary float-end">Add menu</a>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-borderd table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menu Name</th>
                                <th>Discount</th>
                                <th>Update Discount</th>

                            
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->discount ?? '0' }} %</td>
                                <td>
                                <a href="{{ route('menu.edit',$menu->id) }}"
                                    class="btn btn-success mx-1 rounded-1">Edit Discount</a>
                                </td>
                                <td>
                                <a href="{{ route('menu.show',$menu->id) }}"
                                    class="btn btn-success mx-1 rounded-1">Show</a>
                                </td>
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