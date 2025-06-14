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
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 25%, #2d2d2d 50%, #1a1a1a 75%, #0f0f0f 100%);
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
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            position: relative;
            z-index: 1;
        }

        .payment-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
            background: rgba(15, 15, 15, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 0;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            position: relative;
            overflow: hidden;
        }

        .payment-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .left-section {
            padding: 50px 40px;
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.8) 0%, rgba(30, 30, 30, 0.6) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .left-section::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 0;
            width: 1px;
            height: 60%;
            background: linear-gradient(180deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .logo {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            background: rgba(40, 40, 40, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
            font-weight: 400;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .features {
            list-style: none;
            text-align: left;
        }

        .features li {
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            margin-bottom: 12px;
            padding-left: 24px;
            position: relative;
        }

        .features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #666666;
            font-weight: bold;
        }

        .right-section {
            padding: 50px 40px;
            background: rgba(25, 25, 25, 0.8);
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 16px 20px;
            background: rgba(40, 40, 40, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 400;
            transition: all 0.3s ease;
            outline: none;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="number"]::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 0 0 3px rgba(255, 255, 255, 0.1),
                0 8px 25px rgba(0, 0, 0, 0.2);
            background: rgba(50, 50, 50, 0.9);
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
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
            font-size: 18px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            margin: 32px 0;
        }

        .submit-btn {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #2d2d2d 0%, #404040 50%, #2d2d2d 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 
                0 10px 30px rgba(0, 0, 0, 0.3),
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #404040 0%, #505050 50%, #404040 100%);
            box-shadow: 
                0 15px 40px rgba(0, 0, 0, 0.4),
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
            background: rgba(20, 20, 20, 0.6);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .security-note p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 1024px) {
            .payment-wrapper {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .left-section::after {
                display: none;
            }

            .left-section {
                padding: 40px 30px 30px;
            }

            .right-section {
                padding: 30px;
            }

            .logo {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }

            .title {
                font-size: 28px;
            }

            .subtitle {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .payment-wrapper {
                margin: 10px;
            }

            .left-section,
            .right-section {
                padding: 30px 20px;
            }

            .form-row,
            .form-row-3 {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .title {
                font-size: 24px;
            }

            .form-title {
                font-size: 20px;
            }
        }

        /* Dark particles animation */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: darkFloat 8s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 3px;
            height: 3px;
            top: 15%;
            left: 15%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 4px;
            height: 4px;
            top: 70%;
            right: 25%;
            animation-delay: 3s;
        }

        .particle:nth-child(3) {
            width: 2px;
            height: 2px;
            bottom: 25%;
            left: 70%;
            animation-delay: 6s;
        }

        @keyframes darkFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-30px) rotate(180deg);
                opacity: 0.6;
            }
        }
    </style>
</head>

<body>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="container">
        <div class="payment-wrapper">
            <div class="left-section">
                <div class="logo">
                    <img src="https://i.postimg.cc/Dw1hQ24Y/logo-purple.png" alt="Sunucu Logo">
                </div>
                <h1 class="title">Bakiye Yükle</h1>
                <p class="subtitle">FiveM roleplay sunucumuzda daha iyi deneyim için güvenli ödeme sistemi ile bakiye yükleyin</p>
                
                <ul class="features">
                    <li>Anında bakiye yükleme</li>
                    <li>Güvenli ödeme sistemi</li>
                    <li>7/24 destek hizmeti</li>
                    <li>Komisyon dahil fiyatlandırma</li>
                </ul>
            </div>

            <div class="right-section">
                <div class="form-header">
                    <h2 class="form-title">Ödeme Bilgileri</h2>
                    <p class="form-subtitle">Lütfen tüm alanları eksiksiz doldurun</p>
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
    </div>
</body>

</html>