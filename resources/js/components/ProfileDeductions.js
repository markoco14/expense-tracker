import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileDeductions() {
    const [deductions, setDeductions] = useState([]);
    const [totalDeductions, setTotalDeductions] = useState(0);
    const [currentLabel, setCurrentLabel] = useState('');
    const [currentAmount, setCurrentAmount] = useState(0);
    const [newAmount, setNewAmount] = useState(undefined);

    function calculateTotalDeductions(deductions) {
        let total = 0;
        deductions?.forEach(deduction => {
            total += deduction.deduction_amount;
        })
        setTotalDeductions(total);
    }
    const fetchData = async () => {
        const response = await fetch(`api/profile/deduction/${userid}`);
        const data = await response.json();
        setDeductions(data);
        calculateTotalDeductions(data);
    };

    useEffect(() => {
        fetchData();
    }, []);

    function openEditModal(deduction) {
        setCurrentLabel(deduction.deduction_name);
        setCurrentAmount(deduction.deduction_amount);
        const editDeductionModal = document.getElementById('edit-deduction-modal');
        editDeductionModal.showModal();
    }

    function closeEditModal() {
        const editDeductionModal = document.getElementById('edit-deduction-modal');
        const editDeductionInput = document.getElementById('edit-deduction-input');
        editDeductionInput.value = '';
        setNewAmount(undefined);
        editDeductionModal.close();
    }

    async function editDeduction() {
        const editDeductionModal = document.getElementById('edit-deduction-modal');
        const editDeductionInput = document.getElementById('edit-deduction-input');
        if (!newAmount) {
            alert('You need to choose the deduction amount.');
        } 
        else {
            const response = await fetch(`api/profile/deduction/edit/${userid}/${currentLabel}/${newAmount}/${currentLabel}`, {
                method: 'POST',
                body: JSON.stringify({
                    label: 'Deduction',
                    amount: newAmount
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            fetchData();
            editDeductionInput.value = '';
            setNewAmount(undefined);
            editDeductionModal.close();
        }
    }

    function openAddModal() {
        const addDeductionModal = document.getElementById('add-deduction-modal');
        addDeductionModal.showModal();
    }

    function closeAddModal() {
        const nameInput = document.getElementById('add-deduction-name-input');
        const amountInput = document.getElementById('add-deduction-amount-input');
        nameInput.value = '';
        amountInput.value = '';
        const addDeductionModal = document.getElementById('add-deduction-modal');
        addDeductionModal.close();
    }

    async function addDeduction() {
        const addDeductionModal = document.getElementById('add-deduction-modal');
        const deductionName = document.getElementById('add-deduction-name-input').value;
        const deductionAmount = document.getElementById('add-deduction-amount-input').value;
        if (deductionName === '' || deductionAmount === '') {
            alert('You need to choose your deduction information');
        } else {
            const response = await fetch(`api/profile/deduction/create/${userid}/${deductionName}/${deductionAmount}`, {
                method: 'POST',
                body: JSON.stringify({
                    name: deductionName,
                    amount: deductionAmount
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
        }
        fetchData();
        const nameInput = document.getElementById('add-deduction-name-input');
        const amountInput = document.getElementById('add-deduction-amount-input');
        nameInput.value = '';
        amountInput.value = '';
        addDeductionModal.close();
    }

    async function deleteDeduction(deduction) {
        // you should delete by id because you have the deduction object
        const response = await fetch(`api/profile/deduction/delete/${userid}/${deduction.id}`, {
            method: 'POST',
            body: JSON.stringify({
                user_id: userid
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });
        fetchData();

    }

    return (
        <>
            <div id="deductions" className="profile-container">
                <h2>Deductions</h2>
                <p>Total: ${totalDeductions? totalDeductions : 0}</p>
                <ul className="profile-info-list">
                    {/* {DeductionsList} */}
                    {deductions.map((deduction, index) => {
                        return(
                            <li key={index} className="flex">
                                <div className="profile-info-name-amount">
                                    <span>
                                        {deduction.deduction_name}
                                    </span>
                                    <span>
                                        ${deduction.deduction_amount}
                                    </span>
                                </div>
                                <div>
                                    <button 
                                        onClick={() => {openEditModal(deduction)}} 
                                        className="edit-button"
                                    >Edit</button>
                                    <button onClick={() => {deleteDeduction(deduction)}} className="delete-button">Delete</button>
                                </div>
                            </li>
                        );
                    })}
                </ul>
                <button onClick={openAddModal}>+ New</button>
            </div>
            <dialog id="add-deduction-modal" className="profile-modal">
                <div className="form-group">
                    <label>Deduction Name</label>
                    <input id="add-deduction-name-input" type="text"></input>
                </div>
                <div className="form-group">
                    <label>Deduction Amount</label>
                    <input id="add-deduction-amount-input" type="number"></input>
                </div>
                <div>
                    <button className="profile-modal-button" onClick={closeAddModal}>Cancel</button>
                    <button className="profile-modal-button profile-modal-confirm" onClick={addDeduction}>Confirm</button>
                </div>
            </dialog>
            <dialog id="edit-deduction-modal" className="profile-modal">
            <div className="form-group">
                <label id="edit-deduction-label">{currentLabel}</label>
                <input 
                id="edit-deduction-input" 
                type="number" 
                placeholder={currentAmount}
                onChange={(e) => {
                    setNewAmount(() => {
                        if (e.target.value === '') {
                            return undefined;
                        }
                        return e.target.value;
                    });
                }}
                ></input>
            </div>
            <div>
                <button className="profile-modal-button" onClick={closeEditModal} value="cancel">Cancel</button>
                <button className="profile-modal-button profile-modal-confirm" onClick={editDeduction}>Confirm</button>
            </div>
            </dialog>
        </>
    );
}

if (document.getElementById('profile-deduction')) {
    ReactDOM.render(<ProfileDeductions />, document.getElementById('profile-deduction'));
}
