<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QR Code Decoder</title>
</head>
<body>
<input type="text" id="qr-input" accept="image/*">
<div id="result"></div>

<script src="https://cdn.jsdelivr.net/npm/qrcode-reader/dist/browser.js"></script>
<script>
document.getElementById('qr-input').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var img = new Image();
        img.src = reader.result;
        img.onload = function() {
            var qr = new QrCode();
            qr.callback = function(result) {
                document.getElementById('result').textContent = result;
            };
            qr.decode(img);
        };
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>
</body>
</html>
