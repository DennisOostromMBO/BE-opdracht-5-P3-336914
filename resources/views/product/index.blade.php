<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Geleverde Producten</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Overzicht Geleverde Producten</h1>

        <!-- Date Filter Form -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="flex items-center gap-4">
                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Start Datum:</label>
                    <input type="date" name="startDate" id="startDate" 
                           value="{{ request('startDate') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Eind Datum:</label>
                    <input type="date" name="endDate" id="endDate" 
                           value="{{ request('endDate') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="self-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Maak selectie</button>
                </div>
            </div>
        </form>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm text-left">Leverancier</th>
                    <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm text-left">Contact Persoon</th>
                    <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm text-left">Product</th>
                    <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm text-left">Totaal Aantal</th>
                    <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm text-left">Specificatie</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-left">{{ $product->LeverancierNaam }}</td>
                            <td class="py-3 px-4 text-left">{{ $product->ContactPersoon }}</td>
                            <td class="py-3 px-4 text-left">{{ $product->ProductNaam }}</td>
                            <td class="py-3 px-4 text-left">{{ $product->TotaalAantal }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('products.show', ['id' => $product->ProductId, 'startDate' => request('startDate'), 'endDate' => request('endDate')]) }}" 
                                   class="text-blue-500 hover:text-blue-700">?</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="py-8 px-4 text-center text-gray-500 text-lg">
                            Er zijn geen leveringen geweest van producten in deze periode
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
