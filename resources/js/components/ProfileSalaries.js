import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

export default function ProfileSalaries() {
    const [salaries, setSalaries] = useState([]);
    const [totalSalary, setTotalSalary] = useState(undefined);
    const [salaryId, setSalaryId] = useState(undefined);
    const [newSalaryName, setNewSalaryName] = useState(undefined);
    const [newSalaryAmount, setNewSalaryAmount] = useState(undefined);
    const [currentSalaryName, setCurrentSalaryName] = useState(undefined);
    const [currentSalaryAmount, setCurrentSalaryAmount] = useState(undefined);

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
            alert('You need to set a salary name and amount');
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
            setNewSalaryName(undefined);
            setNewSalaryAmount(undefined);
            addSalaryModal.close();
            
        }
    }

    const openEditModal = (salary) => {
        const editSalaryModal = document.getElementById('edit-salary-modal');
        setCurrentSalaryName(salary.salary_name);
        setCurrentSalaryAmount(salary.salary_amount);
        setSalaryId(salary.id);
        editSalaryModal.showModal();
    }

    const closeEditModal = () => {
        setSalaryId(undefined);
        setNewSalaryAmount(undefined);
        setNewSalaryName(undefined);
        const editSalaryModal = document.getElementById('edit-salary-modal');
        editSalaryModal.close();
    }

    const editSalary = async () => {
        if (!newSalaryAmount || !newSalaryName) {
            alert('You need to choose a salary name and amount');
        } else {
            const response = await fetch(`api/profile/salary/edit/${userid}/${salaryId}/${newSalaryName}/${newSalaryAmount}`, {
                method: 'POST',
                body: JSON.stringify({
                    id: salaryId,
                    name: newSalaryName,
                    amount: newSalaryAmount
                }),
                headers: {
                "Content-type": "application/json; charset=UTF-8"
                }
            });
            fetchData();
            setSalaryId(undefined);
            setNewSalaryAmount(undefined);
            setNewSalaryName(undefined);
            const editSalaryModal = document.getElementById('edit-salary-modal');
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
            <div id="income" className="profile-container">
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
                <div className="form-group">
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
                </div>
                <div className="form-group">
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
                </div>
                <div>
                    <button className="profile-modal-button" onClick={closeAddModal}>Cancel</button>
                    <button className="profile-modal-button profile-modal-confirm" onClick={addSalary}>Confirm</button>
                </div>
            </dialog>
            <dialog id="edit-salary-modal" className="profile-modal">
                <div className="form-group">
                    <label>Salary Name</label>
                    <input 
                        type="text" 
                        placeholder={currentSalaryName} 
                        onChange={(e) => {
                            setNewSalaryName(() => {
                                if (e.target.value === '') {
                                    return undefined;
                                }
                                return e.target.value;
                            });
                        }}
                        ></input>
                </div>
                <div className="form-group">
                    <label>Salary Amount</label>
                    <input
                        type="number"
                        placeholder={currentSalaryAmount}
                        onChange={(e) => {
                            setNewSalaryAmount(() => {
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
                    <button className="profile-modal-button profile-modal-confirm" onClick={editSalary} value="default">Confirm</button>
                </div>
            </dialog>
        </>
    );
}

if (document.getElementById('profile-salary')) {
    ReactDOM.render(<ProfileSalaries />, document.getElementById('profile-salary'));
}
