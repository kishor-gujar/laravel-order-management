@extends('layouts.order')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Update</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(count($errors))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <br/>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form role="form" method="POST" action="{{ route('orders.update', $order->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $order->name }}"  class="form-control" placeholder="Enter name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" name="phone" value="{{ $order->phone }}"  class="form-control" placeholder="Enter phone number">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <textarea name="address"  class="form-control" placeholder="Enter address">{{ $order->address }}</textarea>
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input type="text" name="city" value="{{ $order->city }}"  class="form-control" placeholder="Enter city">
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="town" value="{{ $order->town }}"  class="form-control" placeholder="Enter town">
                                    <span class="text-danger">{{ $errors->first('town') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Quantity</label>
                                    <input type="number" name="quantity" value="{{ $order->quantity }}"  class="form-control" placeholder="Enter quantity">
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="text" name="price" value="{{ $order->price }}"  class="form-control" placeholder="Enter price">
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $order->name }}"  class="form-control" placeholder="Enter state name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Product</label>
                                    <input type="text" name="product" value="{{ $order->product }}"  class="form-control" placeholder="Enter product">
                                    <span class="text-danger">{{ $errors->first('product') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Specific</label>
                                    <input type="text" name="specific" value="{{ $order->specific }}"  class="form-control" placeholder="Enter specific">
                                    <span class="text-danger">{{ $errors->first('specific') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Note</label>
                                    <input type="text" name="note" value="{{ $order->note }}"  class="form-control" placeholder="Enter note">
                                    <span class="text-danger">{{ $errors->first('note') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <select name="status_id" class="form-control">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" @if($status->id == $order->status_id) selected @endif>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection