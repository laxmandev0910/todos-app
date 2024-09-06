<div x-cloak x-show="message" role="message" data-dismissible="alert"
  class="relative flex w-full max-w-lg px-4 py-3 text-base rounded-md mx-auto"
  :class="errorType ? 'bg-vns-error text-white':'bg-green-400 text-white'" x-ref="msgBox">
  <div class="shrink-0">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
      class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z">
      </path>
    </svg>
  </div>
  <div class="ml-3 mr-12">
    <h5 class="block font-vns-lead text-xl font-medium"></h5>
    <p class="block mt-2 font-vns-body font-light" x-text="message">
    </p>
  </div>
</div>