<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Specificatie</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold mb-4">Product Specificatie</h1>
            
            <div class="mb-4">
                <p><strong>Product:</strong> {{ $product->ProductNaam }}</p>
                <p><strong>Allergenen:</strong> {{ $product->Allergenen ?: 'Geen allergenen' }}</p>
            </div>

            <h2 class="text-xl font-bold mb-2">Leveringen</h2>
            <table class="min-w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">Datum Levering</th>
                        <th class="py-2 px-4 text-left">Aantal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deliveries as $delivery)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $delivery->DatumLevering }}</td>
                            <td class="py-2 px-4">{{ $delivery->Aantal }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-4 px-4 text-center text-gray-500">
                                Geen leveringen in deze periode
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <a href="{{ route('products.index', ['startDate' => request('startDate'), 'endDate' => request('endDate')]) }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Terug naar overzicht
        </a>
    </div>
</body>
</html>
