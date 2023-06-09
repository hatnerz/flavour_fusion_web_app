<section class="contact">
    <div class="container">
        <div class="post__inner container__inner_shadow">
            <div class="about__us">
                <h2>Про нас</h2>
                <p>Ми — команда кулінарів, що пропонує найкращі рецепти та поради з готування. У нас ви знайдете різноманітні страви, кулінарні ідеї та натхнення для творчості на кухні. Приєднуйтесь до нас і разом створимо смачні кулінарні шедеври!</p>
            </div>
            <div class="text-cont-inf">
                Контактна інформація
            </div>
            <div class="contact__info">
                <div class="contact__item">
                    <div class="img1">
                        <img src="media/phone.png" alt="Email Icon">
                    </div>
                    <h3>Телефон</h3>
                    <p><i class="fa fa-phone"></i> +1 123-456-7890</p>
                </div>
                <div class="contact__item">
                    <div class="img2">
                        <img src="media/imgwing.png" alt="Email Icon">
                    </div>
                    <h3>Електронна пошта</h3>
                    <p><i class="fa fa-envelope"></i> info@example.com</p>
                </div>
                <div class="contact__item">
                    <div class="img3">
                        <img src="media/imglocal.png" alt="Email Icon">
                    </div>
                    <h3>Адреса</h3>
                    <p><i class="fa fa-map-marker"></i> проспект Науки, 14, Харків</p>
                </div>
            </div>
            <div class="mainbutton">
                <div class="buttonPhone">
                    <button onclick="openPhoneInput()">Зателефонувати нам</button>
                </div>
                <div class="buttonEmail">
                    <button onclick="openGmail()">Перейти в Gmail</button>
                </div>
                <div class="buttonAdress">
                    <button onclick="openGoogleMaps()">Перейти на Google Maps</button>
                </div>
            </div>
            <div id="phoneInputContainer" class="phoneInputContainer" style="display: none;">
        <div class="phoneInputBox">
            <p>Напишіть ваш номер телефону, і наш спеціаліст зв'яжеться з вами:</p>
            <input type="text" id="phoneInput" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <button class="closeButton" onclick="closePhoneInput()">✖</button>
            <button class="sendButton" onclick="callSpecialist()">Відправити</button>
        </div>
    </div>
            <div id="messageBox" class="messageBox" style="display: none;"></div>
        </div>
    </div>
</section>

<script>
    function openGoogleMaps() {
        var address = 'проспект Науки, 14, Харків';
        var formattedAddress = encodeURIComponent(address);
        var googleMapsUrl = 'https://www.google.com/maps/search/?api=1&query=' + formattedAddress;
        window.open(googleMapsUrl, "_blank");
    }
    function openGmail() {
    var recipientEmail = 'info@example.com';
    var subject = ''; 
    var body = ''; 
    var gmailComposeUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' + recipientEmail + '&su=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
    window.open(gmailComposeUrl, "_blank");
}


function closePhoneInput() {
    document.getElementById('phoneInputContainer').style.display = 'none';
}
    function openPhoneInput() {
        document.getElementById('phoneInputContainer').style.display = 'block';

    }

    function callSpecialist() {
    var phoneNumber = document.getElementById('phoneInput').value;
    var messageBox = document.getElementById('messageBox');
    
    if (phoneNumber === '') {
        messageBox.style.display = 'block';
        messageBox.textContent = 'Ви не ввели номер телефону. Будь ласка, введіть номер, щоб наш спеціаліст міг з вами зв\'язатися.';
        setTimeout(function () {
            messageBox.style.display = 'none';
        },1700);
        return; 
    }
    
    messageBox.style.display = 'block';
    messageBox.textContent = 'Номер ' + phoneNumber + ' надіслано. Наш спеціаліст зв\'яжеться з вами найближчим часом.';
    document.getElementById('phoneInput').value = '';
    document.getElementById('phoneInputContainer').style.display = 'none';
    setTimeout(function () {
        messageBox.style.display = 'none';
    }, 1700);
}

</script>
