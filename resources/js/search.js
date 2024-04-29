document.addEventListener("DOMContentLoaded", () => {
    const checkInDateInput = document.querySelector("#check_in_date");
    const checkOutDateInput = document.querySelector("#check_out_date");
    checkInDateInput.addEventListener("change", (e) => {
        const checkOutDate = new Date(e.target.value);
        checkOutDate.setDate(checkOutDate.getDate() + 1);
        const checkOutDateStr = checkOutDate.toISOString().split("T")[0];

        checkOutDateInput.min = checkOutDateStr;
        if (checkOutDateInput.value < e.target.value) {
            checkOutDateInput.value = checkOutDateStr;
        }
    });

    const numberOfNightsEl = document.querySelector("#nights");
    const numberOfNights = calculateNumberOfNights(
        checkInDateInput.value,
        checkOutDateInput.value
    );
    if (numberOfNightsEl) {
        numberOfNightsEl.textContent = `(${numberOfNights} ${
            numberOfNights === 1 ? "night" : "nights"
        })`;
    }

    const reservationForm = document.querySelector("#reservation-form");
    const roomTd = document.querySelector("#confirm-room");
    const checkInDateTd = document.querySelector("#confirm-check-in");
    const checkOutDateTd = document.querySelector("#confirm-check-out");
    const guestCountTd = document.querySelector("#confirm-guest-count");
    const totalPriceTd = document.querySelector("#confirm-total");
    const bookingBtns = document.querySelectorAll(
        "button[data-modal-toggle='confirm-modal']"
    );
    bookingBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const formData = Object.fromEntries(new FormData(reservationForm));
            roomTd.textContent = `#${formData["room_id"]}`; // TODO: handle undefined room id
            guestCountTd.textContent = document.querySelector(
                "#selected-guest-count"
            ).textContent;
            checkInDateTd.textContent = document.querySelector(
                "#selected-check-in-date"
            ).textContent;
            checkOutDateTd.textContent = document.querySelector(
                "#selected-check-out-date"
            ).textContent;
            const totalPrice =
                numberOfNights * parseFloat(e.target.dataset.price);
            totalPriceTd.textContent = `C$${totalPrice.toFixed(2)}`;
        });
    });
});

function calculateNumberOfNights(checkInDate, checkOutDate) {
    checkInDate = new Date(checkInDate);
    checkOutDate = new Date(checkOutDate);

    const differenceMs = checkOutDate.getTime() - checkInDate.getTime();
    const numberOfNights = Math.round(differenceMs / (1000 * 60 * 60 * 24));

    return numberOfNights;
}
