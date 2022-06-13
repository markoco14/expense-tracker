<x-header />
@if(Auth::check())
    <script>
        let userid = "{{ Auth::user()->id }}";
    </script>
@endif
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
                    {{-- delete will need data-name['salary_name'] later --}}
                    <button class="delete-button delete-salary">Delete</button>
                </div>
            </li>
        </ul>
        <button id="incomeModalButton">+ New</button>
        <dialog id="incomeModal" class="profile-modal">
            <div>
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
                    <div class="flex profile-modal-buttons">
                        <button id="incomeCancelButton" value="cancel">Cancel</button>
                        <button 
                            id="incomeConfirmButton" 
                            value="default"
                            type="submit" 
                            name="submit" 
                            class="save-button"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
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
                    <button data-name="{{$deduction['deduction_name']}}" class="delete-button delete-deduction">Delete</button>
                </div>
            </li>
            {{-- <dialog>
                <form action="">
                    <label for="">{{$deduction['deduction_name']}}</label>
                    <input type="text" value="{{$deduction['deduction_amount']}}">
                </form>
            </dialog> --}}
            {{--  --}}
            @endforeach
        </ul>
        <button id="deductionModalButton">+ New</button>
        <dialog id="deductionModal" class="profile-modal">
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
                </div>
                <div class="flex" style="justify-content: right;">
                    <button>Add</button>
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
                    <div class="flex profile-modal-buttons">
                        <button id="deductionCancelButton" value="cancel">
                            Cancel
                        </button>
                        <button
                            value="default"
                            type="submit" 
                            name="submit" 
                            class="save-button"
                        >
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
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
                    <button class="delete-button delete-saving">Delete</button>
                </div>
            </li>
        </ul>
        <button id="savingsModalButton">+ New</button>
        <dialog id="savingsModal" class="profile-modal">
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
                <div class="flex profile-modal-buttons">
                    <button id="savingsCancelButton">
                        Cancel
                    </button>
                    <button 
                        id="savingsConfirmButton"
                        value="default"
                        type="submit" 
                        name="submit" 
                        class="save-button"
                    >
                        Add
                    </button>
                </div>
            </form>
        </dialog>
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
                    <button class="delete-button delete-budget">Delete</button>

                </div>
            </li>
        </ul>
        <button id="budgetModalButton">+ New</button>
        <dialog id="budgetModal" class="profile-modal">
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
                <div class="flex profile-modal-buttons">
                    <button id="budgetCancelButton">
                        Cancel
                    </button>
                    <button 
                        id="budgetConfirmButton"
                        type="submit" 
                        name="submit" 
                        class="save-button"
                    >
                        Add
                    </button>
                </div>
            </form>
        </dialog>
    </div>
</section>
<script>
    const deleteSalaryButtons = document.querySelectorAll('.delete-salary');
    deleteSalaryButtons.forEach(button => {
        button.addEventListener('click', deleteSalary);
    });

    async function deleteSalary(e) {
        const response = await fetch(`api/profile/salary/delete/${userid}`, {
            method: 'POST',
            body: JSON.stringify({
                user_id: userid
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        e.target.parentNode.parentNode.remove();
    }

    const deleteDeductionButtons = document.querySelectorAll('.delete-deduction');
    deleteDeductionButtons.forEach(button => {
        button.addEventListener('click', deleteDeduction);
    });
    
    async function deleteDeduction(e) {
        const response = await fetch(`api/profile/deduction/delete/${userid}/${e.target.getAttribute('data-name')}`, {
            method: 'POST',
            body: JSON.stringify({
                user_id: userid,
                deduction_name: e.target.getAttribute('data-name'),    
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        e.target.parentNode.parentNode.remove();
    }

    const deleteSavingButtons = document.querySelectorAll('.delete-saving');
    deleteSavingButtons.forEach(button => {
        button.addEventListener('click', deleteSaving);
    });

    async function deleteSaving(e) {
        const response = await fetch(`api/profile/saving/delete/${userid}`, {
            method: 'POST',
            body: JSON.stringify({
                user_id: userid
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        e.target.parentNode.parentNode.remove();
    }

    const deleteBudgetButtons = document.querySelectorAll('.delete-budget');
    deleteBudgetButtons.forEach(button => {
        button.addEventListener('click', deleteBudget);
    });

    async function deleteBudget(e) {
        const response = await fetch(`api/profile/budget/delete/${userid}`, {
            method: 'POST',
            body: JSON.stringify({
                user_id: userid
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        e.target.parentNode.parentNode.remove();
    }
</script>
<script>
    // income modal
    const incomeModal = document.getElementById('incomeModal');
    const incomeModalButton = document.getElementById('incomeModalButton');
    const incomeCancelButton = document.getElementById('incomeCancelButton');
    incomeModalButton.addEventListener('click', function() {
        incomeModal.showModal();
    });

    incomeCancelButton.addEventListener('click', function(e) {
        e.preventDefault();
        incomeModal.close();
    });
    
    // deduction modal
    const deductionModal = document.getElementById('deductionModal');
    const deductionModalButton = document.getElementById('deductionModalButton');
    const deductionCancelButton = document.getElementById('deductionCancelButton');

    deductionModalButton.addEventListener('click', function() {
        deductionModal.showModal();
    });

    deductionCancelButton.addEventListener('click', function(e) {
        e.preventDefault();
        deductionModal.close();
    });

    // savings modal
    const savingsModal = document.getElementById('savingsModal');
    const savingsModalButton = document.getElementById('savingsModalButton');
    const savingsCancelButton = document.getElementById('savingsCancelButton');

    savingsModalButton.addEventListener('click', function() {
        savingsModal.showModal();
    });

    savingsCancelButton.addEventListener('click', function(e) {
        e.preventDefault();
        savingsModal.close();
    });

    // budget modal
    const budgetModal = document.getElementById('budgetModal');
    const budgetModalButton = document.getElementById('budgetModalButton');
    const budgetCancelButton = document.getElementById('budgetCancelButton');

    budgetModalButton.addEventListener('click', function() {
        budgetModal.showModal();
    });

    budgetCancelButton.addEventListener('click', function(e) {
        e.preventDefault();
        budgetModal.close();
    });

    const addDeductionInput = document.getElementById('add-deduction-input');
    const addDeductionButton = document.getElementById('add-deduction-button');
    const deductionForm = document.getElementById('deduction-form');
    addDeductionButton.addEventListener('click', addNewDeductionInput);
    
    function addNewDeductionInput(e) {
        e.preventDefault();
        let userDeductionsContainer = document.getElementById('user-deductions-container');

        let newDivGroup = document.createElement('div');
        newDivGroup.setAttribute('class', 'form-group');

        let newLabel = document.createElement('label');
        newLabel.setAttribute('for', addDeductionInput.value);
        newLabel.setAttribute('class', 'form-label');
        newLabel.setAttribute('id', addDeductionInput.value);
        newLabel.textContent = addDeductionInput.value;
        
        let newInput = document.createElement('input');
        newInput.setAttribute('name', addDeductionInput.value);
        newInput.setAttribute('class', 'form-control');
        newInput.setAttribute('type', 'number');

        userDeductionsContainer.appendChild(newDivGroup);
        newDivGroup.appendChild(newLabel);
        newDivGroup.appendChild(newInput);

        addDeductionInput.value = '';
    }
</script>
<x-footer />
