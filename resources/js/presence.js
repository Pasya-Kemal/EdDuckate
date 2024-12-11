let signaturePresencePad;

document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('signature_presence');
    if(canvas === null) {
        return;
    }
    canvas.width = document.getElementById('signature_presence_wrapper').offsetWidth;
    signaturePresencePad = new SignaturePad(canvas, {
        penColor: "rgb(66, 133, 244)"
    });

    const presenceInput = document.getElementById('signature_presence_input');
    const presenceForm = document.getElementById('presence_form');
    presenceForm.addEventListener('submit', function (e) {
        presenceInput.value = signaturePresencePad.toDataURL();
    });

});

function clearSignaturePresence() {
    signaturePresencePad.clear();
}

