@extends('layouts.admin')
@section('title', 'Admin | Foods Edit')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Foods Edit</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('foods.update', $foods->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $foods->name }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input name">
                                @error('name')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" value="{{ $foods->stock }}" id="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Input stock">
                                @error('stock')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" value="{{ $foods->price }}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Input price">
                                @error('price')
                                    <div class="alert alert-danger mt-2 mb-2 p-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end ms-2">Update</button>
                                <a href="{{ route('foods.index') }}" class="btn btn-secondary float-end">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
