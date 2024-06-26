<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Validation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div
        class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden py-6 sm:py-12 bg-slate-200">
        <div class="container w-1/2 flex flex-col justify-center py-5 px-0 text-center border bg-[#0d1829]">
            <div class="flex items-center justify-center">
                <img src="image/LC.png" alt="Logo" class="h-[200px] w-[200px]">
            </div>
            <div class="bg-white text-[#0d1829] flex flex-col items-center justify-center px-5 py-10 my-5">
                <div class="h-16 w-16">
                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision"
                        text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd"
                        clip-rule="evenodd" viewBox="0 0 512 508.33">
                        <path fill="#EB0100"
                            d="M317.99 323.62c-17.23-19.89-35.3-40.09-54.23-60.09-62.06 59.35-119.53 126.18-161.12 201.73-51.02 92.68-126.31 16.84-92.15-50.33 27.46-61.28 98.07-146.3 182.94-220.07-46.74-41.72-97.97-79.34-154.08-107.07C-42.76 47.2 19.97-20.82 79.37 6.16c50.04 19.82 119.09 70.85 182.26 134.32 63.11-45.86 129.55-81.8 189.45-95.87 13-3.06 50.95-11.33 59.69 1.04 3.29 4.67-.33 11.68-7.08 19.29-22.99 25.96-84.78 67.12-114.72 90.82-21.61 17.11-43.55 34.99-65.37 53.71 23.2 28.81 43.94 58.64 60.47 88.17 14.37 25.66 25.55 51.1 32.42 75.46 3.14 11.13 11.75 43.64 1.38 51.66-3.91 3.03-10.11.16-16.95-5.38-23.34-18.89-61.29-70.77-82.93-95.76z" />
                    </svg>
                </div>
                {{-- --}}
                <h2 class="my-2 text-[22px] font-Avenir ">Bonjour  ,<br>
                    Votre demande à été refusée par l'Directeur</h2>
                <p class="text-slate-700 text-[18px] my-4">
                    Nous regrettons de vous informer que votre demande sont refusée pour la raison de la chambre est occupée ou votre information sont manquante
                </p>

                    <p class="text-[16px] block my-5">
                        Si vous avez des questions, n'hésitez pas à nous contacter.
                        <span class="text-xs">.</span>
                    </p>
            </div>
            <div class="my-2 text-slate-50"> 
                <div class="p-3">
                    <span class="">
                        A bientôt !
                    </span>
                </div>
                <div>
                    <span>
                        Cordialement,<br />
                         l’équipe de Lodge Cité 
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
