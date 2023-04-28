var element = document.getElementsByClassName("notification")[0];
setTimeout(() => {
    element.classList.add("notification_hidden");
    setTimeout(() => element.remove(), 1000);
}, 2500);