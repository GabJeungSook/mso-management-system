<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Events, Activities, and Meetings
    </div>
    <span class="italic">Click an event to pre-register</span>
    <div class="mt-10">
        <ul role="list" class="space-y-3">
            @forelse ($events as $item)
            <li class="overflow-hidden bg-white px-4 py-4 shadow-lg sm:rounded-md sm:px-6 hover:bg-gray-300 rounded-md">
                <a href="{{ route('member.event-preregistration', ['record' => $item->id]) }}">
                    <span class="font-semibold text-lg text-green-600">{{$item->name }}</span>
                    <p class="font-normal text-lg">{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</p>
                    <p class="font-normal text-lg italic">{{ $item->type }}</p>
                    @if ($item->registrations()->where('user_id', Auth::user()->id)->exists())
                    <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 mt-2 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Pre-Registered</span>
                    @endif
                </a>
            </li>
            @empty
                <li class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <span>No events available</span>
                </li>
            @endforelse
            <!-- More items... -->
          </ul>

    </div>
