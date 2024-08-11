function submitForm() {
    // Get form values
   // const username = document.getElementById('username').value;
    const amount = document.getElementById('amount').value;
    const ngo_id = document.getElementById('ngo_id').value;
    const branch_id = document.getElementById('branchId').value;

    // Check if any field is empty
    if (/*!username  || */ !amount || !ngo_id || !branch_id) {
        document.getElementById('errorMessage').style.display = 'block';
        return;
    }

    // Hide error message if all fields are filled
    document.getElementById('errorMessage').style.display = 'none';

    // Prepare form data
    const formData = new FormData();
   // formData.append('username', username);
    formData.append('amount', amount);
    formData.append('ngo_id', ngo_id);
    formData.append('branchId', branch_id);

    // Send form data using AJAX
    fetch('donations.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('volunteerForm').reset();
            document.getElementById('branchId').value = ''; // Reset branch ID input
            document.getElementById('branchId').disabled = true; // Disable branch ID input
            document.getElementById('submitBtn').disabled = true; // Disable submit button
        } else {
            throw new Error('Failed to record donation. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('successMessage').style.display = 'none';
        alert('An error occurred. Please try again.');
    });
}

// Other functions remain unchanged...

function displayNGOs() {
    const ngoDetails = {
        '100': 'Save Green',
        '101': 'Cupa Bangalore',
        '102': 'NMGCT',
        '103': 'VTVO'
    };
    let ngoHtml = 'NGOs and IDs:<br>';
    Object.keys(ngoDetails).forEach(ngoId => {
        ngoHtml += `NGO ID: ${ngoId}, Name: ${ngoDetails[ngoId]}<br>`;
    });
    document.getElementById('ngoDetails').innerHTML = ngoHtml;
    document.getElementById('branchButton').disabled = false;
}

function displayBranchIds() {
    const ngoId = document.getElementById('ngo_id').value;
    const branchDetails = getBranchDetails(ngoId);
    let branchIdsHtml = `Branch IDs and Cities for NGO ${ngoId}:<br>`;
    Object.keys(branchDetails).forEach(branchId => {
        branchIdsHtml += `Branch ID: ${branchId}, City: ${branchDetails[branchId]}<br>`;
    });
    document.getElementById('branchId').disabled = false;
    document.getElementById('branchId').placeholder = "Enter Branch ID for " + ngoId;
    document.getElementById('branchCity').innerHTML = branchIdsHtml;
    document.getElementById('submitBtn').disabled = false; // Enable submit button
}

function getBranchDetails(ngoId) {
    const branchDetailsMap = {
        '100': {
            '134': 'Bangalore',
            '3099': 'Mumbai'
        },
        '101': {
            '23': 'Bangalore'
        },
        '102': {
            '345': 'Bangalore'
        },
        '103': {
            '297': 'Bangalore'
        }
    };

    const branchDetails = branchDetailsMap[ngoId];
    if (!branchDetails) {
        console.error('Invalid NGO ID:', ngoId);
        return {};
    }

    return branchDetails;
}

window.onload = function() {
    const sessionUsername = document.getElementById('sessionUsername').value;
    document.getElementById('username').value = sessionUsername;
};
