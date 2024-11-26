// Fetch cities and populate a dropdown
async function fetchAndPopulateCities(selectId) {
  try {
      const response = await fetch('php/get_cities.php'); // Update path if needed
      const cities = await response.json();

      // Check if the fetch was successful
      if (!Array.isArray(cities)) {
          console.error("Unexpected response format:", cities);
          return;
      }

      const select = document.getElementById(selectId);
      cities.forEach(city => {
          const option = document.createElement('option');
          option.value = city.city_name;
          option.textContent = city.city_name;
          select.appendChild(option);
      });
  } catch (error) {
      console.error("Error fetching cities:", error);
  }
}

// Call this function for both departure and destination dropdowns
document.addEventListener('DOMContentLoaded', () => {
  fetchAndPopulateCities('departureSelect');
  fetchAndPopulateCities('destinationSelect');
});
