document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const movieName = this.dataset.name;
        const moviePrice = this.dataset.price;
        console.log('Adding:', movieName, moviePrice);

        fetch('add_movie.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `movie_name=${encodeURIComponent(movieName)}&price=${encodeURIComponent(moviePrice)}`
        })
        .then(response => response.text())
        .then(result => {
            console.log('Result:', result);
            const toast = document.getElementById('liveToast');
            const toastBody = toast?.querySelector('.toast-body');

            if (!toast || !toastBody) {
                console.error('Toast öğesi bulunamadı.');
                return;
            }

            if (result.trim() === 'success') {
                toastBody.textContent = `${movieName} sepete eklendi!`;
                new bootstrap.Toast(toast).show();
            } else if (result.trim() === 'not_logged_in') {
                toastBody.textContent = 'Lütfen önce giriş yapın!';
                new bootstrap.Toast(toast).show();
                // Toast gösterildikten sonra yönlendir, biraz gecikmeli
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            } else {
                toastBody.textContent = 'Film sepete eklenemedi!';
                new bootstrap.Toast(toast).show();
                console.error('Sunucu cevabı:', result);
            }
        })
        .catch(error => {
            console.error('Hata:', error);
            const toast = document.getElementById('liveToast');
            const toastBody = toast?.querySelector('.toast-body');
            if (toast && toastBody) {
                toastBody.textContent = 'Bir hata oluştu.';
                new bootstrap.Toast(toast).show();
            }
        });
    });
});
