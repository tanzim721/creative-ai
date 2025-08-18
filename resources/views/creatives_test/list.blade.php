@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative list')

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 1)
            <div class="dashboard">
                <div class="nav flex justify-between items-center text-white px-4 py-2 rounded-tl-xl rounded-tr-xl">
                </div>
                <div class="dashboard_main contain">
                    <h1 class="text-white text-sm font-semibold mt-10">Creative List</h1>
                    <table class="text-white mt-3 w-full text-xs">
                        <thead>
                            <tr class="h-auto md:h-12 row-wrapper py-2 md:py-0">
                                <th class="basis-1/12 md:basis-2/12">#</th>
                                <th class="basis-4/12 md:basis-3/12">Creative Name</th>
                                <th class="basis-2/12 hidden md:block">Template</th>
                                <th class="basis-2/12 md:basis-2/12 md:block ms-2">Action</th>
                                <th class="basis-2/12 hidden md:block ms-3">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- @dump($creatives) --}}
                            @foreach ($creatives as $item)
                                <tr class="h-auto md:h-12 row-wrapper mt-3 py-2 md:py-0">
                                    <td class="basis-1/12 md:basis-2/12">{{ $loop->iteration }}</td>
                                    <td class="basis-4/12 md:basis-3/12 text-uppercase">{{ $item->creative_name }}</td>
                                    <td class="basis-2/12 hidden md:block">
                                        {{ $item->creative_type ? $item->creative_type->name : '' }}</td>
                                    <td class="basis-2/12 text-center">
                                        <button
                                            class="bg-indigo-500 h-8 flex justify-center items-center py-2 px-5 rounded-2xl">
                                            <a href="{{ route('carousel.show', $item->id) }}" target="_blank">
                                                View
                                            </a>
                                        </button>
                                    </td>
                                    <td class="basis-2/12 hidden md:block">
                                        <button
                                            class="bg-blue-500 h-8 flex justify-center items-center py-2 px-5 rounded-2xl">{{ $item->created_at->format('Y-m-d') }}</button>
                                    </td>
                                    {{-- <td class="basis-4/12 flex flex-col md:flex-row text-sm">
                                        <button style="display: flex; justify-content: center; align-items: center" class="bg-black h-8 py-2 px-5 rounded-2xl">
                                            <a href="{{ route('carousel.show', $item->id) }}" target="_blank">
                                                View
                                            </a>
                                        </button>
                                        <button
                                            class="bg-indigo-500 h-8 flex justify-center items-center py-2 px-5 rounded-2xl">Tag</button>
                                        <button
                                            class="bg-blue-500 h-8 flex justify-center items-center py-2 px-5 rounded-2xl">Edit</button>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $creatives->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="dashboard">

            </div>
        @endif

        
    </x-app-layout>
@endsection
