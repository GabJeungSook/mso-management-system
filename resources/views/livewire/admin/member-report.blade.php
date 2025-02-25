<div>
    <div class="flex justify-end m-10">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print
        </button>
    </div>

    <div class="container mx-auto">
        <div class="text-center text-3xl font-bold mb-6">MSO Management System</div>
        <div class="text-center text-xl font-bold mb-6">Member Report</div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Full Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Gender</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Address</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Phone Number</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Birth Date</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Course</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Year</th>
                    {{-- <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Payment Method</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Amount</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left">Date Created</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse($members as $item)
                    <tr class="">
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->fullName }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 uppercase">{{ $item->gender }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->address }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->phone_number }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($item->birth_date)->format('F d, Y') }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->course->name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $item->year }}</td>
                        {{-- <td class="py-2 px-4 border-b border-gray-200">{{ Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}</td> --}}
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
