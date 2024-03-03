const hamburgerButton = document.querySelector('.hamburger-button');
const menuBar = document.querySelector('.menu-bar');
const menuBarXButton = document.querySelector('.menu-bar .x-button');
const menuBarActive = document.querySelector('.menu-bar .active');
const overlay = document.querySelector('.overlay');
const overlay2 = document.querySelector('.overlay2');
const deleteButton = document.querySelector('.delete-button');
const deletePopup = document.querySelector('.delete-popup');
const deletePopupNoButton = document.querySelector('.delete-popup .no')
const form = document.querySelector('.add-coin form');
const input = document.querySelectorAll('.add-coin input');
const deletePopupXButton = document.querySelector('.delete-popup .x-button');
const addButton = document.querySelector('.edit-buttons .add-button');
const deductButton = document.querySelector('.edit-buttons .deduct-button');
const updatePriceButton = document.querySelector('.edit-buttons .update-price-button');
const newBaseButton = document.querySelector('.edit-buttons .new-base-button');
const addPopup = document.querySelector('.add-popup');
const addPopupXButton = document.querySelector('.add-popup .x-button');
const deductPopup = document.querySelector('.deduct-popup');
const deductPopupXButton = document.querySelector('.deduct-popup .x-button');
const updatePricePopup = document.querySelector('.update-price-popup');
const updatePricePopupXButton = document.querySelector('.update-price-popup .x-button');
const newBasePopup = document.querySelector('.new-base-popup');
const newBasePopupXButton = document.querySelector('.new-base-popup .x-button');

function hamburgerClicked() {
    menuBar.classList.add('active');
    overlay.classList.add('active');
}
hamburgerButton.addEventListener("click", hamburgerClicked);

function menubarXButtonClicked() {
    menuBar.classList.remove('active');
    overlay.classList.remove('active');
}

menuBarXButton.addEventListener("click", menubarXButtonClicked);

function deleteButtonClicked() {
    deletePopup.classList.add('active');
    overlay2.classList.add('active');
}

function overlayClicked() {
    menuBar.classList.remove('active');
    overlay.classList.remove('active');
}

overlay.addEventListener("click", overlayClicked);

if (deleteButton) {
    deleteButton.addEventListener("click", deleteButtonClicked);
}

function deletePopupXButtonClicked() {
    deletePopup.classList.remove('active');
    overlay2.classList.remove('active');
}

if (deletePopupNoButton) {
    deletePopupNoButton.addEventListener("click", deletePopupXButtonClicked);
}

if (deletePopupXButton) {
    deletePopupXButton.addEventListener("click", deletePopupXButtonClicked);
}

function addButtonClicked() {
    addPopup.classList.add('active');
    overlay2.classList.add('active');
}

function addPopupXButtonClicked() {
    addPopup.classList.remove('active');
    overlay2.classList.remove('active');
}

if (addButton) {
    addButton.addEventListener("click", addButtonClicked )
}

if (addPopupXButton) {
    addPopupXButton.addEventListener("click", addPopupXButtonClicked);
}

function deductButtonClicked() {
    deductPopup.classList.add('active');
    overlay2.classList.add('active');
}

function deductPopupXButtonClicked() {
    deductPopup.classList.remove('active');
    overlay2.classList.remove('active');
}

if (deductButton) {
    deductButton.addEventListener("click", deductButtonClicked )
}

if (deductPopupXButton) {
    deductPopupXButton.addEventListener("click", deductPopupXButtonClicked);
}

function updatePriceButtonClicked() {
    updatePricePopup.classList.add('active');
    overlay2.classList.add('active');
}

function updatePricePopupXButtonClicked() {
    updatePricePopup.classList.remove('active');
    overlay2.classList.remove('active');
}

if (updatePriceButton) {
    updatePriceButton.addEventListener("click", updatePriceButtonClicked )
}

if (updatePricePopupXButton) {
    updatePricePopupXButton.addEventListener("click", updatePricePopupXButtonClicked);
}

function newBaseButtonClicked() {
    newBasePopup.classList.add('active');
    overlay2.classList.add('active');
}

function newBasePopupXButtonClicked() {
    newBasePopup.classList.remove('active');
    overlay2.classList.remove('active');
}

if (newBaseButton) {
    newBaseButton.addEventListener("click", newBaseButtonClicked )
}

if (newBasePopupXButton) {
    newBasePopupXButton.addEventListener("click", newBasePopupXButtonClicked);
}

function enterKeydown(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        form.submit();
    }
};

input.forEach(function(inputs) {
    inputs.addEventListener('keydown', enterKeydown);
});

