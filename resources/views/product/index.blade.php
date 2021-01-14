<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('product.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Create Product
                </a>
            </div>
            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="border px-6 py-4">ID</th>
                        <th class="border px-6 py-4">Photo</th>
                        <th class="border px-6 py-4">Name</th>
                        <th class="border px-6 py-4">Category</th>
                        <th class="border px-6 py-4">Description</th>
                        <th class="border px-6 py-4">Price</th>
                        <th class="border px-6 py-4">Stock</th>
                        <th class="border px-6 py-4">Weight</th>
                        <th class="border px-6 py-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($product as $item)
                            <tr>
                                <td class="border text-center">{{ $item->id }}</td>
                                <td class="border text-center">
                                    <img src="{{ $item->picturePath }}" alt="-" class="w-14">
                                </td>
                                <td class="border px-3 py-2 max-w-sm">{{ $item->name }}</td>
                                <td class="border px-3 py-2 max-w-sm">{{ $item->category->name }}</td>
                                <td class="border px-3 py-4 max-w-sm">{{ $item->description }}</td>
                                <td class="border px-6 py-4">{{ number_format($item->price) }}</td>
                                <td class="border px-6 py-4">{{ $item->stock }}</td>
                                <td class="border px-6 py-4">{{ $item->weight }}</td>
                                <td class="border px-3 py-4 text-center w-52">
                                    <a href="{{ route('product.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded inline-block">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                               <td colspan="6" class="border text-center p-5">
                                   Data Tidak Ditemukan
                               </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
                {{ $product->links() }}
            </div>
        </div>
    </div>
</x-app-layout>