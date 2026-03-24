<x-app-layout>
    <head>
        <style>
            .faq-item {
                margin-bottom: 10px;
            }

            .faq-question {
                width: 100%;
                text-align: left;
                padding: 12px;
                font-size: 16px;
                background-color: #f3f3f3;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }

            .faq-answer {
                display: none;
                padding: 10px;
                background-color: #fafafa;
                border-left: 3px solid #ccc;
            }

            .faq-answer a {
                color: #C19A6B;
                text-decoration: none;
            } 
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll(".faq-question").forEach(button => {
                    button.addEventListener("click", () => {
                        const answer = button.nextElementSibling;

                        answer.style.display = answer.style.display === "block" ? "none" : "block";
                    });
                });
            });
        </script>
    </head>
    <div style="max-width: 900px; margin: auto; padding: 20px">
        <h1 style="text-align: center; font-size: 2rem; margin-bottom: 20px;">Frequently Asked Questions</h1>
    </div>

    <div class="faq-item">
        <button class="faq-question">What is Revival Threads?</button>
        <div class="faq-answer">
            <p>We are a sustainable fashion brand dedicated to creating high-quality, eco-friendly clothing that makes a positive impact on the environment and society.<br>More information in the <a href="{{ url('aboutus') }}">About Us Page</a></p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">How does Revival Threads support sustainability?</button>
        <div class="faq-answer">
            <p>We are committed to sustainability by using eco-friendly materials, implementing responsible manufacturing processes, and promoting circular economy principles.</p>
        </div>
    </div>
    
    <div class="faq-item">
        <button class="faq-question">How do I return an item?</button>
        <div class="faq-answer">
            <p>If you wish to return an item just contact us in the <a href="{{ url('/contact') }}">Contact Page</a>.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Can I use the website as a guest?</button>
        <div class="faq-answer">
            <p>Yes, you can browse our products and add items to your cart without creating an account.<br>However, you will need to <a href="{{ url('/login') }}">log in</a> or <a href="{{ url('/register') }}">create an account</a> to complete your purchase.</p>
        </div>
    </div>
</x-app-layout>