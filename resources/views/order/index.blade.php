@extends('layouts.order')

@section('content')
           <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                   <thead>
                        <tr>
                            @foreach($statuses as $status)
                                <th class="@if(app('request')->input('status') == $status->id) active @endif">
                                    <a class="btn main-buttons" href="{{ route('realsearch', ['status' => $status->id]) }}">
                                        {{ $status->name }}
                                    </a>
                                </th>
                            @endforeach
                        </tr>
                   </thead>
                </table>
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead style="background: #2dce71; color: #fff;">
                    <tr>
                        <td>Orders</td>
                        <th>Date</th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Town</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Product</th>
                        <th>Specific</th>
                        <th>note</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><input value="{{ $order->id }}" type="checkbox"></td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->city }}</td>
                            <td>{{ $order->town }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->product }}</td>
                            <td>{{ $order->specific }}</td>
                            <td>{{ $order->note }}</td>
                            <td>
                                @if($order->status)
                                    {{ $order->status->name }}
                                @endif
                            </td>
                            <td class="actions">
                                <div class="btn-group">
                                    <a href="{{ route('orders.show', $order->id ) }}">
                                        <i class="fa fa-eye"></i></a>
                                    <a class="color-dark" href="{{ route('orders.edit', $order->id) }}">
                                        <i class="fa fa-edit"></i></a>
                                    <form action="{{ URL::route('orders.destroy', $order->id) }}" method="POST"  onsubmit="return confirm('Do you really want to delete this order?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button> <i class="fa fa-trash"></i></button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot style="background-color: #F4F6F9;">
                    <tr>
                        <th colspan="5">Showing to {{ $orders->count()}} of {{ $orders->total()}} Records</th>
                        <th colspan="5">{{ $orders->appends(request()->query())->links() }}</th>
                    </tr>
                    <tr>
                        <th><a class="btn btn-primary import-export" href="{{ route('orders.create') }}">
                                <i class="fa fa-plus-circle"></i>
                            </a> </th>
                        <th colspan="5">
                            <button type="button" class="btn btn-primary import-export" data-toggle="modal" data-target="#exampleModal">
                                Import from excel file
                            </button>
                        </th>
                        <th colspan="5">
                            <a class="btn btn-primary import-export" href="{{ route('downloadExcel') }}">Export to excel file</a></th>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

           <!-- Modal -->
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <form method="post" action="{{ route('importExcel') }}" enctype="multipart/form-data">
                           @csrf
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Import Excel file</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">

                               <div class="form-group">
                                   <label for="recipient-name" class="col-form-label">Select file:</label>
                                   <input name="import_file" type="file" class="form-control" required>
                               </div>

                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Import</button>
                       </div>
                       </form>
                   </div>
               </div>
           </div>

@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            $('#search').on('keyup', function () {
                $value = $(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{ route('search') }}',
                    data : {'search':$value},
                    success : function (data) {
//                        console.log(data);
                       $('tbody').html(data);
                    }
                })
            })
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "bInfo" : false,
                "bAutoWidth": true
            });
        })
    </script>
@endsection














