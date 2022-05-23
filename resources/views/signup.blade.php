<x-header />
    <section class="hero">
        <x-navbar />
        <div class="col-sm-6 offset-sm-3 mt-5 mb-5 pb-4 pt-4 pr-1 pl-1 container">
            {{-- <h1>Sign Up</h1> --}}
            <form action="/signup" method="post" class="landing-form pt-5">
                @csrf
                <div class="control-group">
                    <label 
                        for="name"
                        class="form-label">
                        Name
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="username" 
                        class="form-label"
                        >
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username"
                        class="form-control"
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="email" 
                        class="form-label"
                        >
                        Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group mb-3">
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
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <button 
                        type="submit" 
                        class="form-control landing-button"
                        >
                        SIGN UP
                    </button>
                </div>
                <p>Already a member? <a href="login">login</a></p>
            </form>
        </div>
    </section class="hero">
<x-footer />
