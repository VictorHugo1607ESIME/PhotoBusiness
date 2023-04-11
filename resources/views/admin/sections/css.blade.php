<style>
    .nav a {
        color: #ede3b4;
    }

    .nav a:hover {
        color: #e6b39a;
    }

    .nav a:active {
        color: #e6cba5;
    }

    .cargando {
        font-family: Impact, sans-serif;
        background: linear-gradient(90deg, #90EE90, #fff, #000);
        background-repeat: no-repeat;
        animation: animate 5s infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: rgba(255, 255, 255, 0);
    }

    @keyframes animate {
        0% {
            background-position: -500%;
        }

        100% {
            background-position: 500%;
        }
    }
</style>
