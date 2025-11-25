<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Response to Your Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:30px;">
    <div style="max-width:500px;margin:0 auto;background:white;padding:25px;border-radius:8px;border:1px solid #ddd;">
        <h2 style="text-align:center;color:#111;margin-bottom:10px;">Response to Your Inquiry</h2>
        
        <p>Hello {{ $data['name'] }},</p>
        
        <p>Thank you for contacting us. We have received your message regarding:</p>
        
        <div style="background:#f3f4f6;padding:15px;border-radius:6px;margin:20px 0;border-left:4px solid #4f46e5;">
            <p style="margin:0;font-weight:bold;color:#111;margin-bottom:8px;">Subject:</p>
            <p style="margin:0;color:#555;">{{ $data['subject'] }}</p>
        </div>

        <div style="background:#f3f4f6;padding:15px;border-radius:6px;margin:20px 0;border-left:4px solid #4f46e5;">
            <p style="margin:0;font-weight:bold;color:#111;margin-bottom:8px;">Your Message:</p>
            <p style="margin:0;color:#555;white-space:pre-wrap;">{{ $data['message'] }}</p>
        </div>

        <div style="background:#eef2ff;padding:20px;border-radius:6px;margin:30px 0;border-left:4px solid #4f46e5;">
            <p style="margin:0;font-weight:bold;color:#111;margin-bottom:10px;">Our Response:</p>
            <p style="margin:0;color:#1e293b;white-space:pre-wrap;line-height:1.6;">{{ $data['replyMessage'] }}</p>
        </div>

        <p style="margin-top:30px;">If you have any further questions, please don't hesitate to contact us again.</p>
        
        <p style="font-size:12px;color:#777;text-align:center;margin-top:30px;padding-top:20px;border-top:1px solid #e5e7eb;">
            Best regards,<br>
            TechWave Team
        </p>
    </div>
</body>
</html>