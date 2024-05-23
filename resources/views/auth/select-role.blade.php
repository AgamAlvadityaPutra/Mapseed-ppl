<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="absolute top-0 flex justify-between items-center w-full p-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
    </header>    
    <main
        class="relative h-screen flex flex-col justify-center gap-8 px-10 bg-gradient-to-b from-[#F2F4F5] to-[#75EBA199]">
        <h1 class="text-[30px] leading-[30px] font-bold">
            Hallo, <br />Pilih Role Kamu
        </h1>
        <section class="flex justify-center items-center gap-10">
            <div id="mitra" onclick="selectRole('mitra')"
                class="relative flex flex-col items-center gap-4 hover:cursor-pointer">
                <div class="absolute bottom-0 left-0 bg-white w-full h-[70%] rounded-xl"></div>
                <img src="/images/illustration/mitra.png" class="h-40 mx-4 z-10" alt="mitra" />
                <h2 class="text-[20px] z-10">Mitra Benih</h2>
                <div class="tick opacity-0 self-end bg-green-500 px-4 py-2 rounded-tl-xl rounded-br-xl z-10">
                    <img src="/images/accent/tick.png" alt="tick" />
                </div>
            </div>
            <div id="dealer" onclick="selectRole('dealer')"
                class="relative flex flex-col items-center gap-4 hover:cursor-pointer">
                <div class="absolute bottom-0 left-0 bg-white w-full h-[70%] rounded-xl"></div>
                <img src="/images/illustration/dealer.png" class="h-40 mx-4 z-10" alt="mitra" />
                <h2 class="text-[20px] z-10">Dealer Benih</h2>
                <div class="tick opacity-0 self-end bg-green-500 px-4 py-2 rounded-tl-xl rounded-br-xl z-10">
                    <img src="/images/accent/tick.png" alt="tick" />
                </div>
            </div>
        </section>
        <a id="next"
            class="opacity-0 self-center w-14 h-14 rounded-full bg-white flex items-center justify-center">
            <img src="/images/accent/arrow.png" alt="arrow" class="w-1/2" />
        </a>
    </main>
    <script>
        var role = null;

        function selectRole(selectedRole) {
            document
                .querySelector(`#${selectedRole} .tick`)
                .classList.remove("opacity-0");
            if (role && role !== selectedRole) {
                document.querySelector(`#${role} .tick`).classList.add("opacity-0");
            }
            role = selectedRole;
            if (role) {
                document.querySelector("#next").classList.remove("opacity-0");
                document.querySelector("#next").setAttribute("href", `/register?role=${role}`);
            }
        }
    </script>
</body>

</html>
