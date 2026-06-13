<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Invoice - {{ $shipment->trackingnumber }}</title>
    <style>
        @page { size: A4; margin: 0; }
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; color: #333; background: #f5f5f5; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,.1); }
        .header { background: #2c3e50; color: #fff; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0 0; font-size: 16px; font-weight: normal; }
        .body { padding: 20px; }
        .tracking-box { text-align: center; padding: 15px; background: #f9f9f9; border: 1px dashed #ccc; border-radius: 5px; margin-bottom: 20px; }
        .tracking-number { font-family: monospace; font-size: 18px; font-weight: bold; letter-spacing: 1px; margin: 8px 0; }
        .status-badge { display: inline-block; padding: 5px 12px; border-radius: 12px; font-weight: bold; color: #fff; background: #3498db; }
        .status-delivered { background: #2ecc71; }
        .status-hold { background: #f39c12; }
        .info-grid { display: flex; gap: 20px; margin-bottom: 20px; }
        .info-col { flex: 1; }
        .info-col h3 { margin: 0 0 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; font-size: 14px; }
        .info-col p { margin: 4px 0; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f5f5f5; text-align: left; padding: 8px 10px; font-size: 13px; }
        td { padding: 8px 10px; border-top: 1px solid #eee; font-size: 13px; }
        .total-row { font-weight: bold; background: #f9f9f9; }
        .total-row td { border-top: 2px solid #333; }
        .text-end { text-align: right; }
        .stamp { display: inline-block; padding: 10px 20px; color: #de4c4c; font-size: 20px; font-weight: bold; border: 3px solid #de4c4c; border-radius: 8px; transform: rotate(-12deg); opacity: 0.8; margin: 20px; }
        .footer { text-align: center; padding: 16px; border-top: 1px solid #eee; font-size: 12px; color: #777; }
        .no-print { text-align: center; margin: 20px; }
        .no-print button { padding: 10px 24px; background: #2c3e50; color: #fff; border: none; cursor: pointer; font-size: 16px; border-radius: 4px; }
        @media print {
            body { background: #fff; }
            .container { box-shadow: none; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $settings->site_name }} Logistics</h1>
        <h2>Shipment Invoice</h2>
    </div>

    <div class="body">
        <div class="tracking-box">
            <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $shipment->trackingnumber }}&code=Code128"
                alt="{{ $shipment->trackingnumber }}" style="max-height:70px;">
            <div class="tracking-number">{{ $shipment->trackingnumber }}</div>
            <span class="status-badge {{ $shipment->status == 'Delivered' ? 'status-delivered' : ($shipment->status == 'Custom Hold' ? 'status-hold' : '') }}">
                {{ $shipment->status }}
            </span>
        </div>

        <div class="info-grid">
            <div class="info-col">
                <h3>Sender Information</h3>
                <p><strong>Name:</strong> {{ $shipment->sname }}</p>
                <p><strong>Address:</strong> {{ $shipment->saddress }}</p>
                <p><strong>Origin:</strong> {{ $shipment->take_off_point }}</p>
            </div>
            <div class="info-col">
                <h3>Receiver Information</h3>
                <p><strong>Name:</strong> {{ $shipment->name }}</p>
                <p><strong>Email:</strong> {{ $shipment->email }}</p>
                <p><strong>Phone:</strong> {{ $shipment->phone }}</p>
                <p><strong>Address:</strong> {{ $shipment->address }}</p>
                <p><strong>Destination:</strong> {{ $shipment->final_destination }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr><th>Package Information</th><th>Details</th></tr>
            </thead>
            <tbody>
                <tr><td>Quantity</td><td>{{ $shipment->qty }}</td></tr>
                <tr><td>Description</td><td>{{ $shipment->description }}</td></tr>
                <tr><td>Date Created</td><td>{{ $shipment->created_at->format('F d, Y') }}</td></tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr><th>Cost Description</th><th class="text-end">Amount ({{ $settings->s_currency }})</th></tr>
            </thead>
            <tbody>
                <tr><td>Shipping Cost</td><td class="text-end">{{ number_format($shipment->cost, 2) }}</td></tr>
                <tr><td>Clearance Cost</td><td class="text-end">{{ number_format($shipment->clearance_cost, 2) }}</td></tr>
                <tr class="total-row"><td>Total</td><td class="text-end">{{ number_format($shipment->cost + $shipment->clearance_cost, 2) }}</td></tr>
            </tbody>
        </table>

        @if($shipment->status == 'Delivered')
            <div class="text-end">
                <span class="stamp">DELIVERED</span>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Thank you for choosing {{ $settings->site_name }} for your shipping needs.</p>
        <p>{{ $settings->site_address ?? '' }} | {{ $settings->contact_email ?? '' }}</p>
        <p>&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
    </div>
</div>

<div class="no-print">
    <button onclick="window.print()">Print Invoice</button>
</div>
</body>
</html>
