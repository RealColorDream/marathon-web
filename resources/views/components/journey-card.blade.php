<div class="border p-4 rounded-lg shadow">
    <img src="{{ $journey->image }}" alt="{{ $journey->title }}" class="w-full h-48 object-cover rounded">
    <h2 class="text-xl font-bold mt-2">{{ $journey->title }}</h2>
    <p>{{ $journey->description }}</p>
    <p class="text-sm text-gray-500">Continent : {{ $journey->continent }}</p>
    <p class="text-sm text-gray-500">{{ $journey->likes }} likes</p>
</div>
