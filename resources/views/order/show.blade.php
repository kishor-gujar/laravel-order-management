@extends('layouts.order')

@section('content')
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body" style="overflow: hidden;">
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                    <th>Order Date:</th>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <th>Order Id:</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td>{{ $order->name }}</td>
                </tr>
                <tr>
                    <th>Phone No.:</th>
                    <td>{{ $order->phone }}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td>{{ $order->city }}</td>
                </tr>
                <tr>
                    <th>Town:</th>
                    <td>{{ $order->town }}</td>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>{{ $order->price }}</td>
                </tr>
                <tr>
                    <th>Product:</th>
                    <td>{{ $order->product }}</td>
                </tr>
                <tr>
                    <th>Specific:</th>
                    <td>{{ $order->specific }}</td>
                </tr>
                <tr>
                    <th>note:</th>
                    <td>{{ $order->note }}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{ $order->date }}</td>
                </tr>
                <tr>
                    <th>Order Status:</th>
                    <td>{{ $order->status->name }}</td>
                </tr>
                </tr> <tr>
                    <th><a class="btn btn-primary" href="/orders">Orders</a></th>
                    <td><a class="btn btn-info" href="{{ route('orders.edit', $order->id) }}">Edit</a></td>
                </tr>

            </table>
        </div>
    </div>
@endsection