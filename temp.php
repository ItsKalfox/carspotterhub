<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/includes/header.php';?>
    <title>Coming Soon</title>
    <style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
            Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ffffff 0%, #4d4d4d 100%);
        color: white;
    }

    .container {
        text-align: center;
        padding: 2rem;
        max-width: 600px;
        animation: fadeIn 1s ease-in;
        color: black;
    }

    .message {
        background: rgba(255, 255, 255, 0.39);
        backdrop-filter: blur(10px);
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .illustration {
        width: 200px;
        margin-bottom: 2rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .progress {
        width: 100%;
        height: 4px;
        background: rgba(0, 0, 0, 0.158);
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }

    .progress::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 30%;
        background: rgba(0, 0, 0, 0.7);
        animation: progress 2s ease-in-out infinite;
    }

    @keyframes progress {
        0% {
            left: -30%;
        }

        100% {
            left: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="message">
            <img src="https://raw.githubusercontent.com/twbs/icons/main/icons/tools.svg" class="illustration"
                alt="Under Construction" />
            <h1>Page Under Construction</h1>
            <p>
                We're working hard to bring you something amazing. Check
                back soon!
            </p>
            <div class="progress"></div>
        </div>
    </div>
</body>

</html>