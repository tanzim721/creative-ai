@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative - User Edit')
@section('meta-description', 'Toucan Creative - User Edit') 

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 1)
            <div class="dashboard bg-gray-50 min-h-screen py-8">
                <div class="max-w-4xl mx-auto">
                    <!-- Header with shadow and improved spacing -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 flex justify-between items-center">
                            <h1 class="text-xl font-bold text-white">{{ __('Update user') }}</h1>
                            <a href="{{ route('subusers.index') }}" class="bg-white text-indigo-700 hover:bg-indigo-50 transition duration-200 px-4 py-2 rounded-lg shadow text-sm font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                {{ __('Back to List') }}
                            </a>
                        </div>

                        <div class="p-6">
                            <form method="POST" action="{{ route('subusers.update', $subuser->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Form with improved spacing and styling -->
                                <div class="space-y-6">
                                    <!-- Name Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="name" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Name') }} <span class="text-red-500">*</span>
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="name" type="text"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm @error('name') border-red-500 @enderror"
                                                name="name" value="{{ old('name', $subuser->name) }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="email" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Email Address') }} <span class="text-red-500">*</span>
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="email" type="email"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm @error('email') border-red-500 @enderror"
                                                name="email" value="{{ old('email', $subuser->email) }}" required autocomplete="email">
                                            @error('email')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Mobile Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="mobile" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Mobile Number') }}
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="mobile" type="text"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm @error('mobile') border-red-500 @enderror"
                                                name="mobile" value="{{ old('mobile', $subuser->mobile) }}" autocomplete="mobile">
                                            @error('mobile')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Position Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="position" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Position') }}
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="position" type="text"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm @error('position') border-red-500 @enderror"
                                                name="position" value="{{ old('position', $subuser->position) }}" autocomplete="position">
                                            @error('position')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="password" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Password') }}
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="password" type="password"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm @error('password') border-red-500 @enderror"
                                                name="password" autocomplete="new-password">
                                            <p class="text-gray-500 text-sm mt-1">Leave blank if you don't want to change the password</p>
                                            @error('password')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password Field -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                        <label for="password-confirm" class="text-gray-700 font-medium md:text-right">
                                            {{ __('Confirm Password') }}
                                        </label>
                                        <div class="md:col-span-2">
                                            <input id="password-confirm" type="password"
                                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center pt-4">
                                        <div class="md:col-span-2 md:col-start-2">
                                            <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center justify-center">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" />
                                                {{ __('Update user') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="dashboard">
                <!-- Content for non-admin users -->
                <div class="flex items-center justify-center min-h-screen bg-gray-50">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h2 class="text-xl font-bold text-gray-800 mt-4">Access Denied</h2>
                            <p class="text-gray-600 mt-2">You don't have permission to view this page.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
@endsection