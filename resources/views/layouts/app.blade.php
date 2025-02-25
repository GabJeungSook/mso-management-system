<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <!-- Scripts -->
        @filamentStyles
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
<div x-cloak x-data="{ open: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
      <!--
        Off-canvas menu backdrop, show/hide based on off-canvas menu state.

        Entering: "transition-opacity ease-linear duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "transition-opacity ease-linear duration-300"
          From: "opacity-100"
          To: "opacity-0"
      -->
      <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

      <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-0 flex">
        <!--
          Off-canvas menu, show/hide based on off-canvas menu state.

          Entering: "transition ease-in-out duration-300 transform"
            From: "-translate-x-full"
            To: "translate-x-0"
          Leaving: "transition ease-in-out duration-300 transform"
            From: "translate-x-0"
            To: "-translate-x-full"
        -->
        <div class="relative mr-16 flex w-full max-w-xs flex-1">
          <!--
            Close button, show/hide based on off-canvas menu state.

            Entering: "ease-in-out duration-300"
              From: "opacity-0"
              To: "opacity-100"
            Leaving: "ease-in-out duration-300"
              From: "opacity-100"
              To: "opacity-0"
          -->
          <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
            <button @click="open = false" type="button" class="-m-2.5 p-2.5">
                <span class="sr-only">Close sidebar</span>
                <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
              </button>
          </div>

          <!-- Sidebar component, swap this element with another sidebar if you like -->
          <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-yellow-600 px-6">
            <div class="flex h-16 shrink-0 items-center">
                <span class="text-gray-50 font-semibold text-2xl mt-4">MSO MANAGEMENT SYSTEM</span>
            </div>
            <nav class="flex flex-1 flex-col">
              @if(auth()->user()->role == 'admin')
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                  <ul role="list" class="-mx-2 space-y-1">
                    {{-- <li>
                      <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Home
                      </a>
                    </li> --}}
                    <li>
                        <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            <li>
                                <a wire:navigate href="{{ route('admin.positions') }}" class="{{ request()->routeIs('admin.positions') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                                  </svg>
                                    Positions
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  </svg>
                                    Members
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.officers') }}" class="{{ request()->routeIs('admin.officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                  </svg>
                                    Officers
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                  </svg>
                                    Events, Activities and Meetings
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                  </svg>
                                    Fees
                                </a>
                            </li>
                            {{-- <li>
                                <a wire:navigate href="{{ route('admin.expenses') }}" class="{{ request()->routeIs('admin.expenses') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                    <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Expenses
                                </a>
                            </li> --}}
                            <li>
                                <a wire:navigate href="{{ route('admin.announcements') }}" class="{{ request()->routeIs('admin.announcements') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                  </svg>
                                    Announcements
                                </a>
                            </li>
                            <li>
                              <a wire:navigate href="{{ route('admin.scan-qr') }}" class="{{ request()->routeIs('admin.scan-qr') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                <svg  class="size-6 shrink-0 text-gray-50 group-hover:text-white"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                </svg>
                                  Scan QR Code
                              </a>
                          </li>
                          <li>
                            <a wire:navigate href="{{ route('officer.attendance') }}" class="{{ request()->routeIs('officer.attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                              </svg>
                                Attendance
                            </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('admin.penalties') }}" class="{{ request()->routeIs('admin.penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                              Penalties
                          </a>
                        </li>
                        </ul>
                      </li>
                  </ul>
                </li>
                <li>
                  <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
                  <ul role="list" class="-mx-2 mt-2 space-y-1">
                    <li>
                      <a wire:navigate href="{{ route('admin.report-penalties') }}" class="{{ request()->routeIs('admin.report-penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">P</span>
                        <span class="truncate">Penalty Report</span>
                      </a>
                    </li>
                    <li>
                      <a wire:navigate href="{{ route('admin.report-members') }}" class="{{ request()->routeIs('admin.report-members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">M</span>
                        <span class="truncate">Member Report</span>
                      </a>
                    </li>
                    <li>
                      <a wire:navigate href="{{ route('admin.report-officers') }}" class="{{ request()->routeIs('admin.report-officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">O</span>
                        <span class="truncate">Officer Report</span>
                      </a>
                    </li>
                    <li>
                      <a wire:navigate href="{{ route('admin.report-attendance') }}" class="{{ request()->routeIs('admin.report-attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">A</span>
                        <span class="truncate">Attendance Report</span>
                      </a>
                    </li>
                    {{-- <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">H</span>
                        <span class="truncate">Heroicons</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                        <span class="truncate">Tailwind Labs</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                        <span class="truncate">Workcation</span>
                      </a>
                    </li> --}}
                  </ul>
                </li>
                <li class="-mx-6 mt-auto">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                  <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                      </svg>
                    <span aria-hidden="true">Logout</span>
                    </button>
                </form>
                </li>
              </ul>
              @elseif(auth()->user()->role == 'officer')
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                  <ul role="list" class="-mx-2 space-y-1">
                    {{-- <li>
                      <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Home
                      </a>
                    </li> --}}
                    <li>
                        <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            <li>
                                <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  </svg>
                                    Members
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                  </svg>
                                    Events, Activities and Meetings
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                  </svg>
                                    Fees
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.announcements') }}" class="{{ request()->routeIs('admin.announcements') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                  </svg>
                                    Announcements
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('officer.attendance') }}" class="{{ request()->routeIs('officer.attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                  </svg>
                                    Attendance
                                </a>
                            </li>
                        </ul>
                      </li>
                  </ul>
                </li>
                <li>
                  <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
                  <ul role="list" class="-mx-2 mt-2 space-y-1">
                    {{-- <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">H</span>
                        <span class="truncate">Heroicons</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                        <span class="truncate">Tailwind Labs</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                        <span class="truncate">Workcation</span>
                      </a>
                    </li> --}}
                  </ul>
                </li>
                <li class="-mx-6 mt-auto">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                  <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                      </svg>
                    <span aria-hidden="true">Logout</span>
                    </button>
                </form>
                </li>
              </ul>
              @elseif(auth()->user()->role == 'member')
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                  <ul role="list" class="-mx-2 space-y-1">
                    {{-- <li>
                      <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                        <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Home
                      </a>
                    </li> --}}
                    <li>
                        <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            {{-- <li>
                                <a wire:navigate href="{{ route('admin.positions') }}" class="{{ request()->routeIs('admin.positions') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                                  </svg>
                                    Positions
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  </svg>
                                    Members
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.officers') }}" class="{{ request()->routeIs('admin.officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                  </svg>
                                    Officers
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                  </svg>
                                    Events, Activities and Meetings
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                  </svg>
                                    Fees
                                </a>
                            </li> --}}
                            <li>
                                <a wire:navigate href="{{ route('member.events') }}" class="{{ request()->routeIs('member.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                  </svg>
                                    Events, Activities and Meetings
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('member.anouncement') }}" class="{{ request()->routeIs('member.anouncement') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                  <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                                  </svg>
                                    Announcements
                                </a>
                            </li>
                            <li>
                              <a wire:navigate href="{{ route('member.penalties') }}" class="{{ request()->routeIs('member.penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                                <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                                  My Penalties
                              </a>
                            </li>
                        </ul>
                      </li>
                  </ul>
                </li>
                <li>
                  <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
                  <ul role="list" class="-mx-2 mt-2 space-y-1">
                    {{-- <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">H</span>
                        <span class="truncate">Heroicons</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                        <span class="truncate">Tailwind Labs</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                        <span class="truncate">Workcation</span>
                      </a>
                    </li> --}}
                  </ul>
                </li>
                <li class="-mx-6 mt-auto">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                  <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                      </svg>
                    <span aria-hidden="true">Logout</span>
                    </button>
                </form>
                </li>
              </ul>
              @endif
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-yellow-600 px-6">
        <div class="flex h-16 shrink-0 items-center">
            <span class="text-gray-50 font-semibold text-2xl mt-4">MSO MANAGEMENT SYSTEM</span>
        </div>
        <nav class="flex flex-1 flex-col">
          @if(auth()->user()->role == 'admin')
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                {{-- <li>
                  <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                  </a>
                </li> --}}
                <li>
                    <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                            <a wire:navigate href="{{ route('admin.positions') }}" class="{{ request()->routeIs('admin.positions') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                              </svg>
                                Positions
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                                Members
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.officers') }}" class="{{ request()->routeIs('admin.officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                              </svg>
                                Officers
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                              </svg>
                                Events, Activities and Meetings
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.pre-registered-members') }}" class="{{ request()->routeIs('admin.pre-registered-members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                              </svg>

                                Pre-Registration
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                              </svg>
                                Fees
                            </a>
                        </li>
                        {{-- <li>
                            <a wire:navigate href="{{ route('admin.expenses') }}" class="{{ request()->routeIs('admin.expenses') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                                Expenses
                            </a>
                        </li> --}}
                        <li>
                            <a wire:navigate href="{{ route('admin.announcements') }}" class="{{ request()->routeIs('admin.announcements') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                              </svg>
                                Announcements
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.scan-qr') }}" class="{{ request()->routeIs('admin.scan-qr') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg  class="size-6 shrink-0 text-gray-50 group-hover:text-white"xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                              </svg>
                                Scan QR Code
                            </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('officer.attendance') }}" class="{{ request()->routeIs('officer.attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg>
                              Attendance
                          </a>
                      </li>
                      <li>
                        <a wire:navigate href="{{ route('admin.penalties') }}" class="{{ request()->routeIs('admin.penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                          <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                          </svg>
                            Penalties
                        </a>
                      </li>
                    </ul>
                  </li>
              </ul>
            </li>
            <li>
              <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
              <ul role="list" class="-mx-2 mt-2 space-y-1">
                <li>
                  <a wire:navigate href="{{ route('admin.report-penalties') }}" class="{{ request()->routeIs('admin.report-penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">P</span>
                    <span class="truncate">Penalty Report</span>
                  </a>
                </li>
                <li>
                  <a wire:navigate href="{{ route('admin.report-members') }}" class="{{ request()->routeIs('admin.report-members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">M</span>
                    <span class="truncate">Member Report</span>
                  </a>
                </li>
                <li>
                  <a wire:navigate href="{{ route('admin.report-officers') }}" class="{{ request()->routeIs('admin.report-officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">O</span>
                    <span class="truncate">Officer Report</span>
                  </a>
                </li>
                <li>
                  <a wire:navigate href="{{ route('admin.report-attendance') }}" class="{{ request()->routeIs('admin.report-attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-yellow-400 bg-yellow-500 text-[0.625rem] font-medium text-white">A</span>
                    <span class="truncate">Attendance Report</span>
                  </a>
                </li>
                {{-- <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                    <span class="truncate">Tailwind Labs</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                    <span class="truncate">Workcation</span>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="-mx-6 mt-auto">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
              <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                  </svg>
                <span aria-hidden="true">Logout</span>
                </button>
            </form>
            </li>
          </ul>
          @elseif(auth()->user()->role == 'officer')
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                {{-- <li>
                  <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                  </a>
                </li> --}}
                <li>
                    <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                        <li>
                            <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                                Members
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                              </svg>
                                Events, Activities and Meetings
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                              </svg>
                                Fees
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.announcements') }}" class="{{ request()->routeIs('admin.announcements') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                              </svg>
                                Announcements
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('officer.attendance') }}" class="{{ request()->routeIs('officer.attendance') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                              </svg>
                                Attendance
                            </a>
                        </li>
                    </ul>
                  </li>
              </ul>
            </li>
            <li>
              <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
              <ul role="list" class="-mx-2 mt-2 space-y-1">
                {{-- <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">H</span>
                    <span class="truncate">Heroicons</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                    <span class="truncate">Tailwind Labs</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                    <span class="truncate">Workcation</span>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="-mx-6 mt-auto">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
              <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                  </svg>
                <span aria-hidden="true">Logout</span>
                </button>
            </form>
            </li>
          </ul>
          @elseif(auth()->user()->role == 'member')
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                {{-- <li>
                  <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                    <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                  </a>
                </li> --}}
                <li>
                    <div class="mt-5 text-xs/8 font-semibold text-gray-50">Management</div>
                    <ul role="list" class="-mx-2 mt-2 space-y-1">
                        {{-- <li>
                            <a wire:navigate href="{{ route('admin.positions') }}" class="{{ request()->routeIs('admin.positions') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                              </svg>
                                Positions
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.members') }}" class="{{ request()->routeIs('admin.members') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                                Members
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.officers') }}" class="{{ request()->routeIs('admin.officers') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                              </svg>
                                Officers
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.events') }}" class="{{ request()->routeIs('admin.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                              </svg>
                                Events, Activities and Meetings
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('admin.fees') }}" class="{{ request()->routeIs('admin.fees') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                              </svg>
                                Fees
                            </a>
                        </li> --}}
                        <li>
                            <a wire:navigate href="{{ route('member.events') }}" class="{{ request()->routeIs('member.events') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                              </svg>
                                Events, Activities and Meetings
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('member.anouncement') }}" class="{{ request()->routeIs('member.anouncement') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                              <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                              </svg>
                                Announcements
                            </a>
                        </li>
                        <li>
                          <a wire:navigate href="{{ route('member.penalties') }}" class="{{ request()->routeIs('member.penalties') ? 'group flex gap-x-3 rounded-md bg-yellow-700 p-2 text-sm/6 font-semibold text-white' : 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-50 hover:bg-yellow-700 hover:text-white' }}">
                            <svg class="size-6 shrink-0 text-gray-50 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                              My Penalties
                          </a>
                        </li>
                    </ul>
                  </li>
              </ul>
            </li>
            <li>
              <div class="text-xs/6 font-semibold text-gray-50">Reports</div>
              <ul role="list" class="-mx-2 mt-2 space-y-1">
                {{-- <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">H</span>
                    <span class="truncate">Heroicons</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">T</span>
                    <span class="truncate">Tailwind Labs</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <span class="flex size-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">W</span>
                    <span class="truncate">Workcation</span>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="-mx-6 mt-auto">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
              <button class="w-full flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                  </svg>
                <span aria-hidden="true">Logout</span>
                </button>
            </form>
            </li>
          </ul>
          @endif
        </nav>
      </div>
    </div>

    <div @click="open = true" class="sticky top-0 z-40 flex items-center gap-x-6 bg-yellow-600 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
        <button type="button" class="-m-2.5 p-2.5 text-green-200 lg:hidden">
          <span class="sr-only">Open sidebar</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
        <div class="flex-1 text-sm/6 font-semibold text-white">MSO MANAGEMENT SYSTEM</div>
        <a href="#">
          <span class="sr-only">Your profile</span>
          {{-- <img class="size-8 rounded-full bg-green-700" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""> --}}
        </a>
      </div>

    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>

        @livewire('notifications')
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
