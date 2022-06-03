<x-header />
    <div class="container" style="padding-top:5rem;">
        <div class="form">
            <section style="margin-bottom: 2rem;">
                <h1 class="form-title">Your Financial Profile</h1>
                <div>
                    <a href="#income">Income</a>
                    <a href="#deductions">Deductions</a>
                    <a href="#savings">Savings</a>
                    <a href="#budget">Budget</a>
                </div>
            </section>
            <section class="profile-form">
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
                <form  action="profile/salaries" method="post">
                    <h2 class="form-title" id="income">Income</h2>
                    @csrf
                <div class="form-group">
                        <label for="salary">
                            Salary
                        </label>
                        <input 
                            type="number" 
                            id="salary" 
                            name="salary"
                            
                            value={{old('salary')}}
                        >
                        @error('salary')
                            <p class="error">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            
                            >
                            Save
                        </button>
                    </div>
                </form>
            </section>
            <section class="profile-form">
                {{-- deductions section --}}
                <form  
                    action="profile/deductions" 
                    method="post"
                    id="deduction-form"
                    >
                <h2 class="form-title" id="deductions">Deductions</h2>
                <div class="add-input-group">
                    <input 
                        type="text"
                        id="add-deduction-input"
                    >
                    <button
                        id="add-deduction-button"    
                    >
                        Add Deduction
                    </button>
                </div>
                    @csrf
                    <div id="user-deductions-container">
                    </div>
                    <div class="form-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            
                            >
                            Save
                        </button>
                    </div>
                </form>
            </section>
            <section class="profile-form">
                {{-- savings section --}}
                <form  action="profile/savings" method="post" >
                    <h2 class="form-title" id="savings">Savings</h2>
                    @csrf
                    <div class="form-group">
                        <label 
                            for="savings" 
                        
                            >
                            Savings
                        </label>
                        <input 
                            type="text" 
                            id="savings" 
                            name="savings"
                            
                            value={{old('savings')}}
                            >
                        @error('savings')
                            <p class="error">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            
                            >
                            Save
                        </button>
                    </div>
                </form>
            </section>
            
            {{-- budget section --}}
            <section class="profile-form">
                <form  action="profile/budgets" method="post" >
                    <h2 class="form-title" id="budget">Budget</h2>
                    @csrf
                    <div class="form-group">
                        <label 
                            for="budgets" 
                        
                            >
                            Daily Budget
                        </label>
                        <input 
                            type="text" 
                            id="budgets" 
                            name="budgets"
                            
                            value={{old('budgets')}}
                            >
                        @error('budgets')
                            <p class="error">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            
                            >
                            Save
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script>
        let addDeductionInput = document.getElementById('add-deduction-input');
        let addDeductionButton = document.getElementById('add-deduction-button');
        let deductionForm = document.getElementById('deduction-form');
        addDeductionButton.addEventListener('click', addNewDeductionInput);
        
        function addNewDeductionInput(e) {
            e.preventDefault();
            // console.log(addDeductionInput.value);
            // console.log(deductionForm);
            let userDeductionsContainer = document.getElementById('user-deductions-container');

            let newDivGroup = document.createElement('div');
            newDivGroup.setAttribute('class', 'form-group');

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