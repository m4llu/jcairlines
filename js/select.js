


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

// Call the function for both dropdowns when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  fetchAndPopulateCities('departureSelect');
  fetchAndPopulateCities('destinationSelect');

  // Add event listeners to both dropdowns
  document.getElementById('departureSelect').addEventListener('change', () => {
    handleCitySelection('departureSelect', 'destinationSelect');
  });

  document.getElementById('destinationSelect').addEventListener('change', () => {
    handleCitySelection('destinationSelect', 'departureSelect');
  });
});
