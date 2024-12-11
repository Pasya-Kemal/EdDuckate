const AntiCheatData = {
    intervalCheck: 250,
    lastCheck: null,
    warning: 0,
    maxWarn: 2,
    compensation: 500,
    delay: 5000
};


// gimmick
function sendLoadingAnimation() {
    const lastLoad = localStorage.getItem('last_anti_cheat_loaded');
    if(lastLoad !== null) {
        const lastLoadInt = parseInt(lastLoad);
        if(lastLoad + (1000 * 360) >= Date.now()) {
            return;
        }
    }
    const elem = document.createElement('div');
    elem.id = 'anti_cheat_loader';
    elem.style.position = 'fixed';
    elem.style.top = '0';
    elem.style.left = '0';
    elem.style.zIndex = '9999';
    elem.style.width = '100vw';
    elem.style.height = '100vh';
    elem.style.backgroundColor = 'rgba(0,0,0,0.85)';
    elem.style.display = 'flex';
    elem.style.flexDirection = 'column';
    elem.style.justifyContent = 'center';
    elem.style.alignItems = 'center';
    const elem2 = document.createElement('div');
    elem2.style.width = '100%';
    elem2.style.display = 'flex';
    elem2.style.justifyContent = 'center';
    const loader = document.createElement('div');
    loader.style.border = '16px solid #f3f3f3'
    loader.style.borderRadius = '50%';
    loader.style.borderTop = '16px solid #3498db';
    loader.style.width = '150px';
    loader.style.height = '150px';
    loader.style.animation = 'spin 1s linear infinite';
    elem2.appendChild(loader);
    const loadingText = document.createElement('div');
    loadingText.style.marginTop = '20px';
    loadingText.style.color = 'white';
    loadingText.innerText = 'Injecting Ujianify Anti Cheat (0%)...';
    elem.appendChild(elem2);
    elem.appendChild(loadingText);
    document.getElementById('root').appendChild(elem);

    let opacity = 0.85;
    let progress = 0;
    let progressLerp = Math.floor(AntiCheatData.delay / 1000);
    const task = setInterval(function () {
        opacity -= 0.0005;
        progress += progressLerp;
        elem.style.backgroundColor = 'rgba(0,0,0,' + opacity + ')';
        loadingText.innerText = 'Injecting Ujianify Anti Cheat (' + Math.floor(progress / 10) + '%)...'
    }, 25);

    setTimeout(function () {
        clearInterval(task);
        elem.remove();
    }, AntiCheatData.delay - 1);

    localStorage.setItem('last_anti_cheat_loaded', '' + Date.now());
}


function LoadAntiCheat() {
    sendLoadingAnimation();
    document.addEventListener('contextmenu', event => event.preventDefault());
    if(!IsFullScreen()) {
        const elemId = 'anti_cheat_detection';
        document.getElementById('root').innerHTML = '<div  id="' + elemId + '" class="flex flex-col justify-center fixed z-[9999] bg-red-800 w-[100vw] h-[100vh]">' +
            '<div class="flex justify-center w-[100vw] text-3xl font-bold text-white"><div class="flex flex-col justify-center items-center font-thin gap-y-2"><div class="mb-8">Windowed Mode is prohibited</div><div class="font-normal text-lg">Please press F11 to make this page fullscreen. Then press CTRL+R or <span class="cursor-pointer select-none" onclick="window.location.reload();">click here</span> to reload</div><div class="font-bold text-sm mt-2">Powered by Ujianify Anti Cheat</div>' +
            '</div></div></div>';
        return false;
    }
    setTimeout(function () {
        _LoadAntiCheat();
    }, AntiCheatData.delay);
}

function IsFullScreen() {
    const screenW = window.screen.width;
    const screenH = window.screen.height;
    const pageW = window.innerWidth;
    const pageH = window.innerHeight;
    return screenW === pageW && screenH === pageH;
}

function _LoadAntiCheat() {
    AntiCheatData.lastCheck = Date.now();
    setInterval(function () {
        if(!IsFullScreen() || (Date.now() - AntiCheatData.lastCheck >= AntiCheatData.intervalCheck + AntiCheatData.compensation)) {
            AntiCheatData.warning++;
            if(AntiCheatData.warning >= AntiCheatData.maxWarn) {
                OnCheatDetected();
                AntiCheatData.warning = 0;
            }
        }
        AntiCheatData.lastCheck = Date.now();
    }, AntiCheatData.intervalCheck);
}

var cheatSubjectId = 0;

function OnCheatDetected() {
    const elemId = 'anti_cheat_detection';
    if(document.getElementById(elemId) !== null) {
        return;
    }
    // const svg = '<svg xmlns="http://www.w3.org/2000/svg" width="300px" height="300px" viewBox="0 0 20 20" version="1.1">' +
    //     '<g id="layer1">' +
    //     '<path d="M 7.5 0 C 3.3637867 0 0 3.3637867 0 7.5 C 0 10.306731 1.551733 12.753377 3.8398438 14.039062 L 4.5761719 13.302734 C 2.4544594 12.233912 1 10.042439 1 7.5 C 1 3.9042268 3.9042268 1 7.5 1 C 10.042439 1 12.233912 2.4544594 13.302734 4.5761719 L 14.039062 3.8398438 C 12.753376 1.5517328 10.306731 -2.9605947e-016 7.5 0 z M 18.646484 0.64648438 L 0.64648438 18.646484 L 1.3535156 19.353516 L 19.353516 1.3535156 L 18.646484 0.64648438 z M 14.982422 7.1386719 L 13.966797 8.1542969 C 13.661258 11.226673 11.226673 13.661258 8.1542969 13.966797 L 7.1386719 14.982422 C 7.2591028 14.988403 7.3780487 15 7.5 15 C 9.3884719 15 11.109881 14.292492 12.429688 13.136719 L 19.146484 19.853516 C 19.616947 20.383726 20.383726 19.616947 19.853516 19.146484 L 13.136719 12.429688 C 14.292492 11.109882 15 9.3884719 15 7.5 C 15 7.3780487 14.988403 7.2591028 14.982422 7.1386719 z " style="fill:#ffffff; fill-opacity:1; stroke:none; stroke-width:0px;"/>' +
    //     '</g>' +
    //     '</svg>';
    const svg = '<img src="' + _url('images/cheat.gif') + '" alt="anim cheat" width="300">';
    document.title = 'Cheating Detected';
    document.getElementById('root').innerHTML = '<div id="' + elemId + '" class="flex flex-col justify-center fixed z-[9999] bg-red-800 w-[100vw] h-[100vh]">' +
        '<div class="flex justify-center w-[100vw] text-3xl font-bold text-white"><div class="flex flex-col justify-center items-center font-thin gap-y-2"><div class="mb-2">' + svg + '</div><div>CHEATING DETECTED</div><div class="font-normal text-lg">Cheating is not cool. Sorry bro, system automatically report you to the teacher for cheating</div><div class="font-bold text-sm mt-2">Powered by Ujianify Anti Cheat</div>' +
        '</div></div></div>';
    axios.get(_url(`subject/${cheatSubjectId}/oncheat`));
}
