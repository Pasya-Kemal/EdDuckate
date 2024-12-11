function generateModalID(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }
    return result;
}


function showModal(contentID) {
    const prefix = '__ujianify__modal__';
    const modalID = prefix + generateModalID(16);
    const content = document.getElementById(contentID).innerHTML;
    const modalHTML = '<div id="' + modalID + '" class="__ujianify__modal__wrapper__ relative z-10">' +
                '<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>' +
                '<div class="fixed inset-0 z-10 overflow-y-auto">' +
                    '<div class="flex min-h-full justify-center p-4 text-center items-center">' +
                        '<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all min-w-[200px] sm:my-8 sm:w-full sm:max-w-lg">' +
                            '<div class="relative bg-white px-4 pb-4 pt-3 sm:p-6 sm:pt-3 sm:pb-4">' +
                                '<div class="absolute w-8 h-8 right-1 top-2 bg-white cursor-pointer">' +
                                    '<div id="' + modalID + '_close_button"><span class="material-symbols-outlined">close</span></div>' +
                                '</div>' +
                                content +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';

    document.body.innerHTML += modalHTML;

    document.getElementById(modalID + '_close_button').addEventListener('click', function () {
        onModalClose(modalID)
    });
}

function onModalClose(id) {
    document.getElementById(id).style.display = 'hidden';
    document.getElementById(id).style.zIndex = '-1';
    document.getElementById(id).remove();
}
