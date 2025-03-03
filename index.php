<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<style>
    .index-content {
        padding: 1rem !important;
    }

    .mt {
        margin-top: 80px;
    }

    @media (max-width: 1050px) {
        .index-content {
            padding: 1rem !important;
        }
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./assets/LOGO.png" alt="Logo" height="40">
                <img src="./assets/logo2.png" alt="Logo 2" height="80"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <a href="./pages/login.php" class="btn btn-logout">Login</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Dashboard Content -->
    <div class="container">
        <div class="container-content mt  index-content py-3">
            <h1>Discover Excellence Programme</h1>
            <p class="text-center">
                The Discover Excellence Programme is a capacity building and personal development programme designed to help individuals gain a deeper understanding of their personal behavior/temperament, communication style, and decision-making approach. Automated by Professor King Costa, who is a world-renowned management and social scientist (see more on this link: <a href='https://drkingcosta.academia.edu/'>https://drkingcosta.academia.edu/</a>), the tool is a well renowned and built on two leading and well known personality inventory batteries, the MBTI and Kersey’s Temperament Sorter.
            </p>
            <p>Rooted in the research of Dr. David Keirsey, this framework categorizes individuals into four primary temperaments:</p>
            <ul>
                <li><strong>Guardian:</strong> Practical, dependable, and duty-driven individuals who value stability and structure.</li>
                <li><strong>Artisan:</strong> Adaptable, spontaneous, and hands-on individuals who thrive in dynamic environments.</li>
                <li><strong>Idealist:</strong> Visionary, empathetic, and purpose-driven individuals who seek meaningful connections and personal growth.</li>
                <li><strong>Rational:</strong> Analytical, strategic, and knowledge-seeking individuals who excel in innovation and problem-solving.</li>
            </ul>
            <p class="text-center">
                <strong>Built on the MBTI® Framework</strong><br>
                The Discover Excellence Programme is based on the foundational principles of the Myers-Briggs Type Indicator (MBTI®), which classifies individuals using four key dimensions:
            </p>
            <ul>
                <li><strong>Extraversion (E) vs. Introversion (I):</strong> How individuals direct their energy.</li>
                <li><strong>Sensing (S) vs. Intuition (N):</strong> How individuals process information.</li>
                <li><strong>Thinking (T) vs. Feeling (F):</strong> How individuals make decisions.</li>
                <li><strong>Judging (J) vs. Perceiving (P):</strong> How individuals organize their world.</li>
            </ul>
            <p class="text-center">
                While the MBTI® identifies 16 personality types, the Discover Excellence Programme simplifies these insights into four broad temperaments, making it an accessible tool for understanding behavior in various settings. The two systems complement each other by offering both depth and practical application in self-awareness and interpersonal effectiveness.
            </p>
            <a href="./pages/test.php"><button class="btn btn-custom bg-color">Take Test</button></a>
        </div>
    </div>
</body>

</html>