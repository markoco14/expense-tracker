import React from 'react';
import ReactDOM from 'react-dom';

export default function ProfileSalary() {
    return (
        <h2>This is the Salary component</h2>
    );
}

if (document.getElementById('profile-salary')) {
    ReactDOM.render(<ProfileSalary />, document.getElementById('profile-salary'));
}
