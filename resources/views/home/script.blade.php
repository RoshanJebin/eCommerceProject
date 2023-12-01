<script src="frontend/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="frontend/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="frontend/js/plugins.js"></script>
<script type="text/javascript" src="frontend/js/script.js"></script>
<script>
    function toggleWishlist(product_id) {
        // Make an AJAX request to the server to check and update the wishlist
        fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: product_id // Include the product ID in the payload
                })
            })
            .then(response => response.json())
            .then(data => {
                // Change color of the wishlist icon based on whether the item exists
                if (data.itemInWishlist) {
                    $('.no-wishlist-' + product_id).hide();
                    $('.wishlist-' + product_id).show();
                } else {
                    $('.no-wishlist-' + product_id).show();
                    $('.wishlist-' + product_id).hide();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
