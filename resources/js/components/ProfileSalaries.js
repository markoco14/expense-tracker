import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileSalaries() {
    const [salaries, setSalaries] = useState([]);

    const fetchData = async () => {
        const response = await fetch(`api/profile/salary/${userid}`);
        const data = await response.json();
        setSalaries(data);
    };

    useEffect(() => {
        fetchData();
    }, []);

    const openAddModal = () => {
        const addSalaryModal = document.getElementById('add-salary-modal');
        addSalaryModal.showModal();
    }

    const closeAddModal = () => {
        const addSalaryModal = document.getElementById('add-salary-modal');
        addSalaryModal.close();
    }

    const addSalary = async () => {
        const addSalaryInput = document.getElementById('add-salary-input');
        const newSalary = addSalaryInput.value;
        if (!newSalary) {
            alert('You need to set a salary amount');
        } else {
            const response = await fetch(`api/profile/salary/create/${userid}/${newSalary}`, {
                method: 'POST',
                body: JSON.stringify({
                    label: 'Salary',
                    amount: newSalary
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            fetchData();
            const addSalaryModal = document.getElementById('add-salary-modal');
            addSalaryModal.close();
            
        }
    }

    const openEditModal = () => {
        const editSalaryModal = document.getElementById('edit-salary-modal');
        editSalaryModal.showModal();
    }

    const closeEditModal = () => {
        const editSalaryModal = document.getElementById('edit-salary-modal');
        editSalaryModal.close();
    }

    const editSalary = async () => {
        const editSalaryInput = document.getElementById('edit-salary-input');
        const newSalary = editSalaryInput.value;
        if (!newSalary) {
            alert('You need to choose a salary level');
        } else {
            const response = await fetch(`api/profile/salary/edit/${userid}/${newSalary}`, {
                method: 'POST',
                body: JSON.stringify({
                    label: 'Salary',
                    amount: newSalary
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            editSalaryInput.value = '';
            fetchData();
            const editSalaryModal = document.getElementById('edit-salary-modal');
            editSalaryModal.close();
        }
    }

    const deleteThisIncome = async () => {
        const response = await fetch(`api/profile/salary/delete/${userid}`, {
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
            <div className="profile-container">
                <h2>Income</h2>
                <p>Total: ${salaries[0]?.salary_amount}</p>
                <ul className="profile-info-list">
                    <li className="flex">
                        <div className="profile-info-name-amount">
                            <span>Salary</span>
                            <span>${salaries[0]?.salary_amount}</span>
                        </div>
                        <div>
                            <button 
                                onClick={openEditModal} 
                                className="edit-button"
                            >
                                Edit
                            </button>
                            <button 
                                onClick={deleteThisIncome} 
                                className="delete-button"
                            >
                                Delete
                            </button>
                        </div>
                    </li>
                </ul>
                <button onClick={openAddModal}>+ New</button>
            </div>
            <dialog id="add-salary-modal" className="profile-modal">
                <label>Salary</label>
                <input id="add-salary-input" type="number"></input>
                <button onClick={closeAddModal}>Cancel</button>
                <button onClick={addSalary}>Confirm</button>
            </dialog>
            <dialog id="edit-salary-modal" className="profile-modal">
                <label>Salary</label>
                <input id="edit-salary-input" type="number"></input>
                <button onClick={closeEditModal} value="cancel">Cancel</button>
                <button onClick={editSalary} value="default">Confirm</button>
            </dialog>
        </>
    );
}

if (document.getElementById('profile-salary')) {
    ReactDOM.render(<ProfileSalaries />, document.getElementById('profile-salary'));
}
