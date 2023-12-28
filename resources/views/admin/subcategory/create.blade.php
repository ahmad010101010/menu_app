@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="card">
                <div class="card-header">
                    <h4>Add SubCategory
                        <a href="{{ route('subcategory.index') }}" class="btn btn-danger float-end">Back</a>
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
                    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6  mb-3">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>SubCategory Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6  mb-3">
                                <label>Discount</label>
                                <input type="number" name="discount" class="form-control"
                                    value="{{ old('selling_price') }}" />
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



