{{-- navbar --}}
<header>
  <div class="header-left">
      <div class="logo">
          </h1>Game<span>GO</span></h1>
      </div>
      <nav>
          <ul>
              <li>
                  <a b href="{{ url('/') }}">Home</a>
              </li>
              <li>
                  <a href="/allproduk">Products</a>
              </li>
              <li>
                  <a href="{{ url('/dashboard') }}">Dashboard</a>
              </li>
          </ul>
          @if(Auth::user())
            <div class="logout">
                  <a href="{{ url('/logout') }}" style="background-color: red">Logout</a>
            </div>
          @else
          <div class="login-signup">
              <a href="{{ url('/login') }}">Login</a> or <a href="{{ url('/register') }}">Register</a>
          </div>
          @endif

      </nav>
  </div>


  <div class="header-right">
        @if(Auth::user())
        <div class="sapa mx-3 mt-3">
            <p style="color : white; font-size:12px">Halo, {{ Auth::user()->nama }}</p>
        </div>
        <div class="logout">
            <a href="{{ url('/logout') }}" style="background-color: red">Logout</a>
        </div>
        @else
        <div class="login-signup">
            <a href="{{ url('/login') }}">Login</a> or <a href="{{ url('/register') }}">Register</a>
        </div>
        @endif

      <div class="hamburger">
          <div></div>
          <div></div>
          <div></div>
      </div>
  </div>
</header>
<script>
  hamburger = document.querySelector(".hamburger");
  nav = document.querySelector("nav");
  hamburger.onclick = function() {
      nav.classList.toggle("active");
  }
</script>
