<x-header />
    <x-navbar />
    <main class="app-main p-2 pb-5">
        <section class="form col-sm-6 offset-sm-3 mt-2 p-3 pt-4 bg-light">
            <section class="mb-4">
                <h1 class="mb-4">Your Finances</h1>
                <div class="btn-group">
                    <a href="#income" class="btn btn-outline-success">Income</a>
                    <a href="#deductions" class="btn btn-outline-success">Deductions</a>
                    <a href="#savings" class="btn btn-outline-success">Savings</a>
                    <a href="#budget" class="btn btn-outline-success">Budget</a>
                </div>
            </section>
            <section class="col-sm-6 offset-sm-3">
    
                @if (session()->has('success'))
                    <p
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                    >
                        {{ session('success') }}
                    </p>
                @endif
                {{-- salary section --}}
                <form action="profile/salaries" method="post" class="form bordered">
                    <h2 id="income">Income</h2>
                    {{-- <p>
                        Set your salary information here. 
                        You may update your salary anytime as you receive pay increases. 
                        But we recommend only changing your salary at the beginning of every month.
                    </p> --}}
                    @csrf
                <div class="control-group">
                        <label for="salary" class="form-label">
                            Salary
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
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Submit Salary
                        </button>
                    </div>
                </form>
            </section>
            <section class="col-sm-6 offset-sm-3">
                {{-- deductions section --}}
                <form 
                    action="profile/deductions" 
                    method="post" 
                    class="form border" 
                    id="deduction-form"
                    >
                <h2 id="deductions">Deductions</h2>
                {{-- <p>
                    Set your salary deductions here. 
                    You may update your deductions anytime as they change in real life. 
                    For now, you may only use the deductions given to you.
                    You will be able to choose your deductions later.
                </p> --}}
                <div class="control-group">
                    <input 
                        type="text"
                        id="add-deduction-input"
                        class="form-control"
                    >
                    <button
                        id="add-deduction-button" 
                        class="form-control w-50"   
                    >
                        Add Deduction
                    </button>
                </div>
                    @csrf
                    <div id="user-deductions-container">
                    </div>
                    {{-- 
                        @error('li')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('nhi')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('rent')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('utilities')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    --}}
                    <div class="control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Submit Deductions
                        </button>
                    </div>
                </form>
            </section>
            <section class="col-sm-6 offset-sm-3">
                {{-- savings section --}}
                <form action="profile/savings" method="post" class="form border">
                    <h2 id="savings">Savings</h2>
                    {{-- <p>
                        Set your savings information here. 
                        You may update your savings anytime if your savings rate changes. 
                        For now, you may only have one type of savings.
                    </p> --}}
                    @csrf
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
                            Submit Savings
                        </button>
                    </div>
                </form>
            </section>
                {{-- budget section --}}
            <section class="col-sm-6 offset-sm-3">
                <form action="profile/budgets" method="post" class="form border">
                    <h2 id="budget">Budget</h2>
                    {{-- <p>
                        Set your daily budget information here. 
                        You may update your daily budget anytime if you change how much you want to spend. 
                        But we recommend only changing your daily budget at the beginning of every month.
                    </p> --}}
                    @csrf
                    <div class="control-group">
                        <label 
                            for="budgets" 
                            class="form-label"
                            >
                            Daily Budget
                        </label>
                        <input 
                            type="text" 
                            id="budgets" 
                            name="budgets"
                            class="form-control"
                            value={{old('budgets')}}
                            >
                        @error('budgets')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Submit Budget
                        </button>
                    </div>
                </form>
            </section>
        </section>
    </main>
    <script>
        let addDeductionInput = document.getElementById('add-deduction-input');
        let addDeductionButton = document.getElementById('add-deduction-button');
        let deductionForm = document.getElementById('deduction-form');
        addDeductionButton.addEventListener('click', addNewDeductionInput);
        
        function addNewDeductionInput(e) {
            // console.log(addDeductionInput.value);
            // console.log(deductionForm);
            let userDeductionsContainer = document.getElementById('user-deductions-container');

            let newDivGroup = document.createElement('div');
            newDivGroup.setAttribute('class', 'control-group');

            let newLabel = document.createElement('label');
            newLabel.setAttribute('for', addDeductionInput.value);
            newLabel.setAttribute('class', 'form-label');
            newLabel.setAttribute('id', addDeductionInput.value);
            newLabel.textContent = addDeductionInput.value;
            console.log(newLabel);
            
            let newInput = document.createElement('input');
            newInput.setAttribute('name', addDeductionInput.value);
            newInput.setAttribute('class', 'form-control');
            newInput.setAttribute('type', 'number');
            console.log(newInput);

            userDeductionsContainer.appendChild(newDivGroup);
            newDivGroup.appendChild(newLabel);
            newDivGroup.appendChild(newInput);

            addDeductionInput.value = '';
        }
    </script>
<x-footer />