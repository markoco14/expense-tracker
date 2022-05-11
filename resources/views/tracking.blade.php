<x-header />
<x-navbar />
    <main class="app-main p-2">
        <section class="form col-sm-6 offset-sm-3 mt-2 p-3 pt-4 bg-light">
            <section class="mb-4">
                <h1>Track Expenses</h1>
            </section>
            <section class="col-sm-6 offset-sm-3">
                <form action="tracking" method="post" class="form bordered">
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
                    <div class="mb-3 control-group">
                    <label 
                            for="amount"
                            class="form-label">
                            How much did you spend?
                        </label>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount"
                            class="form-control"
                            value={{old('amount')}}
                            >
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3 control-group">
                        <label 
                            for="what" 
                            class="form-label"
                            >
                            What did you buy?
                        </label>
                        <input 
                            type="text" 
                            id="what" 
                            name="what"
                            class="form-control"
                            value={{old('what')}}
                            >
                        @error('what')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3 control-group">
                        <label 
                            for="where" 
                            class="form-label"
                            >
                            Where did you buy it?
                        </label>
                        <input 
                            type="text" 
                            id="where" 
                            name="where"
                            class="form-control"
                            value={{old('where')}}
                            >
                        @error('where')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3 control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Enter Expenses
                        </button>
                    </div>
                </form>
            </section>
        </section>
    </main>
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