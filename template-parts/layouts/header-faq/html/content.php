<?php $title = $args['title'] ?? __('FAQ', 'SECRET-domain'); ?>

<div class="header-faq">
  <div class="container flex flex-col items-center gap-[--faq-header-gap,theme(spacing.6)]">
    <h1 class="font-h1 text-center text-gray">
      <?php echo esc_html($title); ?>
    </h1>

    <label class="relative w-full max-w-2xl py-2 px-4 border rounded-full border-gray-800 flex items-center col-span-full gap-2 md:py-3 md:px-6 md:gap-4 lg:col-start-2 lg:col-end-[-2]">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
      </svg>

      <input id="search" class="border-none focus:[box-shadow:none] w-full p-0 placeholder-gray-600 text-gray font-b1 [&:focus+svg]:opacity-100 [&::-webkit-search-cancel-button]:appearance-none" type="search" placeholder="<?php _e(
                                                                                                                                                                                                                                'Search',
                                                                                                                                                                                                                                'SECRET-domain'
                                                                                                                                                                                                                              ); ?>" data-id="search">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="size-6 opacity-0 transition hover:opacity-100 focus:opacity-100 cursor-pointer" onclick="search.value = ''">

        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.53033 5.05561C6.23744 4.76271 5.76256 4.76271 5.46967 5.05561C5.17678 5.3485 5.17678 5.82337 5.46967 6.11627L10.9393 11.5859L5.46967 17.0556C5.17678 17.3485 5.17678 17.8234 5.46967 18.1163C5.76256 18.4092 6.23744 18.4092 6.53033 18.1163L12 12.6466L17.4697 18.1163C17.7626 18.4092 18.2374 18.4092 18.5303 18.1163C18.8232 17.8234 18.8232 17.3485 18.5303 17.0556L13.0607 11.5859L18.5303 6.11627C18.8232 5.82337 18.8232 5.3485 18.5303 5.05561C18.2374 4.76271 17.7626 4.76271 17.4697 5.05561L12 10.5253L6.53033 5.05561Z" fill="#0A101E" />
      </svg>

      <span class="absolute hidden w-full left-0 top-full py-1 overflow-hidden translate-y-2 border bg-white border-gray-800 rounded-xs z-10" data-id="search-queries-container">
        <span class="flex flex-col overflow-hidden w-full overflow-y-auto max-h-[200px] *:font-b1 *:text-gray *:py-3 *:px-4 *:transition hover:*:bg-gray-100 hover:*:rounded-xs hover:*:text-blue-600" data-id="search-queries-list" role="list"></span>
      </span>
    </label>
  </div>
</div>