<x-header />
    <div>
        <div class="col-sm-6 offset-sm-3">
            <h1>Record your expenses</h1>
            @if (session()->has('success'))
                <p
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                >
                    {{ session('success') }}
                </p>
            @endif
            <form action="" method="post" class="form">
                @csrf
                <div class="control-group">
                <label 
                        for="monthlySalary"
                        class="form-label">
                        Monthly Salary
                    </label>
                    <input 
                        type="number" 
                        id="monthlySalary" 
                        name="monthlySalary"
                        class="form-control"
                        value={{old('monthlySalary')}}
                        >
                    @error('monthlySalary')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="labourInsurance" 
                        class="form-label"
                        >
                        Labour Insurance
                    </label>
                    <input 
                        type="text" 
                        id="labourInsurance" 
                        name="labourInsurance"
                        class="form-control"
                        value={{old('labourInsurance')}}
                        >
                    @error('labourInsurance')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="control-group">
                    <label 
                        for="rent" 
                        class="form-label"
                        >
                        National Health Insurance
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
                        for="savings" 
                        class="form-label"
                        >
                        Rent
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
                    <label 
                        for="dailyBudget" 
                        class="form-label"
                        >
                        Utilities
                    </label>
                    <input 
                        type="text" 
                        id="dailyBudget" 
                        name="dailyBudget"
                        class="form-control"
                        value={{old('dailyBudget')}}
                        >
                    @error('dailyBudget')
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
                        Enter Expenses
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