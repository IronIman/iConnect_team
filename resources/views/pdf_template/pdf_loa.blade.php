<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Letter of Acceptance</title>
    <link rel="icon" type="image/x-icon" src="images\logo_idrivers.png">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header img {
            height: auto;
            width: auto;
            float: left
        }
        .header-text {
            text-align: right;
            font-size: 10px;
        }
        .header-text b {
            font-size: 11px;
        }
        .info-line {
            font-size: 10px;
        }
        .separator {
            border-top: 2px solid black;
            margin: 10px 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin: 15px 0;
        }
        .content {
            margin-top: 10px;
        }
        ul {
            margin-top: 0;
        }
        .footer {
            margin-top: 40px;
        }
        .footer p {
            margin: 2px 0;
            font-size: 10px;
        }
        .bottom-line {
            border-top: 2px solid black;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
    <img src="images\logo_loa.jpg" alt="Logo">
        <div class="header-text">
            <b>INTERNATIONAL DEVELOPMENT, RESEARCH &<br>
            INNOVATION VIRTUAL EXHIBITION 2025</b><br>
            Universiti Tun Hussein Onn Malaysia<br>
            Pagoh Higher Educational Hub, KM 1, Jalan Panchor, 84600<br>
            Muar, Johor, Malaysia<br><br>

            <span class="info-line">Website: https://idrive.uthm.edu.my</span><br>
            <span class="info-line">Email: idrive@uthm.edu.my</span><br>
            <span class="info-line">Telegram: iDRIVE 2025</span>
        </div>
    </div>

    <div class="separator"></div>

    <div class="title">NOTIFICATION OF ACCEPTANCE</div>

    <div class="content">
        <p><b>Date:</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

        <p><b>Dear {{ $projects->leader }}</b></p>

        <p>Congratulations. Your innovation project has been accepted for the International Development, Research &<br>
        Innovation Virtual Exhibition 2025.</p>

        <p><b>ID / Reference :</b> {{ $projects->id }}<br>
        <b>Project Title :</b> {{ $projects->title }}</p>

        <p>Meantime, you may prepare the following details to be uploaded in the submission system. Please<br>
        follow the author guidelines that are stated on the website:</p>

        <ul>
            <li>Innovation Video Presentation</li>
            <li>Extended Abstract</li>
        </ul>

        <p>Professional juries will evaluate your product only upon receipt and confirmation of the full payment by<br>
        the organizer.<br>
        Any update about iDRIVE 2025 will be notified through email.</p>
    </div>

    <div class="footer">
        <p>Thank you for your attention.</p>
        <br>
        <p>Yours Sincerely,</p>
        <p>Idrive 2025 Secretariat,</p>

        <p>Website: https://idrive.uthm.edu.my/index.php</p>
        <p>Email: idrive@uthm.edu.my</p>
        <p>Telegram: @TelegramiDRIVE</p>
        <p>Facebook Event Page: IDrive 2024</p>
        <p>Instagram: @idriveuthm</p>
    </div>

    <div class="bottom-line"></div>
</body>
</html>