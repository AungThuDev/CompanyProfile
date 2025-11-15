@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="max-w-4xl mx-auto my-8">

    {{-- Card Container --}}
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">

        {{-- Content --}}
        <div class="p-6 space-y-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $service->title }}</h1>
            <p class="text-gray-500 text-sm">Detailed information about this service</p>

            <div class="border-t border-gray-200 pt-4 space-y-2 flex items-start gap-4">
               {{-- Small Image --}}
               <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden border border-gray-200">
                   @if($service->image && file_exists(storage_path('app/public/' . $service->image)))
                       <img src="{{ asset('storage/' . $service->image) }}" 
                            alt="{{ $service->title }}" 
                            class="w-full h-full object-cover object-center">
                   @else
                       <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-xs">
                           No Image
                       </div>
                   @endif
               </div>
           
               {{-- Details Text --}}
               <div class="flex-1 space-y-1">
                   <p class="text-gray-700"><span class="font-semibold">Description:</span> {{ $service->description ?? 'N/A' }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Display Order:</span> {{ $service->display_order }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Slug:</span> {{ $service->slug }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Creator:</span> {{ $service->creator->name ?? 'N/A' }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Updator:</span> {{ $service->updator->name ?? 'N/A' }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Created At:</span> {{ $service->created_at->format('M d, Y') }}</p>
                   <p class="text-gray-700"><span class="font-semibold">Updated At:</span> {{ $service->updated_at->format('M d, Y') }}</p>
               </div>
           </div>
           

            {{-- Actions --}}
            <div class="flex flex-wrap gap-3 pt-4">
                <a href="{{ route('dashboard.services.edit', $service->id) }}" 
                   class="px-5 py-2 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Edit</a>
                <a href="{{ route('dashboard.services.index') }}" 
                   class="px-5 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Back</a>
            </div>
        </div>

    </div>

</div>
@endsection
