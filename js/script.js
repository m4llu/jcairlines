// Helper function to set input values
function saveInput(sourceId, targetId) {
  const sourceValue = document.getElementById(sourceId).value;
  document.getElementById(targetId).value = sourceValue;
  closePopup(sourceId + 'Popup');
}

// Save selected city to the respective input field
function saveCitySelection(selectId, inputId) {
  const selectedValue = document.getElementById(selectId).value;
  document.getElementById(inputId).value = selectedValue;
}

// Save selected date range to the date input field
function saveDate(startId, endId, targetId) {
  const startDate = document.getElementById(startId).value;
  const endDate = document.getElementById(endId).value;
  if (startDate && endDate) {
      document.getElementById(targetId).value = `${startDate} - ${endDate}`;
  }
  next('3');
}

// Increment or decrement passenger count
function updatePassengerCount(inputId, increment) {
  const inputElement = document.getElementById(inputId);
  let count = parseInt(inputElement.value, 10) || 0;
  count += increment ? 1 : (count > 0 ? -1 : 0);
  inputElement.value = count;
  updateTotalPassengers();
}

// Update the total number of passengers displayed
function updateTotalPassengers() {
  const total = 
      (parseInt(document.getElementById('adultCount').value, 10) || 0) +
      (parseInt(document.getElementById('child12to15Count').value, 10) || 0) +
      (parseInt(document.getElementById('child2to11Count').value, 10) || 0) +
      (parseInt(document.getElementById('infantCount').value, 10) || 0);
  document.getElementById('passengers').value = `${total} Matkustajaa`;
}

// Open a popup
function openPopup(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.add('active');
}

// Close a popup
function next(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.remove('active');
  openPopup(parseInt(popupId) + 1)
}

function closePopup(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.remove('active');
}

// Attach event listeners to form fields for opening popups
document.getElementById('departure').addEventListener('click', () => openPopup('1'));
document.getElementById('destination').addEventListener('click', () => openPopup('2'));
document.getElementById('date').addEventListener('click', () => openPopup('3'));
document.getElementById('passengers').addEventListener('click', () => openPopup('4'));

// Attach event listeners for passenger increment and decrement
document.querySelectorAll('.passenger-control button').forEach(button => {
  button.addEventListener('click', event => {
      const isIncrement = event.target.textContent === '+';
      const inputId = event.target.parentElement.querySelector('input').id;
      updatePassengerCount(inputId, isIncrement);
  });
});

// Implement the flight selection functionality
document.addEventListener("DOMContentLoaded", function() {
  // Add event listeners to all select flight buttons
  document.querySelectorAll('.select-flight').forEach(button => {
      button.addEventListener('click', function() {
          const flightId = this.getAttribute('data-flight-id'); // Get the flight ID from the button

          // Store the selected flight ID in the hidden input field
          document.getElementById('selectedFlightId').value = flightId;

          // Optionally, provide visual feedback to indicate the flight is selected
          // For example, add a class to mark the selected button
          document.querySelectorAll('.select-flight').forEach(b => b.classList.remove('selected'));
          this.classList.add('selected');
      });
  });
});
