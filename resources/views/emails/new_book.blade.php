<!DOCTYPE html>
<html>
<head>
    <title>Buku Baru Ditambahkan</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                
                <!-- Container -->
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center">
                            <h2 style="color: #333;">📚 Buku Baru Ditambahkan</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 15px;">
                            <p style="font-size: 16px; color: #555; margin: 0;"><strong>📖 Judul Buku:</strong> {{ $book->name }}</p>
                            <p style="font-size: 16px; color: #555; margin: 0;"><strong>✍️ Author:</strong> {{ $book->author }}</p>
                            <p style="font-size: 16px; color: #555; margin: 0;"><strong>💰 Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                            <p style="font-size: 16px; color: #555; margin: 0;"><strong>📦 Stock:</strong> {{ $book->stock }}</p>
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="{{ url('/books/' .$book->id) }}" style="display: inline-block; background-color: #007bff; color: #ffffff; padding: 12px 20px; text-decoration: none; font-size: 16px; border-radius: 5px;">📖 Lihat Buku</a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 10px; font-size: 14px; color: #777;">
                            Buku Telah Ditambahkan 🚀
                        </td>
                    </tr>
                </table>
                <!-- End Container -->

            </td>
        </tr>
    </table>

</body>
</html>
