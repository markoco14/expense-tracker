<x-header />
<section class="section-full half-half">
        <div class="container">
            <form action="/signup" method="post" class="form">
                @csrf
            <div class="form-title">
                <h1>Sign Up</h1>
            </div>
            <div class="form-group">
                <label 
                    for="name"
                >
                    Name
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label 
                    for="username" 
                    >
                    Username
                </label>
                <input 
                    type="text" 
                    id="username" 
                    name="username"
                    value="{{ old('username') }}"
                >
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
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
                    value="{{ old('email') }}"
                >
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
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
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit">
                    START SAVING
                </button>
            </div>
            <p>Already a member? <a href="login" class="form-link">LOG IN</a></p>
        </form>
    </div>
    </section>
<x-footer />
