import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileSavings() {
    const [savings, setSavings] = useState([]);
    const [totalSavings, setTotalSavings] = useState(0);
    const [currentLabel, setCurrentLabel] = useState('');
    const [currentAmount, setCurrentAmount] = useState(0);
    const [newAmount, setNewAmount] = useState(undefined);
    const [addLabel, setAddLabel] = useState(undefined);
    const [addAmount, setAddAmount] = useState(undefined);

    function calculateTotalSavings(savings) {
        let total = 0;
        savings?.forEach(saving => {
            total += saving.savings_amount;
        })
        setTotalSavings(total);
    }

    const fetchData = async () => {
        const response = await fetch(`api/profile/savings/${userid}`);
        const data = await response.json();
        setSavings(data);
        calculateTotalSavings(data);
    };

    function openEditModal(saving) {
        const editSavingsModal = document.getElementById('edit-savings-modal');
        setCurrentLabel(saving.savings_name);
        setCurrentAmount(saving.savings_amount);
        editSavingsModal.showModal();
    }

    function closeEditModal() {
        const editSavingsModal = document.getElementById('edit-savings-modal');
        editSavingsModal.close();
    }

    async function editSavings() {
        const editSavingsModal = document.getElementById('edit-savings-modal');
        const editSavingsInput = document.getElementById('edit-savings-input');
        if (!newAmount) {
            alert('You need to choose the savings amount.');
        } 
        else {
            const response = await fetch(`api/profile/saving/edit/${userid}/${currentLabel}/${newAmount}/${currentLabel}`, {
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
            editSavingsInput.value = '';
            setNewAmount(undefined);
            editSavingsModal.close();
        }
    }

    function openAddModal() {
        const addSavingsModal = document.getElementById('add-savings-modal');
        addSavingsModal.showModal();
    }

    function closeAddModal() {
        const addSavingsModal = document.getElementById('add-savings-modal');
        const nameInput = document.getElementById('add-savings-name-input');
        const amountInput = document.getElementById('add-savings-amount-input');
        nameInput.value = '';
        amountInput.value = '';
        addSavingsModal.close();
    }

    async function addSavings() {
        const addSavingsModal = document.getElementById('add-savings-modal');
        if (addLabel === undefined || addAmount === undefined) {
            alert('You need to choose your savings information');
        } 
        else {
            const response = await fetch(`api/profile/saving/create/${userid}/${addLabel}/${addAmount}`, {
                method: 'POST',
                body: JSON.stringify({
                    name: addLabel,
                    amount: addAmount
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            fetchData();
            const nameInput = document.getElementById('add-savings-name-input');
            const amountInput = document.getElementById('add-savings-amount-input');
            nameInput.value = '';
            amountInput.value = '';
            setAddLabel(undefined);
            setAddAmount(undefined);
            addSavingsModal.close();
        }
    }

    async function deleteSavings(saving) {
        const response = await fetch(`api/profile/saving/delete/${userid}/${saving.id}`, {
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

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <>
            <div id="savings">
                <h2>Savings</h2>
                <p>Total: ${totalSavings? totalSavings : 0}</p>
                <ul className="profile-info-list">
                    {savings.map((saving, index) => {
                        return(
                            <li key={index} className="flex">
                                <div className="profile-info-name-amount">
                                    <span>
                                        {saving.savings_name}
                                    </span>
                                    <span>
                                        ${saving.savings_amount}
                                    </span>
                                </div>
                                <div>
                                    <button 
                                        onClick={() => {openEditModal(saving)}}
                                        className="edit-button"
                                    >Edit</button>
                                    <button 
                                        onClick={() => deleteSavings(saving)}
                                        className="delete-button"
                                    >Delete</button>
                                </div>
                            </li>
                        );
                    })}
                </ul>
                <button onClick={openAddModal}>+ New</button>
            </div>
            <dialog id="add-savings-modal" className="profile-modal">
                <div className="form-group">
                    <label>Savings Name</label>
                    <input 
                        id="add-savings-name-input" 
                        type="text"
                        onChange={(e) => {
                            setAddLabel(() => {
                                if (e.target.value === '') {
                                    return undefined;
                                }
                                return e.target.value;
                            });
                        }}
                    >
                    </input>
                </div>
                <div className="form-group">
                    <label>Savings Amount</label>
                    <input
                        id="add-savings-amount-input"
                        type="number"
                        onChange={(e) => {
                            setAddAmount(() => {
                                if (e.target.value === '') {
                                    return undefined;
                                }
                                return e.target.value;
                            });
                        }}
                    >
                    </input>
                </div>
                <div>
                    <button className="profile-modal-button" onClick={closeAddModal}>Cancel</button>
                    <button className="profile-modal-button profile-modal-confirm" onClick={addSavings}>Confirm</button>
                </div>
            </dialog>
            <dialog id="edit-savings-modal" className="profile-modal">
                <div className="form-group">
                    <label id="edit-savings-label">{currentLabel}</label>
                    <input 
                    id="edit-savings-input" 
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
                    <button className="profile-modal-button profile-modal-confirm" onClick={editSavings}>Confirm</button>
                </div>
            </dialog>
        </>
    );
}

if (document.getElementById('profile-savings')) {
    ReactDOM.render(<ProfileSavings />, document.getElementById('profile-savings'));
}
