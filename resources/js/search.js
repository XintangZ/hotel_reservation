document.addEventListener("DOMContentLoaded", () => {
    const checkInDateInput = document.querySelector("#check_in_date");
    const checkOutDateInput = document.querySelector("#check_out_date");
    const guestNumberInput = document.querySelector("#number_of_guests");
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
    if (numberOfNightsEl) {
        numberOfNightsEl.textContent = calculateNumberOfNights(
            checkInDateInput.value,
            checkOutDateInput.value
        );
    }

    const reservationForm = document.querySelector("#reservation-form");
    const roomTd = document.querySelector("#confirm-room");
    const checkInDateTd = document.querySelector("#confirm-check-in");
    const checkOutDateTd = document.querySelector("#confirm-check-out");
    const guestCountTd = document.querySelector("#confirm-guest-count");
    const bookingBtns = document.querySelectorAll(
        "button[data-modal-toggle='confirm-modal']"
    );
    bookingBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            roomTd.textContent = e.target.dataset.room;
            guestCountTd.textContent = document.querySelector(
                "#selected-guest-count"
            ).textContent;
            checkInDateTd.textContent = document.querySelector(
                "#selected-check-in-date"
            ).textContent;
            checkOutDateTd.textContent = document.querySelector(
                "#selected-check-out-date"
            ).textContent;
        });
    });
});

function calculateNumberOfNights(checkInDate, checkOutDate) {
    checkInDate = new Date(checkInDate);
    checkOutDate = new Date(checkOutDate);

    const differenceMs = checkOutDate.getTime() - checkInDate.getTime();
    const numberOfNights = Math.round(differenceMs / (1000 * 60 * 60 * 24));

    return `(${numberOfNights} ${numberOfNights === 1 ? "night" : "nights"})`;
}
