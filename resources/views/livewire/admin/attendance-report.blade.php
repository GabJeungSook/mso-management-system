<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

    <div class="flex justify-end m-10">
        <select wire:model.live="selected" class="bg-white border border-gray-300 text-gray-700 py-2 px-8 rounded">
            @foreach($events as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="container mx-auto">
        <div class="text-center text-3xl font-bold mb-6">MSO Management System</div>
        <div class="text-center text-xl font-bold mb-6">Attendance Report</div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Event Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Event Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Full Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Date Attended</th>
                    {{-- <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Payment Method</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Amount</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Date Created</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $item)
                    <tr class="">
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->registration->event->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->registration->event->type }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $item->member->fullName }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}</td>
                    </tr>
                @empty
                <tr class="">
                    <td class="py-2 px-4 border-b border-gray-200">No Record Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
