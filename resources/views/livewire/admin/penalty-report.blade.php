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
        <div class="text-center text-xl font-bold mb-6">Paid Penalties</div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Event Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Event Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Full Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Amount</th>
                    {{-- <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Payment Method</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Amount</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Date Created</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse($penalties as $item)
                    <tr class="">
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->event->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->event->type }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $item->member->fullName }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">₱ {{ number_format($item->amount, 2) }}</td>
                        {{-- <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}</td> --}}
                    </tr>
                @empty
                <tr class="">
                    <td class="py-2 px-4 border-b border-gray-200">No Record Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="flex justify-end">
            <span class="underline mr-5 py-5 font-semibold text-3xl">Total: ₱ {{number_format($total, 2)}}</span>
        </div>
    </div>
</div>
