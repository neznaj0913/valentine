<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Valentine</title>
    @vite('resources/css/app.css')
</head>

<body
    class="bg-gradient-to-br from-pink-100 via-rose-100 to-pink-200 min-h-screen flex items-center justify-center px-4">

    <!-- Envelope Wrapper -->
    <div class="relative w-full max-w-md">

        <!-- Envelope Flap -->
        <div
            class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-pink-300 to-pink-400 rounded-t-3xl z-20 pointer-events-none shadow-inner">
        </div>

        <!-- Envelope Body -->
        <div id="envelope"
            class="relative bg-pink-50 w-full min-h-[360px] rounded-3xl shadow-xl border-4 border-pink-400 flex flex-col items-center justify-center px-8 pt-28 pb-10 transition-all duration-500">

            <!-- GIF -->
            <div class="flex justify-center mb-6">
                <img id="cat-gif" src="https://media.tenor.com/EBV7OT7ACfwAAAAj/u-u-qua-qua-u-quaa.gif"
                    alt="cute character"
                    class="w-24 h-24 sm:w-28 sm:h-28 object-contain transition-opacity duration-300">
            </div>

            <!-- Title -->
            <h1 class="text-xl sm:text-2xl font-bold text-pink-600 mb-8 text-center leading-snug">
                Will you be my Valentine? 💖
            </h1>

            <!-- Button Area -->
            <div id="buttonArea" class="relative w-full mt-2 flex items-center justify-center gap-15 h-20">

                <!-- YES BUTTON -->
                <button id="yesBtn"
                    class="min-w-[90px] bg-pink-500 text-white px-6 py-2.5 rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-pink-600 hover:scale-105 active:scale-95">
                    Yes
                </button>

                <!-- NO BUTTON -->
                <button id="noBtn"
                    class="min-w-[90px] bg-rose-400 text-white px-6 py-2.5 rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-rose-500 active:scale-95">
                    No
                </button>
            </div>

            <!-- Letter -->
            @if($letter)
            <div id="letterBox"
                class="hidden mt-8 w-full bg-white border border-pink-200 rounded-2xl p-6 text-left text-pink-800 shadow-inner opacity-0 transition-all duration-700">

                <p class="text-sm text-pink-500 mb-2">
                    To: <span class="font-semibold">Mari</span>
                </p>

                <p class="whitespace-pre-line leading-relaxed text-gray-700">
                    {{ $letter->message }}
                </p>

                <p class="mt-6 text-right font-semibold text-pink-600">
                    With love,<br>
                    Janzen ❤️
                </p>
            </div>
            @endif
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const gifStages = [
            "https://media.tenor.com/EBV7OT7ACfwAAAAj/u-u-qua-qua-u-quaa.gif",
            "https://media1.tenor.com/m/uDugCXK4vI4AAAAd/chiikawa-hachiware.gif",
            "https://media.tenor.com/f_rkpJbH1s8AAAAj/somsom1012.gif",
            "https://media.tenor.com/OGY9zdREsVAAAAAj/somsom1012.gif",
            "https://media1.tenor.com/m/WGfra-Y_Ke0AAAAd/chiikawa-sad.gif",
            "https://media.tenor.com/CivArbX7NzQAAAAj/somsom1012.gif",
            "https://media.tenor.com/5_tv1HquZlcAAAAj/chiikawa.gif",
            "https://media1.tenor.com/m/uDugCXK4vI4AAAAC/chiikawa-hachiware.gif"
        ];

        const noMessages = [
            "No",
            "Are you sure? 🤔",
            "Please? 🥺",
            "I'll be sad...",
            "Very sad... 😢",
            "Please??? 💔",
            "Don't do this...",
            "Last chance! 😭",
            "You can't catch me 😜"
        ];

        const noBtn = document.getElementById("noBtn");
        const yesBtn = document.getElementById("yesBtn");
        const envelope = document.getElementById("envelope");
        const letterBox = document.getElementById("letterBox");
        const buttonArea = document.getElementById("buttonArea");
        const catGif = document.getElementById("cat-gif");

        let noClickCount = 0;
        let runawayEnabled = false;

        function swapGif(src) {
            catGif.style.opacity = "0";
            setTimeout(() => {
                catGif.src = src;
                catGif.style.opacity = "1";
            }, 200);
        }

        function handleNoClick() {
            noClickCount++;

            const msgIndex = Math.min(noClickCount, noMessages.length - 1);
            noBtn.textContent = noMessages[msgIndex];

            // Grow Yes button
            yesBtn.style.transform = `scale(${1 + noClickCount * 0.15})`;

            // Change GIF
            const gifIndex = Math.min(noClickCount, gifStages.length - 1);
            swapGif(gifStages[gifIndex]);

            // Enable runaway after 8 clicks
            if (noClickCount === 8) {
                enableRunaway();
                runawayEnabled = true;

                // Immediately move the button
                runAway();
            }
        }


        function enableRunaway() {
            noBtn.addEventListener("mouseover", runAway);
            noBtn.addEventListener("touchstart", runAway, {
                passive: true
            });
        }

        function isOverlapping(x, y, btnW, btnH, yesRect) {
            return !(
                x + btnW < yesRect.left ||
                x > yesRect.right ||
                y + btnH < yesRect.top ||
                y > yesRect.bottom
            );
        }

        function runAway() {
            const yesRect = yesBtn.getBoundingClientRect();

            const margin = 20;
            const btnW = noBtn.offsetWidth;
            const btnH = noBtn.offsetHeight;

            const maxX = window.innerWidth - btnW - margin;
            const maxY = window.innerHeight - btnH - margin;

            let randomX, randomY;

            do {
                randomX = Math.random() * maxX;
                randomY = Math.random() * maxY;
            } while (
                isOverlapping(
                    randomX,
                    randomY,
                    btnW,
                    btnH,
                    yesRect
                )
            );

            // Move button relative to the page
            noBtn.style.position = "fixed";
            noBtn.style.left = `${randomX}px`;
            noBtn.style.top = `${randomY}px`;
        }


        noBtn.addEventListener("click", handleNoClick);

        yesBtn.addEventListener("click", function() {
            buttonArea.style.display = "none";
            envelope.classList.add("scale-105");

            swapGif("https://media.tenor.com/6ZkJEn80W7kAAAAj/cute-cat.gif");

            if (letterBox) {
                letterBox.classList.remove("hidden");
                setTimeout(() => {
                    letterBox.classList.remove("opacity-0");
                    letterBox.classList.add("opacity-100");
                }, 100);
            }
        });

    });
    </script>


</body>

</html>