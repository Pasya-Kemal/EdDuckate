let _cam;
let _screenCam;
let _camSubjectId = 0;

function initializeCamera(subjectId) {
    _camSubjectId = subjectId;
    const video = document.getElementById('subjectCamera');
    navigator.mediaDevices.getUserMedia({video: true, audio: false}).then(stream => {
        video.srcObject = stream;
        setTimeout(() => {
            captureImageAndSubmitToTheServer();
        }, 2000);
    }).catch((e) => {
        alert("Mohon untuk mengaktifkan kamera");
        window.location.reload();
    });
    // navigator.mediaDevices.getDisplayMedia({video: true}).then(r => {
    //     _screenCam = r;
    //     setTimeout(() => {
    //         takeCamera(r);
    //     }, 8000);
    // });
}

function captureImageAndSubmitToTheServer() {
    axios.post(_url('submitCam'), {
        "image": captureImage(),
        "subject_id": _camSubjectId,
    });
    setTimeout(() => {
        captureImageAndSubmitToTheServer();
    }, Math.floor(Math.random() * (30000 - 5000 + 1)) + 5000);
}

function captureImage() {
    const video = document.getElementById('subjectCamera');
    const canvas = document.getElementById('subjectCamCanvas');
    const context = canvas.getContext('2d');

    // Set canvas dimensions to match video dimensions
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    // Draw the current frame from the video onto the canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert canvas content to a data URL representing a PNG image
    return canvas.toDataURL('image/png');
}


