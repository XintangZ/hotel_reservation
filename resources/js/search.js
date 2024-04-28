document.addEventListener("DOMContentLoaded", () => {
    const checkInDateInput = document.querySelector("#check_in_date");
    const checkOutDateInput = document.querySelector("#check_out_date");
    const guestNumberInput = document.querySelector("#number_of_guests");
    const numberOfNightsEl = document.querySelector("#nights");

    if (numberOfNightsEl) {
        numberOfNightsEl.textContent = calculateNumberOfNights(
            checkInDateInput.value,
            checkOutDateInput.value
        );
    }

    checkInDateInput.addEventListener("change", (e) => {
        const checkOutDate = new Date(e.target.value);
        checkOutDate.setDate(checkOutDate.getDate() + 1);
        const checkOutDateStr = checkOutDate.toISOString().split("T")[0];

        checkOutDateInput.min = checkOutDateStr;
        if (checkOutDateInput.value < e.target.value) {
            checkOutDateInput.value = checkOutDateStr;
        }
    });
});

function calculateNumberOfNights(checkInDate, checkOutDate) {
    checkInDate = new Date(checkInDate);
    checkOutDate = new Date(checkOutDate);

    const differenceMs = checkOutDate.getTime() - checkInDate.getTime();
    const numberOfNights = Math.round(differenceMs / (1000 * 60 * 60 * 24));

    return `(${numberOfNights} ${numberOfNights === 1 ? "night" : "nights"})`;
}
