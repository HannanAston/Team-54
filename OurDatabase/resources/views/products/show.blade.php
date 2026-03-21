<x-app-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 0px;
        }

        .container {
            max-width: 1500px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .product-image {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .product-info h1 {
            font-size: 32px;
            margin-bottom: 15px;
            color: #333;
        }

        .product-price {
            font-size: 28px;
            color: #16a34a;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .stock-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .in-stock {
            background-color: #d4edda;
            color: #155724;
        }

        .low-stock {
            background-color: #fff3cd;
            color: #856404;
        }

        .out-of-stock {
            background-color: #f8d7da;
            color: #721c24;
        }

        .rating-display {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .stars {
            color: #ffc107;
            font-size: 24px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #2196F3;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0b7dda;
        }

        .reviews-section {
            margin-top: 50px;
            border-top: 2px solid #ddd;
            padding-top: 30px;
        }

        .reviews-section h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .review-form {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .star-rating {
            display: flex;
            gap: 5px;
            font-size: 30px;
            cursor: pointer;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #ffc107;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .review-item {
            background: white;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-author {
            font-weight: bold;
            color: #333;
        }

        .review-date {
            color: #999;
            font-size: 14px;
        }

        .review-stars {
            color: #ffc107;
            margin-bottom: 10px;
        }

        .review-text {
            color: #666;
            line-height: 1.6;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background-color: #da190b;
        }

        #add-to-cart {
            background-color: rgb(193, 154, 107);
            color: white;
            border-radius: 10px;
            padding: 15px;
            display: flex;
            max-width: 25%;
            justify-content: center;
            text-decoration: none;
            margin-top: 50px;
        }
    </style>

    <div class="container">
        <a href="/products" class="btn btn-secondary" style="margin-bottom: 20px;">← Back to Products</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="product-detail">
            <div>
                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : $product->image_url }}" 
                    alt="{{ $product->name }}" 
                    class="product-image">
            </div>
            
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                
                <div class="rating-display">
                    <span class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($product->averageRating()))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </span>
                    <span>({{ number_format($product->averageRating(), 1) }} / 5 - {{ $product->reviews->count() }} reviews)</span>
                </div>

                <div class="product-price">£{{ number_format($product->price, 2) }}</div>
                
                <p class="product-description">{{ $product->description }}</p>
                
                <span href="#" class="stock-badge {{ $product->getStockStatusClass() }}">
                    {{ $product->getStockStatus() }}
                </span>
                
                <p style="color: #666; margin-top: 0px;">
                    <strong>Stock:</strong> {{ $product->stock_qty }} units available
                </p>

                <form id="add-to-cart" action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-cart">Add to Cart</button>
                </form>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section">
            <h2>Customer Reviews ({{ $product->reviews->count() }})</h2>

            @auth
                <div class="review-form">
                    <h3 style="margin-bottom: 15px;">
                        @if($product->reviews->where('user_id', auth()->id())->first())
                            Update Your Review
                        @else
                            Write a Review
                        @endif
                    </h3>
                    
                    <form action="{{ route('reviews.store', $product) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Rating *</label>
                            <div class="star-rating">
                                <input type="radio" name="rating" value="5" id="star5" required>
                                <label for="star5">★</label>
                                <input type="radio" name="rating" value="4" id="star4">
                                <label for="star4">★</label>
                                <input type="radio" name="rating" value="3" id="star3">
                                <label for="star3">★</label>
                                <input type="radio" name="rating" value="2" id="star2">
                                <label for="star2">★</label>
                                <input type="radio" name="rating" value="1" id="star1">
                                <label for="star1">★</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="review">Your Review (optional)</label>
                            <textarea name="review" id="review" placeholder="Tell us what you think about this product...">{{ $product->reviews->where('user_id', auth()->id())->first()?->review }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            @else
                <p style="background: #f9f9f9; padding: 20px; border-radius: 10px; text-align: center;">
                    Please <a href="/login" style="color: #2196F3; font-weight: bold;">log in</a> to write a review.
                </p>
            @endauth

            <!-- Display Reviews -->
            <div style="margin-top: 30px;">
                @forelse($product->reviews()->latest()->get() as $review)
                    <div class="review-item">
                        <div class="review-header">
                            <div>
                                <span class="review-author">{{ $review->user->name }}</span>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <span class="review-date">{{ $review->created_at->format('M j, Y') }}</span>
                                @auth
                                    @if($review->user_id === auth()->id())
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display: inline; margin-left: 10px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this review?')">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        @if($review->review)
                            <p class="review-text">{{ $review->review }}</p>
                        @endif
                    </div>
                @empty
                    <p style="text-align: center; color: #999; padding: 40px;">No reviews yet. Be the first to review this product!</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Pre-select rating if user is editing their review
        const existingRating = {{ $product->reviews->where('user_id', auth()->id())->first()?->rating ?? 0 }};
        if (existingRating > 0) {
            document.getElementById('star' + existingRating).checked = true;
        }
    </script>

</x-app-layout>