<div>
    <div class="mt-5 text-4xl font-bold mb-4">
        Announcement Details
    </div>
    <div>
        <div>
            <div class="px-4 sm:px-0">
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Event Name</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->event->name}}</dd>
                </div>
                <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Event Type</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$record->event->type}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Content</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{!! str($record->content)->sanitizeHtml() !!}</dd>
                  </div>
                <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Date</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ Carbon\Carbon::parse($record->event_date)->format('F d, Y') }}</dd>
                </div>
                {{-- <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900"></dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase"></dd>
                </div> --}}
              </dl>
            </div>
            {{-- @if($record->registrations()->where('user_id', Auth::user()->id)->exists())
            <div class="flex justify-center mt-4">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$record->registrations()->where('user_id', Auth::user()->id)->first()->qr_code}}" target="_blank" download="qr-code.png" class="mt-1 px-4 py-2 text-gray-100 rounded" alt="">
            </div>
            @endif --}}
          </div>
          <div class="mt-5 ml-1 flex flex-col gap-y-3 sm:flex-row sm:gap-x-3 text-center">
              {{-- @if($record->registrations()->where('user_id', Auth::user()->id)->exists())
              <button class="mt-1 px-4 py-2 bg-gray-800 text-gray-100 rounded" wire:click="downloadQrCode" type="button">Download QR Code</button>
              @else
              <button wire:confirm="Are you sure you want to pre-register in this event?" wire:click="preRegister" type="button" class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">Pre-register</button>
              @endif --}}
              <a href="{{route('member.anouncement')}}" class="rounded-md bg-gray-200 px-3 py-3 text-sm font-semibold text-gray-600 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Cancel</a>
          </div>
      </div>
</div>
