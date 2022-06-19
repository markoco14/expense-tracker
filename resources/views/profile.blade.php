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
    <div id="profile-salary"></div>
</section>
{{-- <section>
    <div class="profile-container">
        <h2 id="income">Income</h2>
        <p>Total: ${{$monthlySalary}}</caption>
        <ul class="profile-info-list">
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>Salary</span>
                    <span>${{$monthlySalary}}</span>
                </div>
                <div>
                    <button data-amount="{{$monthlySalary}}" class="edit-button edit-salary">Edit</button>
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
</section> --}}
<section>
    <div id="profile-deduction"></div>
</section>
{{-- <section>
    <div class="profile-container">
        <h2 id="deductions">Deductions</h2>
        <p>Total: ${{$totalDeductions}}</p>
        <ul class="profile-info-list">
        @foreach ($allDeductions as $deduction)
            <li class="flex">
                <div class="profile-info-name-amount">
                    <span>{{$deduction['deduction_name']}}</span>
                    <span>${{$deduction['deduction_amount']}}</span>
                </div>
                <div>
                    <button data-name="{{$deduction['deduction_name']}}" data-amount="{{$deduction['deduction_amount']}}" class="edit-button edit-deduction">Edit</button>
                    <button data-name="{{$deduction['deduction_name']}}" class="delete-button delete-deduction">Delete</button>
                </div>
            </li>
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
</section> --}}
<section id="profile-savings"></section>
{{-- <section>
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
                    <button data-amount="{{$savings}}" class="edit-button edit-savings">Edit</button>
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
</section> --}}
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
                    <button data-amount="{{$dailyBudget}}" class="edit-button edit-budget">Edit</button>
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
{{-- <script type="text/javascript" src="{{URL::asset('js/editProfileStats.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/deleteProfileStats.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/addProfileStats.js')}}"></script> --}}
<x-footer />
