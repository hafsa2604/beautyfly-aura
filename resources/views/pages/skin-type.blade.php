@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">✨ Know Your Skin Type ✨</h2>
        <p class="text-center text-muted mb-5">Answer a few simple questions to discover your skin type and get product recommendations!</p>

        <form id="skinQuiz" class="mx-auto" style="max-width: 600px;">
            <div class="mb-4">
                <label class="form-label fw-semibold">1️⃣ How does your skin feel after washing your face?</label>
                <select class="form-select" name="q1" required>
                    <option value="">Select...</option>
                    <option value="dry">Tight and dry</option>
                    <option value="oily">Greasy or shiny</option>
                    <option value="combination">Dry in some areas, oily in others</option>
                    <option value="normal">Soft and balanced</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">2️⃣ How often do you get acne or breakouts?</label>
                <select class="form-select" name="q2" required>
                    <option value="">Select...</option>
                    <option value="oily">Frequently</option>
                    <option value="combination">Sometimes on T-zone (forehead, nose, chin)</option>
                    <option value="dry">Rarely</option>
                    <option value="normal">Almost never</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">3️⃣ Do you experience flakiness or rough texture?</label>
                <select class="form-select" name="q3" required>
                    <option value="">Select...</option>
                    <option value="dry">Yes, often</option>
                    <option value="combination">Sometimes</option>
                    <option value="normal">No</option>
                    <option value="oily">Never</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Check My Skin Type</button>
        </form>

        <div id="result" class="mt-5 text-center fw-bold fs-5 text-success"></div>
    </div>

    <script>
        document.getElementById('skinQuiz').addEventListener('submit', function(e) {
            e.preventDefault();

            const answers = [...new FormData(this).values()];
            const counts = {};
            answers.forEach(a => counts[a] = (counts[a] || 0) + 1);
            const result = Object.entries(counts).sort((a,b) => b[1]-a[1])[0][0];

            let message = "";
            switch(result) {
                case 'dry': message = "🌸 You have Dry Skin — Focus on hydration and gentle cleansers."; break;
                case 'oily': message = "💧 You have Oily Skin — Use oil-control products and lightweight moisturizers."; break;
                case 'combination': message = "🌼 You have Combination Skin — Balance hydration and oil control."; break;
                case 'normal': message = "🌿 You have Normal Skin — Maintain with mild, balanced skincare."; break;
                default: message = "Please answer all questions!";
            }
            document.getElementById('result').textContent = message;
        });
    </script>
@endsection

