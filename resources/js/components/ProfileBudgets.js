import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileBudgets() {
    const [budgets, setBudgets] = useState([]);
    const [totalSavings, setTotalSavings] = useState(0);
    const [currentLabel, setCurrentLabel] = useState('');
    const [currentAmount, setCurrentAmount] = useState(0);
    const [newAmount, setNewAmount] = useState(undefined);

    const fetchData = async () => {
        const response = await fetch(`api/profile/budgets/${userid}`);
        const data = await response.json();
        console.log(data);
        setBudgets(data);
        // calculateTotalSavings(data);
    };

    useEffect(() => {
        fetchData();
    }, []);


    return (
        <>
            <div className="profile-container">
                <h2>Savings</h2>
                <p>Total: $$$</p>
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
                                        data-name={saving.savings_name} 
                                        data-value={saving.savings_amount} 
                                        className="edit-button"
                                    >Edit</button>
                                    <button className="delete-button">Delete</button>
                                </div>
                            </li>
                        );
                    })}
                </ul>
                <button>+ New</button>
            </div>
            <dialog id="add-savings-modal" className="profile-modal">
                <label>Deduction Name</label>
                <input id="add-savings-name-input" type="text"></input>
                <label>Deduction Amount</label>
                <input id="add-savings-amount-input" type="number"></input>
                <button >Cancel</button>
                <button >Confirm</button>
            </dialog>
            <dialog id="edit-savings-modal" className="profile-modal">
                <label id="edit-savings-label">hello</label>
                <input 
                id="edit-savings-input" 
                type="number" 
                placeholder="hello"
                ></input>
                <button value="cancel">Cancel</button>
                <button>Confirm</button>
            </dialog>
        </>
    );
}

if (document.getElementById('profile-savings')) {
    ReactDOM.render(<ProfileBudgets />, document.getElementById('profile-savings'));
}
