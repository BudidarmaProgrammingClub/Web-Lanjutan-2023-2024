@extends('layouts.admin')
@section('title', 'Admin | Foods Data')

@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h5>Foods Data</h5>
                    <a href="{{ route('foods.create') }}" class="btn btn-primary">Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @forelse ($foods as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{ url('storage/foods/'. $item->image) }}" alt="" width="200px" class="img img-fluid"></td>
                                    <td>{{ $item->stock }}</td>
                                    <td>Rp. {{ $item->price }}</td>
                                    <td width="16%">
                                        <a href="{{ route('foods.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('foods.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center fw-bold">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
