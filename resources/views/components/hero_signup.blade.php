<form action="/signup" method="post" class="form hero-form-color" id="signup">
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
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="control-group">
        <button 
            type="submit" 
            class="form-control"
            >
            Sign Up
        </button>
    </div>
</form>
