@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card">
                <div class="card-header">
                    <h4>Add menu
                        <a href="{{ route('menu.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card-body">
                    <form action="{{ route('menu.update',$menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
              

                            <div class="col-md-6  mb-3">
                                <label>Discount</label>
                                <input type="number" name="discount" class="form-control"
                                    value="" />
                                @error('discount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6  mb-3">
                                <button type="submit" class="btn btn-primary float-end">Save</button>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection



