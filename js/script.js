let cities = []; // Global variable to store fetched cities

// Fetch cities and populate both dropdowns
async function fetchAndPopulateCities(selectId) {
  try {
    const response = await fetch('php/get_cities.php'); // Update path if needed
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    cities = await response.json();

    // Check response format
    if (!Array.isArray(cities)) {
      console.error("Unexpected response format:", cities);
      return;
    }

    // Populate both dropdowns initially
    populateDropdown(selectId);
  } catch (error) {
    console.error("Error fetching cities:", error);
  }
}

// Function to populate a dropdown with city options
function populateDropdown(selectId, excludeCity = "") {
  const select = document.getElementById(selectId);
  select.innerHTML = '<option value="">Valitse kaupunki</option>'; // Clear and add placeholder

  // Add cities to the dropdown, excluding the selected city
  cities.forEach(city => {
    if (city.city_name && city.city_name !== excludeCity) {
      const option = document.createElement('option');
      option.value = city.city_name;
      option.textContent = city.city_name;
      select.appendChild(option);
    }
  });
}

// Function to handle dropdown change and update the other dropdown
function handleCitySelection(changedSelectId, otherSelectId) {
  const changedSelect = document.getElementById(changedSelectId);
  const selectedCity = changedSelect.value;
  console.log(`Selected city in ${changedSelectId}:`, selectedCity);

  // Repopulate the other dropdown, excluding the selected city
  populateDropdown(otherSelectId, selectedCity);
}

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

// Close a popup and open the next one
function next(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.remove('active');
  openPopup(parseInt(popupId) + 1)
}

function closePopup(popupId) {
  const popup = document.getElementById(popupId);
  popup.classList.remove('active');
}

function redirectToBooking(flightId, flightClass) {
  const url = `php/book.php?selectedFlightId=${flightId}&selectedFlightClass=${flightClass}`;
  window.location.href = url;
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
  fetchAndPopulateCities('departureSelect');
  fetchAndPopulateCities('destinationSelect');

  // Add event listeners to both dropdowns
  document.getElementById('departureSelect').addEventListener('change', () => {
    handleCitySelection('departureSelect', 'destinationSelect');
  });

  document.getElementById('destinationSelect').addEventListener('change', () => {
    handleCitySelection('destinationSelect', 'departureSelect');
  });

  // Add event listeners to all select flight buttons


// Update the flight selection functionality to display the info section
document.querySelectorAll('.select-flight').forEach(button => {
  button.addEventListener('click', function() {
    const flightId = this.getAttribute('data-flight-id');
    const flightClass = this.getAttribute('data-flight-class');
    const businessPerks = document.getElementById('businessPerks');
    document.getElementById('selectedFlightId').value = flightId;
    document.getElementById('selectedFlightClass').value = flightClass;
    document.querySelectorAll('.flight-result').forEach(b => b.getAttribute('data-flight-id') === flightId ? b.classList.add('selected') : b.classList.remove('selected'));
    document.querySelectorAll('.select-flight').forEach(b => b.classList.remove('selected'));
    flightClass === 'business' && flightId === document.getElementById('selectedFlightId').value ? businessPerks.style.display = 'block' : businessPerks.style.display = 'none';
    this.classList.add('selected');
  });
});
});