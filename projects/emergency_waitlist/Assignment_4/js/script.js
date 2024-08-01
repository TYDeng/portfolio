function fetchPatients() {
    fetch('../get_patients.php')
    .then(response => response.json())
    .then(data => {
        const list = document.getElementById('patientList');
        list.innerHTML = '';
        const role = document.getElementById('userRole').value; // Get the user role

        data.forEach(patient => {
            const div = document.createElement('div');
            div.textContent = `Patient Name: ${patient.name}, Severity: ${patient.severity}, Wait Time: ${patient.queue_time} minutes`;
            
            if (role === 'admin') {
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.onclick = () => removePatient(patient.id);
                div.appendChild(removeButton);
            }

            list.appendChild(div);
        });
    });
}

function removePatient(id) {
    fetch('php/remove_patient.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    }).then(() => fetchPatients()); // Refresh the patient list
}

document.addEventListener('DOMContentLoaded', fetchPatients);

