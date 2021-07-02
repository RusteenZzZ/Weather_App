let cvs = document.getElementById("canvas");
let ctx = cvs.getContext("2d");

let fps = 30;

let dialogues = [];
let index_of_dialogue = -1;
let life_cicle_of_dialogue = -1;
dialogues.push("Hi, Alex");
dialogues.push("The weather is fine today");
dialogues.push("Go and add some new records, do not waste your time");
dialogues.push("Laptop is over there, on the table");
dialogues.push("I am a bit busy, I need to finish my WebProject");
dialogues.push("This toilet is scaring me, could you check it?");
dialogues.push("Alex?");
dialogues.push("...");
dialogues.push("You are always ignoring me, aren't you?");
dialogues.push("...");

document.getElementById("form").addEventListener("submit", function (e) {
    e.preventDefault();
    fetch("addData.php", {
        method: "POST",
        body: new FormData(this)
    })
        .then(result => result.json())
        .then(result => console.log(result))
        .catch(err => console.log(err))
});

class StaticSprite{
    constructor(x, y, width, height, image){
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.image = image;
    }
    draw(){
        ctx.drawImage(this.image, this.x, this.y, this.width, this.height);
    }
};

class TwoFramesSprite{
    constructor(x, y, width, height, image){
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.image = image;
        this.state = 1;
    }
    draw(){
        if(this.state == 1) ctx.drawImage(this.image, 0, 0, this.width, this.height/2, this.x, this.y, this.width, this.height/2);
        else ctx.drawImage(this.image, 0, this.height/2, this.width, this.height/2, this.x, this.y, this.width, this.height/2);
    }
};

let staticSprites = [];
let twoFramesSprites = [];

let background = new Image(1200 ,800);
background.src = "img/Background.png";
let hero = new Image(256, 288);
hero.src = "img/Alex.png";
let radio = new Image(45, 45);
radio.src = "img/Radio.png";
let laptop = new Image(64, 64);
laptop.src = "img/Laptop.png";
let label = new Image(80, 48);
label.src = "img/Label.png";

Radio = new StaticSprite(50, 750, 45, 45, radio);
staticSprites.push(Radio);
Laptop = new StaticSprite(1100, 100, 64, 64, laptop);
staticSprites.push(Laptop);
Label = new StaticSprite(600, 40, 80, 48, label);
staticSprites.push(Label);

let trailer_car = new Image(400, 300);
trailer_car.src = "img/Trailer_car.png";
let toilet = new Image(80, 240);
toilet.src = "img/Toilet.png";
let tree = new Image(96, 384);
tree.src = "img/Tree.png";

Trailer_car = new TwoFramesSprite(30, 30, 400, 300, trailer_car);
twoFramesSprites.push(Trailer_car);
Toilet = new TwoFramesSprite(700, 650, 80, 240, toilet);
twoFramesSprites.push(Toilet);
Tree1 = new TwoFramesSprite(1100, 600, 96, 384, tree);
twoFramesSprites.push(Tree1);
Tree2 = new TwoFramesSprite(750, 60, 96, 384, tree);
twoFramesSprites.push(Tree2);
Tree3 = new TwoFramesSprite(20, 400, 96, 384, tree);
twoFramesSprites.push(Tree3);

let kmag_yoyo = new Audio();
kmag_yoyo.src = "audio/Hayes_Carll_KMAG_YOYO.mp3";
let stairway_to_haiwen = new Audio();
stairway_to_haiwen.src = "audio/Led_Zeppelin_-_Stairway_To_Heaven_(Official_Audio).mp3";
let formidable = new Audio();
formidable.src = "audio/Stromae-Formidable_(HQ).mp3";
let over = new Audio();
over.src = "audio/Drake_-_Over_(Hyper_Crush_Remix)_(Project_X).mp3";
let to_whom = new Audio();
to_whom.src = "audio/GHOSTEMANE_x_PARV0_-_To_Whom_it_May_Concern_[Human_Error_EP].mp3";
let to_horizon = new Audio();
to_horizon.src = "audio/Bring_Me_The_Horizon_-_1x1_(Lyric_Video)_ft._Nova_Twins.mp3";
let careless_whisper = new Audio();
careless_whisper.src = "audio/George_Michael_-_Careless_Whisper_(Official_Video).mp3";

let walk = new Audio();
walk.src = "audio/Walking.mp3";

let music = [];
music.push(kmag_yoyo);
music.push(stairway_to_haiwen);
music.push(formidable);
music.push(over);
music.push(to_whom);
music.push(to_horizon);
music.push(careless_whisper);

function checkCollision(x1, y1, width1, height1, x2, y2, width2, height2){
    if (x1 < x2 + width2 && x1 + width1 > x2 && y1 < y2 + height2 && y1 + height1 > y2) {
        return 1;
    }else{
        return -1;
    }
};

function checkBorder(x, y, width, height){
    if (x < 0 || x + width > 1200 || y + height > 800 || y < 0) {
        return 1;
    }else{
        return -1;
    }
};

class Hero{ 
    constructor(x, y, image){
        this.x = x;
        this.y = y;
        this.width = 64;
        this.height = 96;
        this.image = image;
        this.step = 10;
        this.lookDir = 1; // 1 - right | -1 - left
        this.moveDir = 0;
        this.isMoving = false;
        this.state = 0;
        this.isBlocked = false;
        this.rightStates = [
            {
                'sx' : 64,
                'sy' : 0
            },
            {
                'sx' : 128,
                'sy' : 0
            },
            {
                'sx' : 64,
                'sy' : 0
            },
            {
                'sx' : 0,
                'sy' : 96
            },
            {
                'sx' : 192,
                'sy' : 0
            },
            {
                'sx' : 0,
                'sy' : 96
            }
        ];
        this.leftStates = [
            {
                'sx' : 128,
                'sy' : 96
            },
            {
                'sx' : 192,
                'sy' : 96
            },
            {
                'sx' : 128,
                'sy' : 96
            },
            {
                'sx' : 0,
                'sy' : 192
            },
            {
                'sx' : 64,
                'sy' : 192
            },
            {
                'sx' : 0,
                'sy' : 192
            }
        ]
    }
    moveLeft(){
        this.x-=this.step;
        if(checkBorder(this.x, this.y, this.width, this.height) == 1) this.x+=this.step;
        for(let i=0;i<staticSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, staticSprites[i].x, staticSprites[i].y, staticSprites[i].width, staticSprites[i].height) == 1){
                this.x+=this.step;
                break;
            }
        }
        for(let i=0;i<twoFramesSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, twoFramesSprites[i].x, twoFramesSprites[i].y, twoFramesSprites[i].width, twoFramesSprites[i].height/2) == 1){
                this.x+=this.step;
                break;
            }
        }
    }
    moveRight(){
        this.x+=this.step;
        if(checkBorder(this.x, this.y, this.width, this.height) == 1) this.x-=this.step;
        for(let i=0;i<staticSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, staticSprites[i].x, staticSprites[i].y, staticSprites[i].width, staticSprites[i].height) == 1){
                this.x-=this.step;
                break;
            }
        }
        for(let i=0;i<twoFramesSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, twoFramesSprites[i].x, twoFramesSprites[i].y, twoFramesSprites[i].width, twoFramesSprites[i].height/2) == 1){
                this.x-=this.step;
                break;
            }
        }
    }
    moveUp(){
        this.y-=this.step;
        if(checkBorder(this.x, this.y, this.width, this.height) == 1) this.y+=this.step;
        for(let i=0;i<staticSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, staticSprites[i].x, staticSprites[i].y, staticSprites[i].width, staticSprites[i].height) == 1){
                this.y+=this.step;
                break;
            }
        }
        for(let i=0;i<twoFramesSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, twoFramesSprites[i].x, twoFramesSprites[i].y, twoFramesSprites[i].width, twoFramesSprites[i].height/2) == 1){
                this.y+=this.step;
                break;
            }
        }
    }
    moveDown(){
        this.y+=this.step;
        if(checkBorder(this.x, this.y, this.width, this.height) == 1) this.y-=this.step;
        for(let i=0;i<staticSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, staticSprites[i].x, staticSprites[i].y, staticSprites[i].width, staticSprites[i].height) == 1){
                this.y-=this.step;
                break;
            }
        }
        for(let i=0;i<twoFramesSprites.length;i++){
            if(checkCollision(this.x, this.y, this.width, this.height, twoFramesSprites[i].x, twoFramesSprites[i].y, twoFramesSprites[i].width, twoFramesSprites[i].height/2) == 1){
                this.y-=this.step;
                break;
            }
        }
    }
    update(){
        switch(this.moveDir){
            case 1:
                Alex.moveUp();
                break;
            case 2:
                Alex.moveRight();
                break;
            case 3:
                Alex.moveDown();
                break;
            case 4:
                Alex.moveLeft();
                break;
        }
    }
    draw(){
        if(this.lookDir == 1){
            if(this.isMoving == true){
                ctx.drawImage(this.image, this.rightStates[this.state].sx, this.rightStates[this.state].sy, 64, 96, this.x, this.y, 64, 96);
            }else{
                ctx.drawImage(this.image, 0, 0, 64, 96, this.x, this.y, 64, 96);
            }
        }else{
            if(this.isMoving == true){
                ctx.drawImage(this.image, this.leftStates[this.state].sx, this.leftStates[this.state].sy, 64, 96, this.x, this.y, 64, 96);
            }else{
                ctx.drawImage(this.image, 64, 96, 64, 96, this.x, this.y, 64, 96);
            }
        }
        
    }
};

Alex = new Hero(200, 200, hero);

ctx.font = "18px Arial";

function gameLoop(){
    ctx.clearRect(0, 0, cvs.width, cvs.height);
    ctx.drawImage(background, 0, 0, 1200, 800);
    for(let i=0;i<staticSprites.length;i++){
        staticSprites[i].draw();
    }
    for(let i=0;i<twoFramesSprites.length;i++){
        twoFramesSprites[i].draw();
    }

    if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Trailer_car.x-Trailer_car.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Trailer_car.y-Trailer_car.height/2, 2)) <= 150) ctx.font = "21px Fantasy";
    ctx.fillText("Talk to Bobby", 140, 180);
    ctx.font = "18px Arial";

    if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Radio.x-Radio.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Radio.y-Radio.height/2, 2)) <= 120) ctx.font = "21px Fantasy";
    ctx.fillText("Radio", 50, 740);
    ctx.font = "18px Arial";

    if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Laptop.x-Laptop.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Laptop.y-Laptop.height/2, 2)) <= 120) ctx.font = "21px Fantasy";
    ctx.fillText("Laptop for adding data", 1000, 100);
    ctx.font = "18px Arial";

    if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Label.x-Label.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Label.y-Label.height/2, 2)) <= 150) ctx.font = "21px Fantasy";
    ctx.fillText("Exit", 620, 63);
    ctx.font = "18px Arial";

    if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Toilet.x-Toilet.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Toilet.y-Toilet.height/2, 2)) <= 200){
        ctx.font = "21px Fantasy";
        ctx.fillText("Hey, I am stuck here!", 620, 630);
        ctx.font = "18px Arial";
    }

    Alex.update();
    Alex.draw();

    if(life_cicle_of_dialogue >= 0){
        ctx.font = "18px Fantasy";
        ctx.fillText(dialogues[index_of_dialogue], 30, 30);
        ctx.font = "18px Arial";
        life_cicle_of_dialogue--;
    }
}

let k = -1;
let isMusicOn = false;

document.addEventListener("keydown", e => {
    switch(e.keyCode){
        case 87:
            if(Alex.isBlocked != true){
                Alex.isMoving = true;
                Alex.moveDir = 1;
            }
            break;
        case 83:
            if(Alex.isBlocked != true){
                Alex.isMoving = true;
                Alex.moveDir = 3;
            }
            break;
        case 65:
            if(Alex.isBlocked != true){
                Alex.isMoving = true;
                Alex.moveDir = 4;
                Alex.lookDir = -1;
            }
            break;
        case 68:
            if(Alex.isBlocked != true){
                Alex.isMoving = true;
                Alex.moveDir = 2;
                Alex.lookDir = 1;
            }
            break;
        case 70:
            if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Radio.x-Radio.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Radio.y-Radio.height/2, 2)) <= 120){
                if(k != -1) music[k].pause();
                k++;
                if(k == music.length) k = 0;
                music[k].currentTime = 0;
                music[k].play();
                isMusicOn = true;
            }else if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Laptop.x-Laptop.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Laptop.y-Laptop.height/2, 2)) <= 120){
                Alex.isBlocked = true;
                Alex.isMoving = false;
                Alex.moveDir = 0;
                document.getElementById("ADD").style.zIndex = "50";
                document.getElementById("ADD").style.display = "block";
            }else if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Trailer_car.x-Trailer_car.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Trailer_car.y-Trailer_car.height/2, 2)) <= 150){
                life_cicle_of_dialogue = 100;
                index_of_dialogue++;
                if(index_of_dialogue == dialogues.length) index_of_dialogue = 0;
            }else if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Label.x-Label.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Label.y-Label.height/2, 2)) <= 150){
                document.location.href = "/WeatherApp";
            }
            break;
        case 67:
            if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Radio.x-Radio.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Radio.y-Radio.height/2, 2)) <= 120){
                isMusicOn = false;
                music[k].pause();
            }else if(Math.sqrt(Math.pow(Alex.x+Alex.width/2-Laptop.x-Laptop.width/2, 2) + Math.pow(Alex.y+Alex.height/2-Laptop.y-Laptop.height/2, 2)) <= 120){
                Alex.isBlocked = false;
                document.getElementById("ADD").style.zIndex = "-50";
                document.getElementById("ADD").style.display = "none";
            }
            break;
    }
});

document.addEventListener("keyup", e => {
    switch(e.keyCode){
        case 87:
            if(Alex.isBlocked != true){
                Alex.isMoving = false;
                Alex.moveDir = 0;
            }
            break;
        case 83:
            if(Alex.isBlocked != true){
                Alex.isMoving = false;
                Alex.moveDir = 0;
            }
            break;
        case 65:
            if(Alex.isBlocked != true){
                Alex.isMoving = false;
                Alex.moveDir = 0;
                Alex.lookDir = -1;
            }
            break;
        case 68:
            if(Alex.isBlocked != true){
                Alex.isMoving = false;
                Alex.moveDir = 0;
                Alex.lookDir = 1;
            }
            break;
    }
});

let tx = Alex.x;
let ty = Alex.y;
setInterval(function(){
    if(tx != Alex.x || ty != Alex.y){
        Alex.isMoving = true;
        tx = Alex.x;
        ty = Alex.y;
    }else{
        Alex.isMoving = false;
    }
    Alex.state++;
    if(Alex.state == 6) Alex.state = 0;

}, 50);

setInterval(function(){
    if(isMusicOn == true){
        if(music[k].duration - music[k].currentTime <= 2){
            music[k].pause();
            k++;
            if(k == music.length) k = 0;
            music[k].currentTime = 0;
            music[k].play();
        }
    }
}, 10)

setInterval(function(){
    for(let i=0;i<twoFramesSprites.length;i++){
        twoFramesSprites[i].state = twoFramesSprites[i].state * (-1);
    }
}, 500)

setInterval(function(){
    if(Alex.isMoving == true) walk.play();
}, 200)

setInterval(function(){
    gameLoop();
}, 1000/fps);