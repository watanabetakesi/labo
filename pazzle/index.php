<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<style type="text/css">
#id_canvas1 {
    position:fixed;    
    z-index: 1;
}
#id_canvas2 {
    position:fixed;
    z-index: 2;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
</style>
<script type="text/javascript">
///////////////////////////
// グローバル変数の定義
///////////////////////////
var touchdev;
var canvas1, ctx1;
var canvas2, ctx2;
var phase_load = 0;
var phase_init = 1;
var phase_idle = 2;
var phase_anime = 3;
var phase_finish = 4;
var phase;
var picture;
var pieceno, piecedata;
var lastpieceno, animeseq;
var loaded;
var gameno;
var cellsize = 49;
var cellcount = 4;
var width = (1 + cellsize * cellcount);
var height = (1 + cellsize * cellcount);
console.log('width = ' + width);
console.log('height = ' + height);
var lasttouchx, lasttouchy;
var animestarttick;
var lastanimeseq;

///////////////////////////
// 初期化
//////////////////////////
onload = function () {
    // 描画コンテキストの取得
    canvas1 = document.getElementById('id_canvas1');
    if (!canvas1 || !canvas1.getContext) {
        alert("本ページの閲覧はHTML5対応ブラウザで行ってください");
        return false;
    }
    ctx1 = canvas1.getContext('2d');
    canvas2 = document.getElementById('id_canvas2');
    ctx2 = canvas2.getContext('2d');
    ctx2.fillStyle = "rgb(0,0,0)";
    ctx2.fillRect(0, 0, width, height);
    // ゲームの初期化
    pieceposx = new Array(cellcount * cellcount);
    pieceposy = new Array(cellcount * cellcount);
    pieceno = new Array(cellcount * cellcount);
    piecedata = new Array(cellcount * cellcount);
    lastpieceno = new Array(cellcount * cellcount);
    gameno = 1;
    //gameno = localStorage.getItem("ishii_15puzzle_no");
    if (gameno == null) {
        gameno = 0;
    } else {
        gameno = parseInt(gameno);
    }
    phase = phase_load;
    loaded = false;
    loadpicture(gameno);
    // プラットフォームの判定
    touchdev = false;
    if (navigator.userAgent.indexOf('iPhone') > 0　 || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('iPad') > 0 || navigator.userAgent.indexOf('Android') > 0) {
        touchdev = true;
    }
    // インターバルタイマー関数の登録
    setInterval('timerfunc()', 10);
    // マウス/インターバルタイマーイベント関数の登録
    if (touchdev == false) {
        canvas2.addEventListener('click', clickfunc, false);
    } else {
        canvas2.addEventListener("touchstart", touchstart, false);
        canvas2.addEventListener("touchmove", touchmove, false);
        canvas2.addEventListener("touchend", touchend, false);
    }
};
/////////////////////////////
// 各種処理関数
/////////////////////////////
function loadpicture(gameno) {
    picture = new Image();
    picture.onload = function () {
        ctx1.drawImage(picture, 0, 0);
        loaded = true;
    };
    picture.src = "./pic/" + gameno + ".png";
}
function initgame() {
    var pos;
    var str, tm;

    pos = 0;
    ctx1.font = "bold 14px 'Times New Roman'";
    ctx1.fillStyle = "rgb(255,255,255)";
    for (var y = 0; y < cellcount; y++) {
        for (var x = 0; x < cellcount; x++) {
            str = String(pos + 1);
            tm = ctx1.measureText(str);
            //ctx1.fillText(str, x * 48 + 48 - tm.width - 3, y * 48 + 42);
            piecedata[pos] = ctx1.getImageData(x * 48, y * 48, 48, 48);
            pieceno[pos] = pos;
            pos += 1;
        }
    }
    pieceno[15] = -1;
}
function shuffle() {
    var dirnum;
    var dirx, diry;
    var x, y;
    var movedir;

    dirx = new Array(cellcount);
    diry = new Array(cellcount);
    for (var i = 0; i < 500; i++) {
        for (var j = 0; j < (cellcount * cellcount); j++) {
            if (pieceno[j] < 0) {
                x = j % cellcount;
                y = Math.floor(j / cellcount);
                break;
            }
        }
        dirnum = 0;
        if (x >= 1) {
            dirx[dirnum] = -1;
            diry[dirnum] = 0;
            dirnum += 1;
        }
        if (x <= 2) {
            dirx[dirnum] = 1;
            diry[dirnum] = 0;
            dirnum += 1;
        }
        if (y >= 1) {
            dirx[dirnum] = 0;
            diry[dirnum] = -1;
            dirnum += 1;
        }
        if (y <= 2) {
            dirx[dirnum] = 0;
            diry[dirnum] = 1;
            dirnum += 1;
        }
        movedir = Math.floor(Math.random() * dirnum);
        move(x + dirx[movedir], y + diry[movedir]);
    }
}

function move(piecex, piecey) {
    var blankx, blanky;
    var dx, dy;

    for (var i = 0; i < (cellcount * cellcount); i++) {
        if (pieceno[i] < 0) {
            blankx = i % cellcount;
            blanky = Math.floor(i / cellcount);
            break;
        }
    }
    if (piecey == blanky) {
        dy = 0;
        if (blankx < piecex) {
            dx = 1;
        } else {
            dx = -1;
        }
    } else {
        dx = 0;
        if (blanky < piecey) {
            dy = 1;
        } else {
            dy = -1;
        }
    }
    pieceno[blankx + blanky * cellcount] = pieceno[(blankx + dx) + (blanky + dy) * cellcount];
    pieceno[(blankx + dx) + (blanky + dy) * cellcount] = -1;
    if (piecey == (blanky + dy) && piecex == (blankx + dx)) {
        return;
    }
    move(piecex, piecey);
}

function checkmove(piecex, piecey) {
    var blankx, blanky;

    for (var i = 0; i < (cellcount * cellcount); i++) {
        if (pieceno[i] < 0) {
            blankx = i % cellcount;
            blanky = Math.floor(i / cellcount);
            break;
        }
    }
    if (blanky == piecey || blankx == piecex) {
        if (blanky == piecey && blankx == piecex) {
            return false;
        }
        return true;
    }
    return false;
}

function checkfinish() {
    for (var i = 0; i < 15; i++) {
        if (pieceno[i] != i) {
            return false;
        }
    }
    return true;
}

function initanime() {
    for (var i = 0; i < (cellcount * cellcount); i++) {
        lastpieceno[i] = pieceno[i];
    }
    animeseq = 0;
    lastanimeseq = 0;
    animestarttick = (new Date()).getTime();
}

function exeanime() {
    animeseq = Math.floor(cellsize * ((new Date()).getTime() - animestarttick) / 200);
    if (animeseq > cellsize) {
        animeseq = cellsize;
    }
}

function checkanimeend() {
    if (animeseq == cellsize) {
        return true;
    }
    return false;
}

function draw() {
    var lx, ly, posx, posy;

    ctx2.fillStyle = "rgb(200,200,200)";
    ctx2.fillRect(0, 0, width, height);
    for (y = 0; y < cellcount; y++) {
        for (x = 0; x < cellcount; x++) {
            no = pieceno[x + y * cellcount];
            if (no < 0) {
                continue;
            }
            if (no == lastpieceno[x + y * 4] || phase != phase_anime) {
                ctx2.putImageData(piecedata[no], 1 + x * cellsize, 1 + y * cellsize);
                continue;
            }
            for (var i = 0; i < (cellcount * cellcount); i++) {
                if (lastpieceno[i] == no) {
                    lx = i % cellcount;
                    ly = Math.floor(i / cellcount);
                    break;
                }
            }
            posx = 1 + lx * cellsize;
            posy = 1 + ly * cellsize;
            if (lx == x) {
                if (ly > y) {
                    posy -= animeseq;
                } else {
                    posy += animeseq;
                }
            } else {
                if (lx > x) {
                    posx -= animeseq;
                } else {
                    posx += animeseq;
                }
            }
            ctx2.putImageData(piecedata[no], posx, posy);
        }
    }
}

function drawfinish() {
    var str, tm;
    var imagedata;
    var datasize;

    imagedata = ctx2.getImageData(0, 0, width, height);
    datasize = width * height * cellcount;
    for (var pos = 0; pos < datasize; ) {
        imagedata.data[pos++] /= 2;
        imagedata.data[pos++] /= 2;
        imagedata.data[pos++] /= 2;
        pos += 1;
    }
    ctx2.putImageData(imagedata, 0, 0);
    ctx2.fillStyle = "rgb(255,255,255)";
    ctx2.font = "20px 'Times New Roman'";
    str = "Completed!!";
    tm = ctx2.measureText(str);
    ctx2.fillText(str, (width - tm.width) / 2, height / 2 + 10);
}

function playaudio(audioid) {
    try {
        document.getElementById(audioid).currentTime = 0;
        document.getElementById(audioid).play();
    } catch (e) {
        // for IE9
        document.getElementById(audioid).play();
    }
}

function execlick(x, y) {
    var piecex = Math.floor((x - 1) / cellsize);
    var piecey = Math.floor((y - 1) / cellsize);

    switch (phase) {
        case phase_init:
            if (piecex == 3 && piecey == 3) {
                // 空きマスがクリックされた場合はゲーム番号をリセット
                //gameno = 0;
                //localStorage.removeItem("ishii_15puzzle_no");
                //loaded = false;
                //loadpicture(gameno);
                //phase = phase_load;
                shuffle();
                draw();
                phase = phase_idle;
            } else {
                // ゲームを開始
                shuffle();
                draw();
                phase = phase_idle;
            }
            break;
        case phase_idle:
            if (checkmove(piecex, piecey)) {
                initanime();
                move(piecex, piecey);
                playaudio("id_audiomove");
                phase = phase_anime;
            }
            break;
        case phase_finish:
            loaded = false;
            loadpicture(gameno);
            phase = phase_load;
            break;
    }
}
/////////////////////////////
// イベント処理関数
/////////////////////////////
// マウスイベントの処理関数
function clickfunc(event) {
    var rect = event.target.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    execlick(x, y);
}

function touchstart(event) {
    var rect = event.target.getBoundingClientRect();
    var x = event.touches[0].pageX - rect.left;
    var y = event.touches[0].pageY - rect.top;
    lasttouchx = x;
    lasttouchy = y;
}

function touchmove(event) {
    var rect = event.target.getBoundingClientRect();
    var x = event.touches[0].pageX - rect.left;
    var y = event.touches[0].pageY - rect.top;
    lasttouchx = x;
    lasttouchy = y;
}

function touchend(event) {
    execlick(lasttouchx, lasttouchy);
}

// インターバルタイマーの処理関数
function timerfunc() {
    switch (phase) {
        case phase_load:
            if (loaded) {
                initgame();
                draw();
                phase = phase_init;
            }
            break;
        case phase_anime:
            if (checkanimeend()) {
                if (checkfinish()) {
                    gameno += 1;
                    if (gameno == 4) {
                        gameno = 0;
                    }
                    drawfinish();
                    playaudio("id_audiofinish");
                    localStorage.setItem("ishii_15puzzle_no", String(gameno));
                    phase = phase_finish;
                } else {
                    phase = phase_idle;
                    draw();
                }
                break;
            }
            exeanime();
            if (lastanimeseq == animeseq) {
                break;
            }
            lastanimeseq = animeseq;
            draw();
            break;
    }
}
</script>

<div class="wrapper">
    <canvas id="id_canvas1" width=197 height="197"></canvas>
    <canvas id="id_canvas2" width=197 height="197"></canvas>
    <audio id="id_audiomove"><source src="./audio/open.ogg"><source src="./audio/open.m4a"></audio>
    <audio id="id_audiofinish"><source src="./audio/success.ogg"><source src="./audio/success.m4a"></audio>
</div>

<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>

