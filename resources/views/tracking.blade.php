<x-header />
    <section class="section-full">
        <x-navbar />
        <div class="form-container">

            <form action="tracking" method="post" class="form">
                <h1 class="form-title">Track Expenses</h1>
                @if (session()->has('success'))
                    <p
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                    >
                        {{ session('success') }}
                    </p>
                @endif
                @csrf
                <div class="form-group">
                    <label for="amount">
                        How much did you spend?
                    </label>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount"
                        value={{old('amount')}}
                        >
                    @error('amount')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="what">
                        What did you buy?
                    </label>
                    <input 
                        type="text" 
                        id="what" 
                        name="what"
                        value={{old('what')}}
                        >
                    @error('what')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="where">
                        Where did you buy it?
                    </label>
                    <input 
                        type="text" 
                        id="where" 
                        name="where"
                        value={{old('where')}}
                        >
                    @error('where')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button 
                        type="submit" 
                        name="submit" 
                        >
                        Enter Expenses
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
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
    </script>
<x-footer />