{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','orders')


{{-- Page Title --}}

@section('page-heading')

    @endsection
@section('main-content')
<div id="" class="container">
    <div class="row">
        <div class="col-9">
            <h2>Manage Orders <span class="text-black-50">0</span></h2>
        </div>


        <div class="col-12">
            <hr class="mt-4 mb-4">
        </div>

        <div class="col-md-12 p-5">

                    <table class="table table-hover table-striped table-bordered" id="OrderPagedataTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Orderer Name</th>
                            <th>Orderer Phone No</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>#MVS{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone_no }}</td>
                                <td>
                                    <p>
                                        @if ($order->is_seen_by_admin)
                                            <button type="button" class="btn btn-success btn-sm">Seen</button>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm">Unseen</button>
                                        @endif
                                    </p>

                                    <p>
                                        @if ($order->is_completed)
                                            <button type="button" class="btn btn-success btn-sm">Completed</button>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm">Not Completed</button>
                                        @endif
                                    </p>

                                    <p>
                                        @if ($order->is_paid)
                                            <button type="button" class="btn btn-success btn-sm">Paid</button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm">Unpaid</button>
                                        @endif
                                    </p>
                                </td>
                                <td>


                                    <a href="/orders/view/{{$order->id}}"  class="btn btn-info">View Order</a>

                                    <a href="#deleteModal{{ $order->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are You sure to delete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{--{!! route('admin.order.delete', $order->id) !!}--}}"  method="post">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Orderer Name</th>
                            <th>Orderer Phone No</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>


                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('script')
    <script type="text/javascript">
      /*  $(document).ready(function() {
        $('#dataTable').DataTable();
        } );*/
$(document).ready(function(){

    $('#OrderPagedataTable').dataTable({"order":false});
    $('.dataTables_length').addClass('bs-select');
});
    </script>
@endsection
