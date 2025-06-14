<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Fırat Kaya" />
    <title>Sunucu Bakiye Yükleme - FiveM Roleplay</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="20" cy="80" r="0.5" fill="white" opacity="0.15"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        .payment-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            position: relative;
            overflow: hidden;
        }

        .payment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(195, 172, 247, 0.3);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 16px;
            font-weight: 400;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="number"]::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: #c3acf7;
            box-shadow: 
                0 0 0 3px rgba(195, 172, 247, 0.2),
                0 8px 25px rgba(195, 172, 247, 0.15);
            background: rgba(255, 255, 255, 0.15);
        }

        .amount-input {
            position: relative;
        }

        .amount-input::after {
            content: '₺';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #c3acf7;
            font-weight: 600;
            font-size: 18px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            margin: 32px 0;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #c3acf7 0%, #9b7df7 100%);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 
                0 10px 30px rgba(195, 172, 247, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 15px 40px rgba(195, 172, 247, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .security-note {
            text-align: center;
            margin-top: 24px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .security-note p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .payment-card {
                padding: 24px;
                margin: 10px;
            }

            .form-row,
            .form-row-3 {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .title {
                font-size: 24px;
            }

            .subtitle {
                font-size: 14px;
            }
        }

        /* Floating particles animation */
        .particle {
            position: absolute;
            background: rgba(195, 172, 247, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 4px;
            height: 4px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 6px;
            height: 6px;
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 3px;
            height: 3px;
            bottom: 30%;
            left: 30%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="container">
        <div class="payment-card">
            <div class="header">
                <div class="logo">
                    <img src="https://i.postimg.cc/Dw1hQ24Y/logo-purple.png" alt="Sunucu Logo">
                </div>
                <h1 class="title">Bakiye Yükle</h1>
                <p class="subtitle">Sunucuda daha iyi deneyim için bakiye yükleyin</p>
            </div>

            <form action="payment.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputFirstName">Ad</label>
                        <div class="input-wrapper">
                            <input type="text" name="first_name" id="inputFirstName" placeholder="Adınız" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastName">Soyad</label>
                        <div class="input-wrapper">
                            <input type="text" name="last_name" id="inputLastName" placeholder="Soyadınız" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail">E-Posta Adresi</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="inputEmail" placeholder="ornek@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPhoneNumber">Telefon Numarası</label>
                    <div class="input-wrapper">
                        <input type="text" name="phone_number" id="inputPhoneNumber" placeholder="+90 5XX XXX XX XX" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Adres</label>
                    <div class="input-wrapper">
                        <input type="text" name="address" id="inputAddress" placeholder="Tam adresiniz" required>
                    </div>
                </div>

                <div class="form-row-3">
                    <div class="form-group">
                        <label for="inputCountry">Ülke</label>
                        <div class="input-wrapper">
                            <input type="text" name="country" id="inputCountry" placeholder="Türkiye" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCity">Şehir</label>
                        <div class="input-wrapper">
                            <input type="text" name="city" id="inputCity" placeholder="İstanbul" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputZip">Posta Kodu</label>
                        <div class="input-wrapper">
                            <input type="number" name="zip_code" id="inputZip" placeholder="34000" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAmount">Yüklenecek Miktar</label>
                    <div class="input-wrapper amount-input">
                        <input type="number" name="amount" id="inputAmount" placeholder="100" min="1" required>
                    </div>
                </div>

                <div class="divider"></div>

                <input type="hidden" name="user_id" value="1">
                <button type="submit" class="submit-btn">
                    Ödemeye Geç
                </button>

                <div class="security-note">
                    <p>🔒 Tüm ödemeleriniz SSL ile şifrelenir ve güvenli bir şekilde işlenir.</p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>