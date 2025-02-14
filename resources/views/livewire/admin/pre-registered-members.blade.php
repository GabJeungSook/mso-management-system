<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Pre-Registered Members
    </div>
    @if ($event)
    <div class="p-4 mt-5">
        {{ $this->table }}
    </div>
    @else
    <div class="flex justify-center mt-5">
        <div class="p-4 text-center bg-gray-100 text-white rounded-md">
            <span class="text-xl text-gray-600 italic">No active event found</span>
        </div>
    </div>
    @endif

</div>
