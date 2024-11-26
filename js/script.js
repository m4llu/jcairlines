function saveCitySelection(selectId, inputId) {
    const selectElement = document.getElementById(selectId);
    const selectedValue = selectElement.value;
    document.getElementById(inputId).value = selectedValue;
}

function openPopup(popupId) {
  var popup = document.getElementById(popupId);
  popup.classList.add('active');
}

// Function to close a popup
function closePopup(popupId) {
  var popup = document.getElementById(popupId);
  popup.classList.remove('active');
}

function saveInput(sourceId, targetId) {
  const sourceValue = document.getElementById(sourceId).value;
  document.getElementById(targetId).value = sourceValue;
  closePopup(sourceId + 'Popup');
}

// Event listeners for opening popups
document.getElementById('departure').addEventListener('click', function () {
  openPopup('departurePopup');
});

document.getElementById('destination').addEventListener('click', function () {
  openPopup('destinationPopup');
});

document.getElementById('date').addEventListener('click', function () {
  openPopup('datePopup');
});

document.getElementById('passengers').addEventListener('click', function () {
  openPopup('passengerPopup');
});
