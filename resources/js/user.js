document.addEventListener("DOMContentLoaded", () => {
    const phoneInput = document.getElementById("phone");

    if (phoneInput) {
        phoneInput.addEventListener("keyup", function (event) {
            const phoneNumber = event.target.value.replace(/\D/g, "");

            if (phoneNumber.length > 3) {
                event.target.value = phoneNumber.replace(
                    /(\d{3})(\d{3})(\d{4})/,
                    "($1) $2-$3"
                );
            } else {
                event.target.value = phoneNumber;
            }
        });
    }
});
