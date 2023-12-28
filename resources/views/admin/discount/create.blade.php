@extends('layouts.admin')
@section('content')
<div class="main-panel">
    <div class="content-wrapper" >

    <div class="card">
        <div class="card-header">
            <h4>Add Discount for your menu
                <a href="{{route('menu.index')}}" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>

        <div class="card-body">
            <form action="{{route('discount.store')}}" method="POST" \>
                @csrf

                <div class=" row">

                    <div class="col-md-6  mb-3">
                    <label>Discount in %</label>
                    <input type="number" name="discount" class="form-control" value=""/>
                    @error('discount')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>
                   
                

                    <div class="col-md-12  mb-3">
                        <button type="submit" class="btn btn-primary flot-end">Save</button>
                    </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection