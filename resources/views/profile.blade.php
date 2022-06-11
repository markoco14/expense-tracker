<x-header />
<section>
    <div class="profile-header">
        <h1>Profile</h1>
        <div>
            <a href="#income">Income</a>
            <a href="#deductions">Deductions</a>
            <a href="#savings">Savings</a>
            <a href="#budget">Budget</a>
        </div>
    </div>
</section>
<section>
    <div class="profile-container">
        <h2 id="income">Income</h2>
        {{-- <p>Total Income: ${{$monthlySalary}}</p> --}}
        <p>Total: ${{$monthlySalary}}</caption>
        <ul class="profile-info-list">
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>Salary</span>
                    <span>${{$monthlySalary}}</span>
                </div>
                <div>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </li>
        </ul>
        <button class="add-profile-info-button">+ Income ></button>
        <form action="profile/salaries" method="post">
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
                class="save-button"
            >
                Save
            </button>
        </div>
    </form>
</div>
</section>
<section>
    <div class="profile-container">
        <h2 id="deductions">Deductions</h2>
        {{-- <p>Total Deductions: ${{$totalDeductions}}</p> --}}
        <p>Total: ${{$totalDeductions}}</p>
        <ul class="profile-info-list">
        @foreach ($allDeductions as $deduction)
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>{{$deduction['deduction_name']}}</span>
                    <span>${{$deduction['deduction_amount']}}</span>
                </div>
                <div>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </li>
            {{--  --}}
            @endforeach
        </ul>
        <button class="add-profile-info-button">+ Deductions ></button>
        <div>
            <div class="flex" style="justify-content: space-between">
                <div class="flex-column" >
                    <label for="">Deduction Name</label>
                    <input type="text">
                </div>
                <div class="flex-column" >
                    <label for="">Deduction Amount</label>
                    <input type="text">
                </div>
                <div class="flex-column" style="justify-content: end;">
                    <button>Add</button>
                </div>
            </div>
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
            <form  
                action="profile/deductions" 
                method="post"
                id="deduction-form"
            >
                @csrf
                <div id="user-deductions-container">
                </div>
                <div class="form-group">
                    <button 
                        type="submit" 
                        name="submit" 
                        class="save-button"
                        >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section>
    <div class="profile-container">
        <h2 id="savings">Savings</h2>
        <p>Total: ${{$savings}}</p>
        <ul class="profile-info-list">
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>Crypto </span>
                    <span>${{$savings}}</span>
                </div>
                <div>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </li>
        </ul>
        <button class="add-profile-info-button">+ Savings ></button>
        <form  action="profile/savings" method="post" >
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
                    class="save-button"
                    >
                    Save
                </button>
            </div>
        </form>
</section>
<section class="profile-form">
    <div class="profile-container">
        <h2 id="budget">Budget</h2>
        <p>Total: ${{$monthlyBudget}}</caption>
        <ul class="profile-info-list">
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>Daily</span>
                    <span>${{$dailyBudget}}</span>
                </div>
                <div>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>

                </div>
            </li>
        </ul>
        <button class="add-profile-info-button">+ Budget ></button>
        <form action="profile/budgets" method="post" >
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
                    class="save-button"
                    >
                    Save
                </button>
            </div>
        </form>
    </div>
</section>
<script>
    const addDeductionInput = document.getElementById('add-deduction-input');
    const addDeductionButton = document.getElementById('add-deduction-button');
    const deductionForm = document.getElementById('deduction-form');
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
