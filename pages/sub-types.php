<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sixteen Buttons with Popup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Grid Layout for Buttons */
        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }
        /* Popup Background Overlay */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Popup Content Box */
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            position: relative;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        /* Close Button */
        .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #F77F2E;
        }

        /* Popup Heading Styling */
        .popup-heading {
            font-size: 18px;
            font-weight: bold;
            color: #1E7AC2;
        }

        /* Center Two Divs Inside Popup */
        .popup-body {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 15px;
        }

        .popup-section {
            flex: 1;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .button-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .popup-content {
                width: 90%;
            }

            .popup-body {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
<?php 
include 'navbar.php';
?>
<div class="container mt-4">
    <h2 class="text-center">Personality Types</h2>
    
    <div class="button-grid">
        <?php for ($i = 1; $i <= 16; $i++): ?>
            <button class="btn btn-primary w-100" onclick="showPopup(<?php echo $i; ?>)">Button <?php echo $i; ?></button>
        <?php endfor; ?>
    </div>
</div>


<!-- Custom Popup (Initially Hidden) -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <h5 class="popup-title">Popup Information</h5>
        <div class="popup-body">
            <div class="popup-section">
                <h5 class="popup-heading" id="popupHeading1">Heading 1</h5>
                <p id="popupText1">Outgoing, social, disorganized, easily talked into doing silly things, spontaneous, wild and crazy, acts without thinking, good at getting people to have fun, pleasure seeking, irresponsible, physically affectionate, risk taker, thrill seeker, likely to have or want a tattoo, adventurous, unprepared, attention seeking, hyperactive, irrational, loves crowds, rule breaker, prone to losing things, seductive, easily distracted, open, revealing, comfortable in unfamiliar situations, attracted to strange things, non-punctual, likes to stand out, likes to try new things, fun seeker, unconventional, energetic, impulsive, empathetic, dangerous, loving, attachment prone, prone to fantasy.</p>
            </div>
            <div class="popup-section">
                <h5 class="popup-heading" id="popupHeading2">Heading 2</h5>
                <p id="popupText2">Performer, actor, entertainer, songwriter, musician, filmmaker, comedian, radio broadcaster/DJ, some job related to theater/drama, poet, music journalist, work in fashion industry, singer, movie producer, playwright, bartender, comic book author, work in television, dancer, artist, record store owner, model, freelance artist, teacher (art, drama, music), writer, painter, massage therapist, costume designer, choreographer, make-up artist.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function showPopup(buttonNumber) {
        let data = {
            1: { heading1: "Leadership", text1: "Performer, actor, entertainer, songwriter, musician, filmmaker, comedian, radio broadcaster/DJ, some job related to theater/drama, poet, music journalist, work in fashion industry, singer, movie producer, playwright, bartender, comic book author, work in television, dancer, artist, record store owner, model, freelance artist, teacher (art, drama, music), writer, painter, massage therapist, costume designer, choreographer, make-up artist.", heading2: "Decision Making", text2: "Performer, actor, entertainer, songwriter, musician, filmmaker, comedian, radio broadcaster/DJ, some job related to theater/drama, poet, music journalist, work in fashion industry, singer, movie producer, playwright, bartender, comic book author, work in television, dancer, artist, record store owner, model, freelance artist, teacher (art, drama, music), writer, painter, massage therapist, costume designer, choreographer, make-up artist." },
            2: { heading1: "Creativity", text1: "Thinking outside the box.", heading2: "Innovation", text2: "Brings new ideas to life." },
            3: { heading1: "Communication", text1: "Great in expressing thoughts.", heading2: "Collaboration", text2: "Works well in teams." },
            4: { heading1: "Resilience", text1: "Handles pressure well.", heading2: "Problem Solving", text2: "Finds solutions easily." }
        };

        let content = data[buttonNumber] || { 
            heading1: "Default Heading 1", text1: "Default description for section 1.", 
            heading2: "Default Heading 2", text2: "Default description for section 2." 
        };

        document.getElementById("popupHeading1").innerText = content.heading1;
        document.getElementById("popupText1").innerText = content.text1;
        document.getElementById("popupHeading2").innerText = content.heading2;
        document.getElementById("popupText2").innerText = content.text2;

        document.getElementById("popupOverlay").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popupOverlay").style.display = "none";
    }
</script>

</body>
</html>
