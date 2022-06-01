<x-header />
<x-mobile-nav-top/>

    <section class="section-full half-half">
        {{-- <x-navbar /> --}}
        <div class="form-container">
            @if (session()->has('success'))
                <p
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                >
                    {{ session('success') }}
                </p>
            @endif
            <form action="sessions" method="post" class="form">
                @csrf
                <div class="form-title">
                    <h1>Log In</h1>
                </div>
                <div class="form-group">
                    <label 
                        for="email" 
                        >
                        Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        {{-- value={{old('email')}} --}}
                        >
                </div>
                @error('email')
                    <p class="error">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label 
                        for="password" 
                        >
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        >
                </div>
                @error('password')
                    <p class="error">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <button 
                        type="submit" 
                        name="submit" 
                        >
                        LOG IN
                    </button>
                </div>
                <p>Not a member? <a href="signup" class="form-link">SIGN UP</a></p>

            </form>
        </div>
    </section>
<x-footer />