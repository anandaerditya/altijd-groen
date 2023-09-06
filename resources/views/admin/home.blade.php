@extends('layouts.app')

@section('page.contents')
    <section class="mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h5>All Items</h5>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.create') }}" class="btn btn-primary">Add Item</a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <td>No.</td>
                            <td>Code</td>
                            <td>Category</td>
                            <td>Name</td>
                            <td>Quantity</td>
                            <td>Unit</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $data->firstItem() + $key }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->prod_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit', ['id' => $item->id]) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-heading text-center">No Data</div>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
