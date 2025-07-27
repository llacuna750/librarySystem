<h2>Orders Report</h2>
<table border="1">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->product->name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->order_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>