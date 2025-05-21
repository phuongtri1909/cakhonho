<!-- Chapter Purchase Modal -->
<div class="modal fade" id="chapterPurchaseModal" tabindex="-1" aria-labelledby="chapterPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chapterPurchaseModalLabel">Mua chương</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="purchase-info text-center mb-4">
                    <div class="chapter-info">
                        <h5 id="purchase-chapter-title"></h5>
                        <p class="text-muted">Để đọc chương này, bạn cần mua với giá <span id="purchase-chapter-price" class="fw-bold text-primary"></span> xu.</p>
                    </div>
                    <div class="user-balance mt-3 alert alert-info">
                        <i class="fas fa-coins me-2"></i> Số dư của bạn: <span id="user-balance" class="fw-bold"></span> xu
                    </div>
                    <div id="insufficient-balance" class="alert alert-warning d-none">
                        <i class="fas fa-exclamation-triangle me-2"></i> Bạn không đủ xu để mua chương này. Vui lòng nạp thêm.
                        <div class="mt-2">
                            <a href="{{ route('user.deposit') }}" class="btn btn-sm btn-warning">Nạp xu ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirm-purchase-btn">Xác nhận mua</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Variables to store current purchase information
    let currentChapterId = null;
    let currentChapterPrice = 0;
    let userCoins = {{ auth()->check() ? auth()->user()->coins : 0 }};
    
    // Function to open purchase modal
    function openPurchaseModal(chapterId, chapterTitle, chapterPrice) {
        currentChapterId = chapterId;
        currentChapterPrice = chapterPrice;
        
        // Update modal content
        document.getElementById('purchase-chapter-title').textContent = chapterTitle;
        document.getElementById('purchase-chapter-price').textContent = new Intl.NumberFormat().format(chapterPrice);
        document.getElementById('user-balance').textContent = new Intl.NumberFormat().format(userCoins);
        
        // Check if user has enough balance
        const insufficientBalance = document.getElementById('insufficient-balance');
        const confirmBtn = document.getElementById('confirm-purchase-btn');
        
        if (userCoins < chapterPrice) {
            insufficientBalance.classList.remove('d-none');
            confirmBtn.disabled = true;
        } else {
            insufficientBalance.classList.add('d-none');
            confirmBtn.disabled = false;
        }
        
        // Open the modal
        const purchaseModal = new bootstrap.Modal(document.getElementById('chapterPurchaseModal'));
        purchaseModal.show();
    }
    
    // Handle purchase confirmation
    document.getElementById('confirm-purchase-btn').addEventListener('click', function() {
        if (!currentChapterId) return;
        
        // Show loading state
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xử lý...';
        
        // Send purchase request
        fetch('{{ route("purchase.chapter") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                chapter_id: currentChapterId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success - update UI and balance
                userCoins = data.newBalance;
                
                // Show success message
                Swal.fire({
                    title: 'Thành công!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Đọc ngay'
                }).then(() => {
                    // Redirect to chapter page
                    window.location.reload();
                });
            } else {
                // Error
                Swal.fire({
                    title: 'Lỗi',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Lỗi',
                text: 'Có lỗi xảy ra khi xử lý giao dịch. Vui lòng thử lại.',
                icon: 'error',
                confirmButtonText: 'Đóng'
            });
        })
        .finally(() => {
            // Reset button state
            this.disabled = false;
            this.innerHTML = 'Xác nhận mua';
            
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('chapterPurchaseModal')).hide();
        });
    });
</script>
@endpush 