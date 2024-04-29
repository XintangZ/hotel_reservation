import "./search-form";

const numberOfNightsEl = document.querySelector("#nights");

const reservationForm = document.querySelector("#reservation-form");
const bookingBtn = document.querySelector("#booking-btn");
const roomRadioInputs = reservationForm.querySelectorAll("input[name=room_id]");

const checkInDateTd = document.querySelector("#confirm-check-in");
const checkOutDateTd = document.querySelector("#confirm-check-out");
const guestCountTd = document.querySelector("#confirm-guest-count");
const roomTd = document.querySelector("#confirm-room");
const pricePerNightTd = document.querySelector("#confirm-price");
const numberOfNightsTd = document.querySelector("#confirm-nights");
const totalPriceTd = document.querySelector("#confirm-total");

checkInDateInput.addEventListener("change", (e) => {
    const checkOutDate = new Date(e.target.value);
    checkOutDate.setDate(checkOutDate.getDate() + 1);
    const checkOutDateStr = checkOutDate.toISOString().split("T")[0];

    checkOutDateInput.min = checkOutDateStr;
    if (checkOutDateInput.value < e.target.value) {
        checkOutDateInput.value = checkOutDateStr;
    }
});

const numberOfNights = calculateNumberOfNights(
    checkInDateInput.value,
    checkOutDateInput.value
);
if (numberOfNightsEl) {
    numberOfNightsEl.textContent = `(${numberOfNights} ${
        numberOfNights === 1 ? "night" : "nights"
    })`;
}

roomRadioInputs.forEach((input) => {
    input.addEventListener("change", () => {
        bookingBtn.disabled = false;
        bookingBtn.textContent = "Book Now";

        const totalPrice = numberOfNights * parseFloat(input.dataset.price);

        roomTd.textContent = `${input.dataset.type} - #${input.value}`;
        guestCountTd.textContent = document.querySelector(
            "#selected-guest-count"
        ).textContent;
        checkInDateTd.textContent = document.querySelector(
            "#selected-check-in-date"
        ).textContent;
        checkOutDateTd.textContent = document.querySelector(
            "#selected-check-out-date"
        ).textContent;
        numberOfNightsTd.textContent = `${numberOfNights} ${
            numberOfNights === 1 ? "night" : "nights"
        }`;
        pricePerNightTd.textContent = `C$${input.dataset.price}/night`;
        totalPriceTd.textContent = `C$${totalPrice.toFixed(2)}`;
    });
});
