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