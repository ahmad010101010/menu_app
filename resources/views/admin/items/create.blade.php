@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card">
                <div class="card-header">
                    <h4>Add SubCategory
                        <a href="{{ route('item.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6  mb-3">
                            <div class="form-group">
                                <label for="category">SubCategory</label>
                                <select class="form-control" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select category</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Item Name</label>
                                <input type="text" name="name" class="form-control" value="" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Item price</label>
                                    <input type="number" name="price" class="form-control" value="" />
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="col-md-6  mb-3">
                                <label>Item Discount</label>
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



