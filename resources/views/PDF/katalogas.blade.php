<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Produktu PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Produktų sąrašas</h2>
    <table>
        <thead>
            <tr>
                <th>Produktas</th>
                <th>Kaina</th>
                <th>Kiekis</th>
                <th>Aprašymas</th>
                <th>Kategorija</th>
                <th>Įmonė</th>
                <th>Miestas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }} €</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->company->name }}</td>
                    <td>{{ $product->company->city->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
