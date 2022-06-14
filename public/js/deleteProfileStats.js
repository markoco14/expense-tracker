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