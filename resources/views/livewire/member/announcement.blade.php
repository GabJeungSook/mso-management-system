<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Announcements
    </div>
    <span class="italic">Select one to view the details.</span>
    <div class="mt-10">
        <ul role="list" class="space-y-3">
            @forelse ($announcements as $item)
            <li class="overflow-hidden bg-white px-4 py-4 shadow-lg sm:rounded-md sm:px-6 hover:bg-gray-300 rounded-md">
                <a href="{{ route('member.announcement-details', ['record' => $item->id]) }}">
                    <span class="font-semibold text-lg text-green-600">{{$item->event->name }}</span>
                    <p class="font-normal text-lg">{{ $item->event->type }}</p>
                    <p class="font-normal text-lg">{!! str($item->content)->sanitizeHtml() !!}</p>
                    <p class="font-normal text-lg italic">{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</p>
                </a>
            </li>
            @empty
                <li class="overflow-hidden bg-white px-4 py-4 shadow sm:rounded-md sm:px-6">
                    <span>No announcement available</span>
                </li>
            @endforelse
            <!-- More items... -->
          </ul>

    </div>
