<x-header />
        <x-navbar />
        <div>
            <div class="col-sm-6 offset-sm-3">
                <h1>Log In</h1>
                @if (session()->has('success'))
                    <p
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                    >
                    {{ session('success') }}</p>
                @endif
                <form action="sessions" method="post" class="form">
                    @csrf
                    <div class="control-group">
                        <label 
                            for="email" 
                            class="form-label"
                            >
                            Username
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="form-control"
                            {{-- value={{old('email')}} --}}
                            >
                    </div>
                    @error('email')
                        <p>{{$message}}</p>
                    @enderror
                    <div class="control-group">
                        <label 
                            for="password" 
                            class="form-label"
                            >
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="form-control"
                            >
                    </div>
                    <div class="control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
