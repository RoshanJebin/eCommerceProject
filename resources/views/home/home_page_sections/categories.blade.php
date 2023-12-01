@if ($categories)
    @foreach ($categories as $key => $category)
        <section id="{{ $category->id }}"
            class="product-store position-relative padding-large {{ $key == 0 ? 'no-padding-top' : '' }}">
            <div class="container">
                <div class="row">
                    <div class="display-header d-flex justify-content-between pb-3">
                        <h2 class="display-7 text-dark text-uppercase">{{ $category->name }}</h2>
                        <div class="btn-right">
                            <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                        </div>
                    </div>
                    <div class="swiper product-swiper">
                        <div class="swiper-wrapper">
                            @if ($category->products)
                                @foreach ($category->products as $product)
                                    <div class="swiper-slide">
                                        <div class="product-card position-relative">
                                            <div class="image-holder">
                                                <img src="{{ asset('storage/images/product/' . $product->image) }}"
                                                    alt="product-item" class="img-fluid">
                                            </div>
                                            <div class="wishlist-concern position-absolute">
                                                <div class="wishlist-button d-flex">
                                                    <div class="no-wishlist-{{ $product->id }}"
                                                        style="{{ in_array($product->id, $wishlist) ? 'display: none;' : '' }}">
                                                        <a href="javascript:void(0);" class="btn btn-medium btn-black"
                                                            onclick="toggleWishlist('{{ $product->id }}')">Wishlist<svg
                                                                class="wishlist-outline">
                                                                <use xlink:href="#wishlist-outline"></use>
                                                            </svg></a>
                                                    </div>
                                                    <div class="wishlist-{{ $product->id }}"
                                                        style="{{ !in_array($product->id, $wishlist) ? 'display: none;' : '' }}">
                                                        <a href="javascript:void(0);" class="btn btn-medium btn-black"
                                                            onclick="toggleWishlist('{{ $product->id }}')">Wishlist<svg
                                                                class="wishlist">
                                                                <use xlink:href="#wishlist"></use>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-concern position-absolute">
                                                <div class="cart-button d-flex">
                                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg
                                                            class="cart-outline">
                                                            <use xlink:href="#cart-outline"></use>
                                                        </svg></a>
                                                </div>
                                            </div>
                                            <div
                                                class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                                <h3 class="card-title text-uppercase">
                                                    <a href="#">{{ $product->product_name }}</a>
                                                </h3>
                                                <span class="item-price text-primary">AED {{ $product->cost }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination position-absolute text-center"></div>
        </section>
    @endforeach
@endif
