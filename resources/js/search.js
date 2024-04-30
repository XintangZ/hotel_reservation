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

    const reservationForm = document.querySelector("#reservation-form");
    if (reservationForm) {
        const roomRadioInputs = reservationForm.querySelectorAll(
            "input[name=room_id]"
        );

        const numberOfNights = calculateNumberOfNights(
            checkInDateInput.value,
            checkOutDateInput.value
        );
        document.querySelector("#nights").textContent = `(${numberOfNights} ${
            numberOfNights === 1 ? "night" : "nights"
        })`;

        roomRadioInputs.forEach((input) => {
            if (input.checked) {
                enableBookingBtn(input);
                populateConfirmModal(input, numberOfNights);
            }
        });

        roomRadioInputs.forEach((input) => {
            input.addEventListener("change", () => {
                enableBookingBtn(input);
                populateConfirmModal(input, numberOfNights);
            });
        });
    }
});

function calculateNumberOfNights(checkInDate, checkOutDate) {
    checkInDate = new Date(checkInDate);
    checkOutDate = new Date(checkOutDate);

    const differenceMs = checkOutDate.getTime() - checkInDate.getTime();
    const numberOfNights = Math.round(differenceMs / (1000 * 60 * 60 * 24));

    return numberOfNights;
}

function enableBookingBtn(roomInput) {
    const bookingBtn = document.querySelector("#booking-btn");

    bookingBtn.disabled = false;
    bookingBtn.innerHTML = `${roomInput.dataset.type} - #${roomInput.value}<br>Book Now`;
}

function populateConfirmModal(roomInput, numberOfNights) {
    let totalPrice = numberOfNights * parseFloat(roomInput.dataset.price);

    document.querySelector(
        "#confirm-room"
    ).textContent = `${roomInput.dataset.type} - #${roomInput.value}`;
    document.querySelector("#confirm-guest-count").textContent =
        document.querySelector("#selected-guest-count").textContent;
    document.querySelector("#confirm-check-in").textContent =
        document.querySelector("#selected-check-in-date").textContent;
    document.querySelector("#confirm-check-out").textContent =
        document.querySelector("#selected-check-out-date").textContent;
    document.querySelector(
        "#confirm-nights"
    ).textContent = `${numberOfNights} ${
        numberOfNights === 1 ? "night" : "nights"
    }`;
    document.querySelector(
        "#confirm-price"
    ).textContent = `C$${roomInput.dataset.price}/night`;
    document.querySelector(
        "#confirm-total"
    ).textContent = `C$${totalPrice.toFixed(2)}`;
}
