const editDeductionButtons = document.querySelectorAll('.edit-deduction');
    editDeductionButtons.forEach(button => {
        button.addEventListener('click', createEditModal);
    });

    function createEditModal(e) {
        const deductionRow = e.target.parentNode.parentNode;
        const deductionLabel = deductionRow.firstElementChild.firstElementChild;
        const deductionAmount = deductionRow.firstElementChild.firstElementChild.nextElementSibling;
        console.log(deductionRow);
        console.log(deductionLabel);
        console.log(deductionAmount);
        // console.log(e.target.getAttribute('data-name'));
        // console.log(e.target.getAttribute('data-amount'));
        editName = e.target.getAttribute('data-name');
        editAmount = e.target.getAttribute('data-amount');
        const editModal = document.createElement('dialog');
        editModal.setAttribute('class', 'profile-modal');
        
        const nameReference = document.createElement('p');
        nameReference.textContent = editName;

        const amountReference = document.createElement('p');
        amountReference.textContent = editAmount;

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

        editModal.appendChild(nameReference);
        editModal.appendChild(amountReference);
        editModal.appendChild(editNameLabel);
        editModal.appendChild(editNameInput);
        editModal.appendChild(editAmountLabel);
        editModal.appendChild(editAmountInput);
        editModal.appendChild(confirmButton);
        editModal.appendChild(cancelButton);
        document.body.appendChild(editModal);
        editModal.showModal();
    }