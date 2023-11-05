<div class="tab-pane fade show  {{ $order }}" id="orders" role="tabpanel" aria-labelledby="orders-tab">
    <div class="myaccount-content">
        <h3>Orders</h3>
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data['my_order'])
                        @foreach ($data['my_order'] as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ formatCreatedAt($item->created_at) }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ "৳".$item->total_amt }}</td>
                                <td><a href="#" class="check-btn sqr-btn ">View</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>