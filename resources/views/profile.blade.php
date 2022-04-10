<x-header />
    <x-navbar />
    <div>
        <div class="col-sm-6 offset-sm-3">
            <h1>Set Your Financial Information</h1>
            @if (session()->has('success'))
                <p
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                >
                    {{ session('success') }}
                </p>
            @endif
            <form action="profile" method="post" class="form">
                @csrf
                <div class="control-group">
                <label 
                        for="salary"
                        class="form-label">
                        What is your salary?
                    </label>
                    <input 
                        type="number" 
                        id="salary" 
                        name="salary"
                        class="form-control"
                        value={{old('salary')}}
                        >
                    @error('salary')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="li" 
                        class="form-label"
                        >
                        LI
                    </label>
                    <input 
                        type="text" 
                        id="li" 
                        name="li"
                        class="form-control"
                        value={{old('li')}}
                        >
                    @error('li')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="nhi" 
                        class="form-label"
                        >
                        NHI
                    </label>
                    <input 
                        type="text" 
                        id="nhi" 
                        name="nhi"
                        class="form-control"
                        value={{old('nhi')}}
                        >
                    @error('nhi')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="rent" 
                        class="form-label"
                        >
                        Rent
                    </label>
                    <input 
                        type="text" 
                        id="rent" 
                        name="rent"
                        class="form-control"
                        value={{old('rent')}}
                        >
                    @error('rent')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="utilities" 
                        class="form-label"
                        >
                        Utilities
                    </label>
                    <input 
                        type="text" 
                        id="utilities" 
                        name="utilities"
                        class="form-control"
                        value={{old('utilities')}}
                        >
                    @error('utilities')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="savings" 
                        class="form-label"
                        >
                        Savings
                    </label>
                    <input 
                        type="text" 
                        id="savings" 
                        name="savings"
                        class="form-control"
                        value={{old('savings')}}
                        >
                    @error('savings')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <button 
                        type="submit" 
                        name="submit" 
                        class="form-control"
                        >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <script>
        let amount = document.getElementById('amount');
        let what = document.getElementById('what');
        let where = document.getElementById('where');

        amount.focus();
        amount.addEventListener('keypress', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                what.focus();
            }
        });

        what.addEventListener('keypress', function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                where.focus();
            }
        })
    </script> --}}
<x-footer />