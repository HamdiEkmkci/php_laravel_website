import './bootstrap';
import Pusher from 'pusher-js';

const pusher = new Pusher('YOUR_APP_KEY', {
    cluster: 'YOUR_APP_CLUSTER'
});

const channel = pusher.subscribe('chat-channel');

// Mesaj geldiğinde yapacakları belirtiyoruz
channel.bind('message-sent', function(data) {
    // Mesajı dinamik olarak ekle
    const messageBalloon = `
        <div class="message-balloon left-top">
            <div class="mini-message-content">
                <p>${data.message}</p>
            </div>
        </div>`;
    document.getElementById('messageMain').innerHTML += messageBalloon;
});

// Mesaj gönderme işlemi
document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const message = document.getElementById('message').value;

    // AJAX isteği ile mesajı sunucuya gönder
    axios.post('/send-message', {
        message: message,
        // Diğer gerekli verileri ekle (örn. alıcı ID'si, vb.)
    }).then(response => {
        document.getElementById('message').value = ''; // Mesajı temizle
        // Son mesajı güncelle
        document.querySelector('.mini-message-content p').textContent = message;
    }).catch(error => {
        console.error('Mesaj gönderme hatası:', error);
    });
});

