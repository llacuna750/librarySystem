<form method="GET">
    <input type="text" name="search" value="{{ request('search') }}">
    <button type="submit">Search</button>
</form>
<table>
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
{{ $orders->links() }}
<a href="{{ route('orders.pdf') }}">Download PDF</a>

// resources/views/orders/pdf.blade.php
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