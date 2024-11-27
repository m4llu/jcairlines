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
  closePopup('departurePopup'); // Close popup after selection
}

// Save selected date range to the date input field
function saveDate(startId, endId, targetId) {
  const startDate = document.getElementById(startId).value;
  const endDate = document.getElementById(endId).value;
  if (startDate && endDate) {
      document.getElementById(targetId).value = `${startDate} - ${endDate}`;
  }
  closePopup('datePopup');
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
function closePopup(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.remove('active');
}

// Attach event listeners to form fields for opening popups
document.getElementById('departure').addEventListener('click', () => openPopup('departurePopup'));
document.getElementById('destination').addEventListener('click', () => openPopup('destinationPopup'));
document.getElementById('date').addEventListener('click', () => openPopup('datePopup'));
document.getElementById('passengers').addEventListener('click', () => openPopup('passengerPopup'));

// Attach event listeners for passenger increment and decrement
document.querySelectorAll('.passenger-control button').forEach(button => {
  button.addEventListener('click', event => {
      const isIncrement = event.target.textContent === '+';
      const inputId = event.target.parentElement.querySelector('input').id;
      updatePassengerCount(inputId, isIncrement);
  });
});
