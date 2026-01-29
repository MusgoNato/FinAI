<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="100%" max-width="480" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:12px;padding:32px;box-shadow:0 10px 25px rgba(0,0,0,0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="margin:0 0 16px;font-size:22px;color:#111827;">
                                Verificação de E-mail
                            </h2>
                        </td>
                    </tr>

                    <!-- Text -->
                    <tr>
                        <td style="text-align:center;color:#4b5563;font-size:15px;">
                            <p style="margin:0 0 24px;">
                                Use o código abaixo para verificar seu e-mail:
                            </p>
                        </td>
                    </tr>

                    <!-- Code -->
                    <tr>
                        <td style="text-align:center;">
                            <div
                                style="
                                    display:inline-block;
                                    background:#e5e7eb;
                                    padding:16px 32px;
                                    border-radius:10px;
                                    font-size:28px;
                                    font-weight:bold;
                                    letter-spacing:6px;
                                    color:#111827;
                                ">
                                {{ $code }}
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="text-align:center;color:#6b7280;font-size:13px;padding-top:24px;">
                            <p style="margin:0;">
                                Este código expira em <strong>10 minutos</strong>.
                            </p>
                            <p style="margin-top:12px;">
                                Se você não solicitou este código, pode ignorar este e-mail.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
