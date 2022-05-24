<x-header />
    <section class="section-full half-half">
        <x-navbar />
        <div class="container">
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
                    <h2>Log In</h2>
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
                    <p>{{$message}}</p>
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
                    <p>{{$message}}</p>
                @enderror
                <div class="form-group">
                    <button 
                        type="submit" 
                        name="submit" 
                        >
                        LOG IN
                    </button>
                </div>
                <p>Not a member? <a href="signup">SIGN UP</a></p>

            </form>
        </div>
    </section>
<x-footer />