<header>
  <nav class="flex items-center justify-between flex-wrap max-w-screen-xl mx-auto w-full py-8">
    <a href="/" class="flex w-full lg:w-auto justify-center items-center shrink text-laravel">
      <i class="fa fa-fw fa-tasks fa-lg mr-2 ml-2 lg:ml-0"></i>
      <span class="font-medium text-4xl tracking-tight">{{ config('app.name') }}</span>
    </a>
    <div class="w-full grow lg:flex lg:items-center lg:w-auto ml-10">
      <div class="lg:grow text-lg text-gray-600">
        <div class="relative inline-block text-left mr-6 mt-4 lg:inline-block lg:mt-0">
          <div>
            <span
              class="inline-flex justify-center items-center w-full cursor-pointer"
              id="examples-menu"
              aria-haspopup="true"
              aria-expanded="true"
            >
              <i class="fa fa-fw fa-lightbulb"></i>&nbsp;Examples
              <i class="fa fa-fw fa-xs fa-chevron-down ml-2 mt-1"></i>
            </span>
          </div>

          <div
            id="examples-dropdown"
            class="origin-top-left absolute left-0 mt-2 z-20 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
          >
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="examples-menu">
              <a href="/example/required">Required</a>
              <a href="/example/exclude">Exclude</a>
              <a href="/example/nullable">Nullable</a>
              <a href="/example/filled">Filled</a>
              <a href="/example/present">Present</a>
              <a href="/example/sometimes">Sometimes</a>
              <a href="/example/regex">Regex</a>
            </div>
          </div>
        </div>

        <a
          class="block mr-6 mt-4 lg:inline-block lg:mt-0"
          target="_blank"
          href="https://laravel.com/docs/validation"
        >
          <i class="fa fa-fw fa-file"></i>
          Laravel documentation
        </a>
        <a
          class="block mr-6 mt-4 lg:inline-block lg:mt-0"
          target="_blank"
          href="https://github.com/illuminate/validation"
        >
          <i class="fa fa-fw fa-code-branch"></i>
          illuminate/validation
        </a>
        <a
          class="block mr-6 mt-4 lg:inline-block lg:mt-0"
          target="_blank"
          href="https://github.com/ttrig/laravalidation"
        >
          <i class="fab fa-fw fa-github"></i>
          GitHub
        </a>
      </div>
    </div>
  </nav>
</header>
