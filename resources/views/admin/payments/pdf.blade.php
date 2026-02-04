<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 6px;
        }
        .no-border {
            border: none !important;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        h2 {
            margin: 0;
        }
    </style>
</head>
<body>

{{-- ================= HEADER ================= --}}
<table class="no-border" style="margin-bottom: 20px;">
    <tr class="no-border">
        <td class="no-border">
            <h2>INVOICE</h2>
            <small>{{ $order->invoice->invoice_number ?? '' }}</small>
        </td>
        <td class="no-border text-right">
            @if(setting('billing_logo'))
                <img src="{{ public_path('storage/' . setting('billing_logo')) }}" height="60">
            @endif
        </td>
    </tr>
</table>

{{-- ================= INFO ================= --}}
<table class="no-border" style="margin-bottom: 15px;">
    <tr class="no-border">
        <td class="no-border">
            <strong>Invoice Date:</strong> {{ $order->created_at->format('d M Y') }}<br>
            <strong>Order ID:</strong> {{ $order->order_number }}<br>
            <strong>Payment Method:</strong> {{ ucfirst($order->payment->gateway ?? '-') }}<br>
            <strong>Payment Status:</strong> {{ ucfirst($order->payment->status ?? '-') }}
        </td>
        <td class="no-border">
            <strong>Billed To</strong><br>
            {{ $order->customer->first_name ?? '' }} {{ $order->customer->last_name ?? '' }}<br>
            {{ $order->customer->email ?? '' }}<br>
            {{ $order->customer->mobile ?? '' }}
        </td>
    </tr>
</table>

{{-- ================= ITEMS ================= --}}
<table>
    <thead>
        <tr>
            <th>Description</th>
            <th width="60">Qty</th>
            <th width="120">Rate (₹)</th>
            <th width="120">Total (₹)</th>
        </tr>
    </thead>
    <tbody>
        @if($type === 'subscription')
            <tr>
                <td>{{ $order->package->name ?? 'Subscription' }}</td>
                <td class="text-center">1</td>
                <td class="text-right">{{ number_format($order->amount, 2) }}</td>
                <td class="text-right">{{ number_format($order->amount, 2) }}</td>
            </tr>
        @else
            <tr>
                <td>
                    {{ $order->product['productTitle'] ?? '' }}<br>
                    <small>{{ $order->product['category'] ?? '' }}</small>
                </td>
                <td class="text-center">1</td>
                <td class="text-right">{{ number_format($order->amount, 2) }}</td>
                <td class="text-right">{{ number_format($order->amount, 2) }}</td>
            </tr>
        @endif
    </tbody>
</table>

{{-- ================= TOTALS ================= --}}
<table class="no-border" style="margin-top: 15px;">
    <tr class="no-border">
        <td class="no-border"></td>
        <td class="no-border" width="300">
            <table>
                <tr>
                    <th>Subtotal</th>
                    <td class="text-right">{{ number_format($order->amount, 2) }}</td>
                </tr>

                @if($type === 'product')
                    <tr>
                        <th>IGST</th>
                        <td class="text-right">{{ number_format($order->igst ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <th>CGST</th>
                        <td class="text-right">{{ number_format($order->cgst ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <th>SGST</th>
                        <td class="text-right">{{ number_format($order->sgst ?? 0, 2) }}</td>
                    </tr>
                @endif

                <tr>
                    <th><strong>Total</strong></th>
                    <td class="text-right">
                        <strong>{{ number_format($order->total, 2) }}</strong>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
