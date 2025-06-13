document.getElementById('view-cart').addEventListener('click', function() {
    fetch('get_cart.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Giriş yapmanız gerekiyor');
            }
            return response.json();
        })
        .then(data => {
            const container = document.getElementById('cart-container');
            container.innerHTML = '';
            
            if (data.length === 0) {
                container.innerHTML = '<p class="text-center">Sepetiniz boş.</p>';
            } else {
                const list = document.createElement('ul');
                list.className = 'list-group mb-3';
                
                let total = 0;
                data.forEach((item, index) => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                    li.innerHTML = `
                        <span>${item.movie_name}</span>
                        <div>
                            <span class="badge bg-primary rounded-pill me-2">${item.price} TL</span>
                            <button class="btn btn-danger btn-sm remove-from-cart me-1" data-index="${index}">Sil</button>
                            <button class="btn btn-info btn-sm update-cart" data-index="${index}" data-name="${item.movie_name}" data-price="${item.price}">Güncelle</button>
                        </div>
                    `;
                    total += parseInt(item.price);
                    list.appendChild(li);
                });
                
                container.appendChild(list);
                
                const totalEl = document.createElement('div');
                totalEl.className = 'd-flex justify-content-between fw-bold fs-5';
                totalEl.innerHTML = `
                    <span>Toplam:</span>
                    <span>${total} TL</span>
                `;
                container.appendChild(totalEl);

                // Sil butonlarına olay dinleyici ekle
                document.querySelectorAll('.remove-from-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.dataset.index;
                        const listItem = this.closest('li');

                        fetch('remove_from_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `index=${encodeURIComponent(index)}`
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result.trim() === 'success') {
                                listItem.remove();
                                total -= parseInt(data[index].price);
                                if (total < 0) total = 0;
                                totalEl.innerHTML = `<span>Toplam:</span><span>${total} TL</span>`;
                                if (list.children.length === 0) {
                                    container.innerHTML = '<p class="text-center">Sepetiniz boş.</p>';
                                }
                                const toast = document.getElementById('liveToast');
                                const toastBody = toast.querySelector('.toast-body');
                                toastBody.textContent = 'Film sepetten kaldırıldı!';
                                const bsToast = new bootstrap.Toast(toast);
                                bsToast.show();
                            } else if (result.trim() === 'not_logged_in') {
                                const toast = document.getElementById('liveToast');
                                const toastBody = toast.querySelector('.toast-body');
                                toastBody.textContent = 'Lütfen önce giriş yapın!';
                                const bsToast = new bootstrap.Toast(toast);
                                bsToast.show();
                                window.location.href = 'login.php';
                            } else {
                                const toast = document.getElementById('liveToast');
                                const toastBody = toast.querySelector('.toast-body');
                                toastBody.textContent = 'Film sepetten kaldırılamadı!';
                                const bsToast = new bootstrap.Toast(toast);
                                bsToast.show();
                                console.error(result);
                            }
                        })
                        .catch(error => {
                            const toast = document.getElementById('liveToast');
                            const toastBody = toast.querySelector('.toast-body');
                            toastBody.textContent = 'Bir hata oluştu.';
                            const bsToast = new bootstrap.Toast(toast);
                            bsToast.show();
                            console.error('Hata:', error);
                        });
                    });
                });

                // Güncelle butonlarına olay dinleyici ekle
                document.querySelectorAll('.update-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.dataset.index;
                        const currentName = this.dataset.name;
                        const currentPrice = this.dataset.price;

                        // Güncelleme formunu oluştur (sadece isim)
                        const form = document.createElement('form');
                        form.className = 'mt-2 update-form';
                        form.innerHTML = `
                            <div class="mb-2">
                                <input type="text" class="form-control" value="${currentName}" id="update-name-${index}" placeholder="Film Adı">
                            </div>
                            <button type="button" class="btn btn-primary btn-sm save-update" data-index="${index}" data-price="${currentPrice}">Kaydet</button>
                            <button type="button" class="btn btn-secondary btn-sm cancel-update">İptal</button>
                        `;

                        const li = this.closest('li');
                        li.appendChild(form);

                        // Kaydet butonuna olay dinleyici
                        document.querySelector(`.save-update[data-index="${index}"]`).addEventListener('click', function() {
                            const newName = document.getElementById(`update-name-${index}`).value;
                            const currentPrice = this.dataset.price; // Fiyat sabit kalacak

                            fetch('update_cart.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `index=${encodeURIComponent(index)}&movie_name=${encodeURIComponent(newName)}&price=${encodeURIComponent(currentPrice)}`
                            })
                            .then(response => response.text())
                            .then(result => {
                                if (result.trim() === 'success') {
                                    data[index].movie_name = newName;
                                    li.querySelector('span').textContent = newName;
                                    form.remove();
                                    const toast = document.getElementById('liveToast');
                                    const toastBody = toast.querySelector('.toast-body');
                                    toastBody.textContent = 'Film güncellendi!';
                                    const bsToast = new bootstrap.Toast(toast);
                                    bsToast.show();
                                } else if (result.trim() === 'not_logged_in') {
                                    const toast = document.getElementById('liveToast');
                                    const toastBody = toast.querySelector('.toast-body');
                                    toastBody.textContent = 'Lütfen önce giriş yapın!';
                                    const bsToast = new bootstrap.Toast(toast);
                                    bsToast.show();
                                    window.location.href = 'login.php';
                                } else {
                                    const toast = document.getElementById('liveToast');
                                    const toastBody = toast.querySelector('.toast-body');
                                    toastBody.textContent = 'Film güncellenemedi!';
                                    const bsToast = new bootstrap.Toast(toast);
                                    bsToast.show();
                                    console.error(result);
                                }
                            })
                            .catch(error => {
                                const toast = document.getElementById('liveToast');
                                const toastBody = toast.querySelector('.toast-body');
                                toastBody.textContent = 'Bir hata oluştu.';
                                const bsToast = new bootstrap.Toast(toast);
                                bsToast.show();
                                console.error('Hata:', error);
                            });
                        });

                        // İptal butonuna olay dinleyici
                        document.querySelector(`.cancel-update`).addEventListener('click', function() {
                            form.remove();
                        });
                    });
                });
            }
            
            // Modalı göster
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'), { backdrop: 'static' });
            cartModal.show();
        })
        .catch(error => {
            const toast = document.getElementById('liveToast');
            const toastBody = toast.querySelector('.toast-body');
            toastBody.textContent = error.message;
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            if (error.message.includes('Giriş')) {
                window.location.href = 'login.php';
            }
        });
});