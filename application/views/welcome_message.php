<!DOCTYPE html>
<html>
<head>
    <title>Tanda Tangan Online</title>
    <style>
        #signatureCanvas {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>Tanda Tangan Online</h1>
    <canvas id="signatureCanvas" width="400" height="200"></canvas>
    <br>
    <button onclick="clearCanvas()">Hapus Tanda Tangan</button>
    <button onclick="saveSignature()">Simpan Tanda Tangan</button>
    <br>
    <img id="savedSignature" src="" alt="Tanda Tangan Tersimpan">
    
</body>
</html>

<script>
	const canvas = document.getElementById('signatureCanvas');
const ctx = canvas.getContext('2d');
let isDrawing = false;

function startPosition(e) {
    isDrawing = true;
    draw(e);
}

function endPosition() {
    isDrawing = false;
    ctx.beginPath();
}

function draw(e) {
    if (!isDrawing) return;
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.strokeStyle = 'black';

    ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('savedSignature').src = '';
}

function saveSignature() {
    const signatureImage = canvas.toDataURL(); // Mendapatkan data URL gambar dari tanda tangan yang digambar di canvas
    const imgElement = document.getElementById('savedSignature');
    imgElement.src = signatureImage;
}

canvas.addEventListener('mousedown', startPosition);
canvas.addEventListener('mouseup', endPosition);
canvas.addEventListener('mousemove', draw);

</script>