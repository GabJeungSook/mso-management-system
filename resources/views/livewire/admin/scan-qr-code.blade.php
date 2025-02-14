<div>
    <div class="mt-10 text-4xl font-bold mb-4">
        Scan QR Code
    </div>
    @if ($event)
    <div class="p-4 mt-5">
        <div class="flex justify-center mt-5">
            <input wire:model="scannedCode" autocomplete="off" wire:change="saveAttendance" type="text" id="qrInput"
                   class="text-center p-4 text-2xl focus:outline-none w-full mx-14 rounded-md" autofocus>
        </div>
        <small class="flex justify-center mt-3 font-medium">*Scan QR Code Here*</small>
    </div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Event Details
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Event Name</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$event->name}}</dd>
              </div>
              <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Event Type</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$event->type}}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                <dt class="text-sm/6 font-medium text-gray-900">Date</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</dd>
              </div>
            </dl>
          </div>
    </div>
    @else
    <div class="flex justify-center mt-5">
        <div class="p-4 text-center bg-gray-100 text-white rounded-md">
            <span class="text-xl text-gray-600 italic">No active event found</span>
        </div>
    </div>
    @endif
</div>

<script>
    // Function to ensure the scanning input is always focused
    const qrInput = document.getElementById('qrInput');

    function ensureFocus() {
        if (qrInput && document.activeElement !== qrInput) {
            qrInput.focus();
        }
    }

    if (qrInput) {
        // Continuously check focus
        setInterval(ensureFocus, 100);

        // Prevent default behavior of clicking away
        // document.addEventListener('click', (e) => {
        //     if (e.target.id !== 'qrInput' && e.target.tagName !== 'BUTTON') {
        //         e.preventDefault();
        //         qrInput.focus();
        //     }
        // });
    }
</script>
