import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileBudgets() {
    const [budgets, setBudgets] = useState([]);
    const [totalBudgets, setTotalBudgets] = useState(0);
    const [currentLabel, setCurrentLabel] = useState('');
    const [currentAmount, setCurrentAmount] = useState(0);
    const [currentId, setCurrentId] = useState(0);
    const [newAmount, setNewAmount] = useState(undefined);
    const [newLabel, setNewLabel] = useState(undefined);


    function calculateTotalBudgets(budgets) {
        let total = 0;
        budgets?.forEach(budget => {
            total += budget.budget_amount;
        })
        const month = new Date().getMonth()+1;
        const year = new Date().getFullYear();
        const daysInMonth = new Date(year, month, 0).getDate();
        setTotalBudgets(total*daysInMonth);
    }

    const fetchData = async () => {
        const response = await fetch(`api/profile/budgets/${userid}`);
        const data = await response.json();
        setBudgets(data);
        calculateTotalBudgets(data)
    };

    useEffect(() => {
        fetchData();
    }, []);

    function openEditModal(budget) {
        const editBudgetModal = document.getElementById('edit-budgets-modal');
        setCurrentLabel(budget.budget_name);
        setCurrentAmount(budget.budget_amount);
        setCurrentId(budget.id);
        editBudgetModal.showModal();
    }

    function closeEditModal() {
        const editBudgetModal = document.getElementById('edit-budgets-modal');
        setCurrentLabel('');
        setCurrentAmount(0);
        setCurrentId(0);
        editBudgetModal.close();
    }

    async function editBudget() {
        const editBudgetModal = document.getElementById('edit-budgets-modal');
        const editBudgetInput = document.getElementById('edit-budgets-input');
        if (!newAmount) {
            alert('You need to choose an amount for your budget!');
        } else {
            const response = await fetch(`api/profile/budget/edit/${userid}/${currentId}/${newAmount}`, {
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
            editBudgetInput.value = '';
            setNewAmount(undefined);
            editBudgetModal.close();
        }
    }

    function openAddModal() {
        const addBudgetModal = document.getElementById('add-budgets-modal');
        addBudgetModal.showModal();
    }

    function closeAddModal() {
        const addBudgetModal = document.getElementById('add-budgets-modal');
        setNewLabel(undefined);
        setNewAmount(undefined);
        addBudgetModal.close();
    }

    async function addBudget() {
        console.log('You clicked confirm');
        if (!newLabel || !newAmount) {
            alert('You need to name the type of budget and choose an amount!');
        } else {
            console.log(newLabel);
            console.log(newAmount);
            const response = await fetch(`api/profile/budget/create/${userid}/${newLabel}/${newAmount}`, {
                method: 'POST',
                body: JSON.stringify({
                    label: newLabel,
                    amount: newAmount
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            fetchData();
            // const addBudgetModal = document.getElementById('add-budgets-modal');
            document.getElementById('add-budgets-modal').close();
        }
    }

    async function deleteBudget(budget) {
        // you should delete by id because you have the budget` object
        const response = await fetch(`api/profile/budget/delete/${userid}/${budget.id}`, {
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
            <div id="budget" className="profile-container">
                <h2>Budgets</h2>
                <p>Monthly: {totalBudgets? totalBudgets : 0}</p>
                <ul className="profile-info-list">
                    {budgets.map((budget, index) => {
                        return(
                            <li key={index}>
                                <div className="profile-info-name-amount">
                                    <span>
                                        {budget.budget_name}
                                    </span>
                                    <span>
                                        {budget.budget_amount}
                                    </span>
                                </div>
                                <div>
                                    <button 
                                        onClick={() => {openEditModal(budget)}}
                                        className="edit-button"
                                    >Edit</button>
                                    <button 
                                        onClick={() => deleteBudget(budget)}
                                        className="delete-button"
                                    >Delete</button>
                                </div>
                            </li>
                        );
                    })}
                </ul>
                <button onClick={openAddModal}>+ New</button>
                <dialog id="add-budgets-modal" className="profile-modal">
                    <div className="form-group">
                        <label>Budget Name</label>
                        <input 
                        id="new-budget-label" 
                        type="string" 
                        placeholder={"Daily"}
                        onChange={(e) => {
                            setNewLabel(() => {
                                if (e.target.value === '') {
                                    return undefined;
                                }
                                return e.target.value;
                            });
                        }}
                    ></input>
                    </div>
                    <div className="form-group">
                        <label>Budget Amount</label>
                        <input 
                        id="new-budget-input" 
                        type="number" 
                        placeholder={0}
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
                        <button className="profile-modal-button" onClick={closeAddModal} value="cancel">Cancel</button>
                        <button className="profile-modal-button profile-modal-confirm" onClick={addBudget}>Confirm</button>
                    </div>
                </dialog>
                <dialog id="edit-budgets-modal" className="profile-modal">
                    <div className="form-group">
                        <label id="edit-budgets-label">{currentLabel}</label>
                        <input 
                        id="edit-budgets-input" 
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
                        <button className="profile-modal-button profile-modal-confirm" onClick={editBudget}>Confirm</button>
                    </div>
                </dialog>
            </div>
        </>
    );
}

if (document.getElementById('profile-budgets')) {
    ReactDOM.render(<ProfileBudgets />, document.getElementById('profile-budgets'));
}
