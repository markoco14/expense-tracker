const editSalaryButtons = document.querySelectorAll('.edit-salary');
editSalaryButtons.forEach(button => {
    button.addEventListener('click', createEditSalaryModal);
})

function createEditSalaryModal(e) {
    const salaryRow = e.target.parentNode.parentNode;
    const salaryLabel = salaryRow.firstElementChild.firstElementChild;
    const salaryAmount = salaryRow.firstElementChild.firstElementChild.nextElementSibling;
    // console.log(salaryRow);
    // console.log(salaryLabel);
    // console.log(salaryAmount);

    const editAmount = e.target.getAttribute('data-amount');
    const editModal = document.createElement('dialog');
    editModal.setAttribute('class', 'profile-modal');

    const editNameLabel = document.createElement('label');
    editNameLabel.textContent = 'Salary';
    const editNameInput = document.createElement('input');
    editNameInput.value = 'Salary';
    const editAmountLabel = document.createElement('label');
    editAmountLabel.textContent = 'Amount';
    const editAmountInput = document.createElement('input');
    editAmountInput.value = editAmount;

    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancel';
    cancelButton.setAttribute('value', 'cancel');
    cancelButton.addEventListener('click', () => {
        e.preventDefault();
        editModal.close();
        document.body.removeChild(editModal);
    });

    const confirmButton = document.createElement('button');
    confirmButton.textContent = 'Confirm';
    confirmButton.addEventListener('click', submitData);

    async function submitData() {
        console.log('You are submitting data now');
        const response = await fetch(`api/profile/salary/edit/${userid}/${editAmountInput.value}`, {
            method: 'POST',
            body: JSON.stringify({
                label: editNameInput.value,
                amount: editAmountInput.value
            }),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        });
        const updated = await fetch(`api/profile/salary/get/${userid}/${salary}`);
        const data = await updated.json();
        console.log(data);
        const newAmount = data[0].salary_amount;
        salaryAmount.textContent = `$${newAmount}`;
        e.target.setAttribute('data-amount', newAmount);
        editModal.close();
        document.body.removeChild(editModal);
    }

    editModal.appendChild(editNameLabel);
    editModal.appendChild(editNameInput);
    editModal.appendChild(editAmountLabel);
    editModal.appendChild(editAmountInput);
    editModal.appendChild(cancelButton);
    editModal.appendChild(confirmButton);
    document.body.appendChild(editModal);
    editModal.showModal();
}


const editDeductionButtons = document.querySelectorAll('.edit-deduction');
editDeductionButtons.forEach(button => {
    button.addEventListener('click', createEditDeductionModal);
});

function createEditDeductionModal(e) {
    const deductionRow = e.target.parentNode.parentNode;
    const deductionLabel = deductionRow.firstElementChild.firstElementChild;
    const deductionAmount = deductionRow.firstElementChild.firstElementChild.nextElementSibling;
    // console.log(deductionRow);
    // console.log(deductionLabel);
    // console.log(deductionAmount);
    // console.log(e.target.getAttribute('data-name'));
    // console.log(e.target.getAttribute('data-amount'));
    const editName = e.target.getAttribute('data-name');
    const editAmount = e.target.getAttribute('data-amount');
    const editModal = document.createElement('dialog');
    editModal.setAttribute('class', 'profile-modal');
    
    // const nameReference = document.createElement('p');
    // nameReference.textContent = editName;
    // const amountReference = document.createElement('p');
    // amountReference.textContent = editAmount;
    const editNameLabel = document.createElement('label');
    editNameLabel.textContent = 'Deduction';
    const editNameInput = document.createElement('input');
    editNameInput.value = editName;
    const editAmountLabel = document.createElement('label');
    editAmountLabel.textContent = 'Amount';
    const editAmountInput = document.createElement('input');
    editAmountInput.value = editAmount;

    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancel';
    cancelButton.setAttribute('value', 'cancel');
    cancelButton.addEventListener('click', () => {
        e.preventDefault();
        editModal.close();
        document.body.removeChild(editModal);
    });
    
    const confirmButton = document.createElement('button');
    confirmButton.textContent = 'Confirm';
    confirmButton.addEventListener('click', submitData);

    async function submitData() {
        console.log('You clicked the submit button');
        const response = await fetch(`api/profile/deduction/edit/${userid}/${editNameInput.value}/${editAmountInput.value}/${editName}`, {
            method: 'POST',
            body: JSON.stringify({
                label: editNameInput.value,
                amount: editAmountInput.value
            }),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        });
        const updated = await fetch(`api/profile/deduction/get/${userid}/${editNameInput.value}`);
        const data = await updated.json();
        console.log(data);
        const newName = data[0].deduction_name;
        const newAmount = data[0].deduction_amount;
        deductionLabel.textContent = newName;
        deductionAmount.textContent = `$${newAmount}`;
        e.target.setAttribute('data-name', newName);
        e.target.setAttribute('data-amount', newAmount);
        editModal.close();
        document.body.removeChild(editModal);
    };

    // editModal.appendChild(nameReference);
    // editModal.appendChild(amountReference);
    editModal.appendChild(editNameLabel);
    editModal.appendChild(editNameInput);
    editModal.appendChild(editAmountLabel);
    editModal.appendChild(editAmountInput);
    editModal.appendChild(confirmButton);
    editModal.appendChild(cancelButton);
    document.body.appendChild(editModal);
    editModal.showModal();
}

const editSavingsButtons = document.querySelectorAll('.edit-savings');
editSavingsButtons.forEach(button => {
    button.addEventListener('click', createEditSavingsModal);
});

function createEditSavingsModal(e) {
    const savingRow = e.target.parentNode.parentNode;
    const savingLabel = savingRow.firstElementChild.firstElementChild;
    const savingAmount = savingRow.firstElementChild.firstElementChild.nextElementSibling;
    // console.log(savingRow);
    // console.log(savingLabel);
    // console.log(savingAmount);

    const editAmount = e.target.getAttribute('data-amount');
    const editModal = document.createElement('dialog');
    editModal.setAttribute('class', 'profile-modal');

    const editNameLabel = document.createElement('label');
    editNameLabel.textContent = 'Saving';
    const editNameInput = document.createElement('input');
    editNameInput.value = 'Crypto';
    const editAmountLabel = document.createElement('label');
    editAmountLabel.textContent = 'Amount';
    const editAmountInput = document.createElement('input');
    editAmountInput.value = editAmount;

    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancel';
    cancelButton.setAttribute('value', 'cancel');
    cancelButton.addEventListener('click', () => {
        e.preventDefault();
        editModal.close();
        document.body.removeChild(editModal);
    });

    const confirmButton = document.createElement('button');
    confirmButton.textContent = 'Confirm';
    confirmButton.addEventListener('click', submitData);

    async function submitData() {
        // console.log('You are submitting data now');
        const response = await fetch(`api/profile/saving/edit/${userid}/${editAmountInput.value}`, {
            method: 'POST',
            body: JSON.stringify({
                label: editNameInput.value,
                amount: editAmountInput.value
            }),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        });
        const updated = await fetch(`api/profile/saving/get/${userid}`);
        const data = await updated.json();
        console.log(data);
        const newAmount = data[0].savings_amount;
        savingAmount.textContent = `$${newAmount}`;
        e.target.setAttribute('data-amount', newAmount);
        editModal.close();
        document.body.removeChild(editModal);
    }

    editModal.appendChild(editNameLabel);
    editModal.appendChild(editNameInput);
    editModal.appendChild(editAmountLabel);
    editModal.appendChild(editAmountInput);
    editModal.appendChild(cancelButton);
    editModal.appendChild(confirmButton);
    document.body.appendChild(editModal);
    editModal.showModal();
}

const editBudgetButtons = document.querySelectorAll('.edit-budget');
editBudgetButtons.forEach(button => {
    button.addEventListener('click', createEditBudgetModal);
});

function createEditBudgetModal(e) {
    // console.log('You clicked the edit budget button');
    const budgetRow = e.target.parentNode.parentNode;
    const budgetLabel = budgetRow.firstElementChild.firstElementChild;
    const budgetAmount = budgetRow.firstElementChild.firstElementChild.nextElementSibling;
    // console.log(budgetRow);
    // console.log(budgetLabel);
    // console.log(budgetAmount);

    const editAmount = e.target.getAttribute('data-amount');
    const editModal = document.createElement('dialog');
    editModal.setAttribute('class', 'profile-modal');

    const editNameLabel = document.createElement('label');
    editNameLabel.textContent = 'Budget';
    const editNameInput = document.createElement('input');
    editNameInput.value = 'Daily';
    const editAmountLabel = document.createElement('label');
    editAmountLabel.textContent = 'Amount';
    const editAmountInput = document.createElement('input');
    editAmountInput.value = editAmount;

    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancel';
    cancelButton.setAttribute('value', 'cancel');
    cancelButton.addEventListener('click', () => {
        e.preventDefault();
        editModal.close();
        document.body.removeChild(editModal);
    });

    const confirmButton = document.createElement('button');
    confirmButton.textContent = 'Confirm';
    confirmButton.addEventListener('click', submitData);

    async function submitData() {
        // console.log('You are submitting data now');
        const response = await fetch(`api/profile/budget/edit/${userid}/${editAmountInput.value}`, {
            method: 'POST',
            body: JSON.stringify({
                label: editNameInput.value,
                amount: editAmountInput.value
            }),
            headers: {
            "Content-type": "application/json; charset=UTF-8"
            }
        });
        const updated = await fetch(`api/profile/budget/get/${userid}`);
        const data = await updated.json();
        console.log(data);
        const newAmount = data[0].budget_amount;
        budgetAmount.textContent = `$${newAmount}`;
        e.target.setAttribute('data-amount', newAmount);
        editModal.close();
        document.body.removeChild(editModal);
    }

    editModal.appendChild(editNameLabel);
    editModal.appendChild(editNameInput);
    editModal.appendChild(editAmountLabel);
    editModal.appendChild(editAmountInput);
    editModal.appendChild(cancelButton);
    editModal.appendChild(confirmButton);
    document.body.appendChild(editModal);
    editModal.showModal();
}