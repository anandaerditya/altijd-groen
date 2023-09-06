@extends('layouts.app')

@section('page.contents')
    <form action="@if($action == 'new') {{ route('admin.store') }} @else {{ route('admin.update') }} @endif" method="post">
        @csrf
        @if($action == 'update')
            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="user_id" value="{{ $data->user_id }}">
        @endif
        <div class="card p-2 mb-4">
            <div class="card-body">
                @if(session()->has('report'))
                    @foreach(session()->get('report') as $key => $report)
                        <div class="alert alert-warning">{{ $report }}</div>
                    @endforeach
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h5>Add Item</h5>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text">Category</span>
                    <select class="form-select" name="category_code" aria-label="Category Code">
                        @if(!empty($category))
                            @foreach($category as $item)
                                <option value="{{ $item->code }}" @if(!empty($data->category_code) && $data->category_code == $item->code) selected @endif>{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text">Unit</span>
                    <input class="form-control" type="text" name="unit_code" placeholder="Unit Code" required aria-label="Unit Code" value="@if($action == 'update'){{ $data->unit_code }}@endif">
                </div>
                @if($action == 'update')
                        <div class="input-group mb-4">
                            <span class="input-group-text">Item Code</span>
                            <input class="form-control" type="text" name="code" placeholder="Item Code" required aria-label="Item Code" value="@if($action == 'update'){{ $data->code }}@endif">
                        </div>
                @endif
                <div class="input-group mb-4">
                    <span class="input-group-text">Name</span>
                    <input class="form-control" type="text" name="name" placeholder="Item Name" required aria-label="Item Name" maxlength="20" value="@if($action == 'update'){{ $data->name }}@endif">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text">Quantity</span>
                    <input class="form-control" type="number" name="quantity" placeholder="Quantity" aria-label="Item Name" value="@if($action == 'update'){{ $data->quantity }}@endif">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
