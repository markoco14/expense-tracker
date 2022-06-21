import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileSalaries() {
    const [salaries, setSalaries] = useState([]);
    const [totalSalary, setTotalSalary] = useState(undefined);
    const [salaryId, setSalaryId] = useState(undefined);
    const [newSalaryName, setNewSalaryName] = useState(undefined);
    const [newSalaryAmount, setNewSalaryAmount] = useState(undefined);

    function calculateTotalSalary(salaries) {
        let total = 0;
        salaries?.forEach(salary => {
            total += salary.salary_amount;
        })
        setTotalSalary(total);
    }
    const fetchData = async () => {
        const response = await fetch(`api/profile/salary/${userid}`);
        const data = await response.json();
        console.log(data);
        setSalaries(data);
        calculateTotalSalary(data);
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
        // const addSalaryInput = document.getElementById('add-salary-input');
        // const newSalary = addSalaryInput.value;
        if (!newSalaryAmount || !newSalaryName) {
            alert('You need to set a salary amount');
        } else {
            const response = await fetch(`api/profile/salary/create/${userid}/${newSalaryName}/${newSalaryAmount}`, {
                method: 'POST',
                body: JSON.stringify({
                    name: newSalaryName,
                    amount: newSalaryAmount
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

    const openEditModal = (salary) => {
        const editSalaryModal = document.getElementById('edit-salary-modal');
        setSalaryId(salary.id);
        editSalaryModal.showModal();
    }

    const closeEditModal = () => {
        const editSalaryModal = document.getElementById('edit-salary-modal');
        setSalaryId(undefined);
        editSalaryModal.close();
    }

    const editSalary = async () => {
        const editSalaryInput = document.getElementById('edit-salary-input');
        const newSalary = editSalaryInput.value;
        if (!newSalary) {
            alert('You need to choose a salary level');
        } else {
            const response = await fetch(`api/profile/salary/edit/${userid}/${salaryId}/${newSalary}`, {
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
            setSalaryId(undefined);
            editSalaryModal.close();
        }
    }

    const deleteThisIncome = async (salary) => {
        const response = await fetch(`api/profile/salary/delete/${userid}/${salary.id}`, {
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
                <p>Total: {totalSalary? `$${totalSalary}` : `$0`}</p>
                <ul className="profile-info-list">
                    {salaries?.map((salary, index) => {
                        return (
                            
                        <li key={index} className="flex">
                            <div className="profile-info-name-amount">
                                <span>{salary.salary_name}</span>
                                <span>${salary.salary_amount}</span>
                            </div>
                            <div>
                                <button 
                                    onClick={() => {openEditModal(salary)}} 
                                    className="edit-button"
                                >
                                    Edit
                                </button>
                                <button 
                                    onClick={() => {deleteThisIncome(salary)}} 
                                    className="delete-button"
                                >
                                    Delete
                                </button>
                            </div>
                        </li>
                        );
                    })}
                </ul>
                <button onClick={openAddModal}>+ New</button>
            </div>
            <dialog id="add-salary-modal" className="profile-modal">

                <label>Salary Name</label>
                <input 
                    id="add-salary-name-input" 
                    type="text"
                    onChange={(e) => {
                        setNewSalaryName(() => {
                            if (e.target.value === '') {
                                return undefined;
                            }
                            return e.target.value;
                        });
                    }}
                ></input>
                <label>Salary Amount</label>
                <input 
                    id="add-salary-amount-input" 
                    type="number"
                    onChange={(e) => {
                        setNewSalaryAmount(() => {
                            if (e.target.value === '') {
                                return undefined;
                            }
                            return e.target.value;
                        });
                    }}
                ></input>
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
