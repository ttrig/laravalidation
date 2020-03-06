<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <i class="fa fa-tasks"></i>
        {{ config('app.name') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="exampleDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-lightbulb"></i> Examples
            </a>
            <div class="dropdown-menu" aria-labelledby="exampleDropdown">
              <a class="dropdown-item" href="/example/required">Required</a>
              <a class="dropdown-item" href="/example/exclude">Exclude</a>
              <a class="dropdown-item" href="/example/nullable">Nullable</a>
              <a class="dropdown-item" href="/example/filled">Filled</a>
              <a class="dropdown-item" href="/example/present">Present</a>
              <a class="dropdown-item" href="/example/sometimes">Sometimes</a>
              <a class="dropdown-item" href="/example/regex">Regex</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://laravel.com/docs/validation">
              <i class="fa fa-file"></i> Laravel documentation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://github.com/illuminate/validation">
              <i class="fa fa-code-branch"></i> illuminate/validation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://github.com/ttrig/laravalidation">
              <i class="fab fa-github"></i> GitHub
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
