@extends('layouts.subadmin')

@section('title', 'Messages')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('subadmin.send-messages') }}" method="POST">
        @csrf

        <!-- Input Message -->
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" id="message" placeholder="Enter your message here ..." rows="4" class="block w-full mt-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:ring-indigo-300 p-2 text-sm overflow-y-auto resize-none" style="height: 14rem"></textarea>
        </div>

        <!-- Send Button Here -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Send</button>
        </div>
    </form>
</div>
@endsection